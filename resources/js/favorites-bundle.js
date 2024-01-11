const FavoritesBundleClass = (function () {
    'use strict';

    let self = this;

    self.favoriteItemsCountElementSelector = '.favorite-items-count';
    self.favoriteItemsCountElement = $(self.favoriteItemsCountElementSelector);
    self.addFavoriteUrl = window.customConfig.addFavoriteUrl;
    self.fetchFavoritesUrl = window.customConfig.fetchFavoritesUrl;
    self.removeFavoriteUrl = window.customConfig.removeFavoriteUrl;
    self.userAuthenticated = window.customConfig.userAuthenticated;
    self.favoriteItems = [];
    self.favoriteActionElementSelector = '.favorite-action-trigger';
    self.favoriteActionElements = $(self.favoriteActionElementSelector);
    self.removeCallback = null;

    self.refreshElements = function () {
        self.favoriteActionElements = $(self.favoriteActionElementSelector);
        self.initTriggersActives();
    }

    self.setFavoriteCount = function () {
        let count = 0;
        count = self.favoriteItems.length;

        self.favoriteItemsCountElement.text(count);
    }

    self.initTriggersActives = function () {
        self.favoriteActionElements.removeClass('active');

        self.favoriteItems.forEach(itemId => {
            //self.favoriteActionElements.find('[data-item-id='+itemId+']').addClass('active');
        });
    }

    if (!window.customConfig.userAuthenticated/* || window.customConfig.userIsAdmin*/) {
        return false;
    }

    self.animateAdding = function (element) {
        const cart = $('.favorite-icon');
        const cartTop = cart.offset().top;
        let imgToDrag = element.find("img").eq(0);
        if (imgToDrag) {
            let imgToClone = imgToDrag.clone()
                .removeClass('w-100')
                .offset({
                    top: imgToDrag.offset().top,
                    left: imgToDrag.offset().left
                })
                .css({
                    'opacity': '0.5',
                    'position': 'absolute',
                    'height': '150px',
                    'width': '150px',
                    'z-index': '100'
                })
                .appendTo($('body'))
                .animate({
                    'top': parseInt(cartTop) + 10,
                    'left': cart.offset().left + 10,
                    'width': 75,
                    'height': 75
                }, 1500);


            imgToClone.animate({
                'width': 0,
                'height': 0
            }, function () {
                $(this).detach()
            });
        }
    }

    self.fetchFavorites = async function () {
        let response = await fetch(self.fetchFavoritesUrl);

        self.favoriteItems = await response.json();

        self.setFavoriteCount();
    }

    self.addFavorite = async function (itemId) {
        self.favoriteItems.push(itemId);

        const response = await fetch(self.addFavoriteUrl, {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            credentials: 'same-origin',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json'
            },
            redirect: 'follow',
            referrerPolicy: 'no-referrer',
            body: JSON.stringify({
                itemId: itemId
            })
        });

        return await response.text();
    }

    self.removeFavorite = async function (itemId) {
        self.favoriteItems.splice(self.favoriteItems.indexOf(itemId), 1);

        const response = await fetch(self.removeFavoriteUrl, {
            method: 'DELETE',
            mode: 'cors',
            cache: 'no-cache',
            credentials: 'same-origin',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json'
            },
            redirect: 'follow',
            referrerPolicy: 'no-referrer',
            body: JSON.stringify({
                itemId: itemId
            })
        });

        return await response.text();
    }

    self.getFavorites = function () {
        return self.favoriteItems;
    };

    self.hasItem = function (itemId) {
        return self.favoriteItems.indexOf(itemId) !== -1;
    };

    self.fetchFavorites().then(() => {
        self.initTriggersActives();
    });

    $(document).on('click', self.favoriteActionElementSelector, function () {
        let element = $(this);
        const itemId = parseInt(element.attr('data-item-id'));

        if (itemId && self.favoriteItems.indexOf(itemId) === -1) {
            self.addFavorite(itemId).then(() => {
                self.initTriggersActives();
                $(this).addClass('active');
                self.animateAdding($(this).closest('.item-card'));
            });
        } else {
            self.removeFavorite(itemId).then(() => {
                self.initTriggersActives();
                $(this).removeClass('active');

                if (typeof self.removeCallback === "function") {
                    self.removeCallback(itemId);
                }
            });
        }
        self.setFavoriteCount();
    });

    return self;
});

window.favoritesBundle = new FavoritesBundleClass();
