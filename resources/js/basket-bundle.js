const BasketBundleClass = (function () {
    let self = this;

    self.basketItemsCountElementSelector = '.basket-items-count';
    self.basketItemsCountElement = $(self.basketItemsCountElementSelector);

    self.addBasketItemUrl = window.customConfig.addBasketItemUrl;
    self.fetchBasketItemsUrl = window.customConfig.fetchBasketItemsUrl;
    self.fetchSmallBasketUrl = window.customConfig.fetchSmallBasketUrl;
    self.removeBasketItemUrl = window.customConfig.removeBasketItemUrl;
    self.updateBasketItemUrl = window.customConfig.updateBasketItemUrl;

    self.userAuthenticated = window.customConfig.userAuthenticated;
    self.basketItems = [];
    self.basketActionElementSelector = '.basket-action-trigger';
    self.basketActionElements = $(self.basketActionElementSelector);
    self.smallBasketWrapper = $('.small-basket-wrapper');
    self.isProductView = true;
    self.buttonTexts = {
        add: 'Добавить в корзину',
        added: 'Добавлено в корзину'
    };

    self.loaderElement = '<div class="w-100 d-flex justify-content-center align-items-center my-4">' +
            '<div class="lds-roller"><div>' +
                '</div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>' +
            '</div>' +
        '</div>';

    self.checkMaxCount = function (count) {
        if (count == 0) {
            return false;
        }

        return true;
    }

    self.setCount = function (count, maxCount) {
        if (maxCount == 0) {
            maxCount = 1;
        }
        if (count >= maxCount) {
            count = maxCount;
        }
        return count;
    }

    self.getItem = function (id) {
        let itemData = null;

        self.basketItems.forEach(function (item) {
            if (item.itemId === id) {
                itemData = item;
            }
        });

        return itemData;
    }

    self.removeItem = function (id) {
        let items = [];

        self.basketItems.forEach(function (item) {
            if (item.itemId !== id) {
                items.push(item);
            }
        });

        self.basketItems = items;
    };

    self.fetchBasket = async function () {
        let response = await fetch(self.fetchBasketItemsUrl);

        self.basketItems = await response.json();
    }

    self.addItem = async function (itemId, count = 1, size = null) {
        let dataToPush = {
            itemId: itemId,
            count: count,
        };

        if (size) {
            dataToPush.sizeId = parseInt(size);
        }

        self.basketItems.push(dataToPush);

        const response = await fetch(self.addBasketItemUrl, {
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
            body: JSON.stringify(dataToPush)
        });

        return await response.text();
    }

    self.removeItemRequest = async function (itemId, count = 1) {
        self.removeItem(itemId);

        const response = await fetch(self.removeBasketItemUrl, {
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

    self.updateItemRequest = async function (itemId, count) {
        count = parseInt(count);
        itemId = parseInt(itemId);

        if (basketBundle.getItem(itemId)) {
            count += basketBundle.getItem(itemId).count;
        }

        basketBundle.removeItem(itemId);
        basketBundle.basketItems.push({
            itemId: itemId,
            count: count
        });

        basketBundle.setBasketCount();

        const response = await fetch(self.updateBasketItemUrl, {
            method: 'PUT',
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
                itemId: itemId,
                count: count
            })
        });

        return await response.text();
    };

    self.initTriggersActives = function () {
        self.basketActionElements.removeClass('active');
        self.basketActionElements.filter('.view-action-trigger').attr('data-button-text', self.buttonTexts.add);
        $('.product-view-count').parent().removeClass('disable-inputs');
        let sizeBoxes = $('.size-box');
        sizeBoxes.removeClass('disable active');

        self.basketItems.forEach(itemData => {
            if (itemData.sizeId) {
                $(`[data-size-id="${itemData.sizeId}"].size-box`).addClass('active')
            }

            self.basketActionElements.filter(`[data-item-id="${itemData.itemId}"]`).addClass('active');
            self.basketActionElements.filter(`[data-item-id="${itemData.itemId}"].view-action-trigger`).attr('data-button-text', self.buttonTexts.added);
            $(`[data-item-id="${itemData.itemId}"].product-view-count`).parent().addClass('disable-inputs');
        });

        if ($('.size-box.active').length) {
            sizeBoxes.addClass('disable');
        }
    }

    self.fetchBasket().then(() => {
        self.setBasketCount();
        self.initTriggersActives();
    });

    self.refreshElements = function () {
        self.basketActionElements = $(self.basketActionElementSelector);
        self.initTriggersActives();
    }

    self.setBasketCount = function () {
        let count = 0;

        self.basketItems.forEach(function (item) {
            count += item.count;
        });

        self.basketItemsCountElement.text(count);

        if (self.isProductView) {
            self.basketItems.forEach(function (item) {
                //$(`${basketCalculator.itemCountInputSelector},.product-view-count`).filter(`[data-item-id="${item.itemId}"]`).val(item.count);
            });
        }
    }

    self.animateAdding = function (element) {
        const cart = $('.basket-icon');
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

    self.constructSmallBasket = function () {
        if(!basketCalculator.isBigBasket) {
            self.smallBasketWrapper.html(self.loaderElement);

            self.fetchSmallBasket().then(response => {
                self.smallBasketWrapper.html(response);
            });
        }
    };

    self.fetchSmallBasket = async function () {
        const response = await fetch(self.fetchSmallBasketUrl, {
            mode: 'cors',
            cache: 'no-cache',
            credentials: 'same-origin',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'text/html'
            },
            redirect: 'follow',
            referrerPolicy: 'no-referrer',
        });

        return response.text();
    }

    $(document).on('click', self.basketActionElementSelector, function () {
        let element = $(this);

        let maxCount = parseInt(element.closest('.count-section').find('.product-view-count').attr('data-max-count'));
        if (!self.checkMaxCount(maxCount)) {
            return false;
        }

        const itemId = parseInt(element.attr('data-item-id'));
        let size = null;

        if (itemId/* && self.getItem(itemId) === null*/) {
            const sizesCount = parseInt(element.attr('data-sizes-count'));

            if (sizesCount > 0) {
                if (!self.isProductView) {
                    return window.location.href = element.closest('.product-card').find('.item-card-url').attr('href');
                }

                let sizeElements = $('.size-box');
                let activeSize = sizeElements.filter('.active');

                if (!activeSize.length) {
                    if (!sizeElements.hasClass('pulse-effect')) {
                        sizeElements.addClass('pulse-effect');

                        setTimeout(function () {
                            sizeElements.removeClass('pulse-effect')
                        }, 1000);
                    }

                    return false;
                }
                size = activeSize.attr('data-size-id');
            }

            let count = 1;
            if (self.isProductView) {
                count = parseInt(element.closest('.count-section').find('.product-view-count').val());
            }

            self.updateItemRequest(itemId, count, size).then(() => {
                //self.initTriggersActives();
                if (self.isProductView) {
                    self.animateAdding($(this).closest('.item-card'));
                }
                //self.constructSmallBasket();
            });
            parseInt(element.closest('.count-section').find('.product-view-count').val(1));

            self.setBasketCount();
        }
    }).on('change', '.product-view-count', function () {
        let value = parseInt($(this).val());
        let maxCount = parseInt($(this).attr('data-max-count'));

        $(this).val(self.setCount(value, maxCount));

        if (value <= 0) {
            $(this).val(1);

            return false;
        }

        /*const itemId = parseInt($(this).attr('data-item-id'));
        self.updateItemRequest(itemId, value).then(() => {
            self.removeItem(itemId);

            self.basketItems.push({
                itemId: itemId,
                count: value
            });

            self.setBasketCount();
        });*/
    }).on('click', '.view-count-increment', function () {
        let input = $(this).siblings('.product-view-count');
        let value = parseInt(input.val());

        input.val(++value);

        const maxCount = parseInt($(this).prev().attr('data-max-count'));

        input.val(self.setCount(value, maxCount));

        /*const itemId = parseInt($(this).prev().attr('data-item-id'));

        if (itemId && self.getItem(itemId)) {
            self.updateItemRequest(itemId, value).then(() => {
                self.removeItem(itemId);

                self.basketItems.push({
                    itemId: itemId,
                    count: value
                });

                self.setBasketCount();
            });
        }*/
    }).on('click', '.view-count-decrement', function () {
        let input = $(this).siblings('.product-view-count');
        let value = parseInt(input.val());

        if (value <= 1) {
            return false;
        }

        input.val(--value);

        const maxCount = parseInt($(this).next().attr('data-max-count'));

        input.val(self.setCount(value, maxCount));

        /*const itemId = parseInt($(this).parent().attr('data-item-id'));

        if (itemId && self.getItem(itemId)) {
            self.updateItemRequest(itemId, value).then(r => {
                self.removeItem(itemId);

                self.basketItems.push({
                    itemId: itemId,
                    count: value
                });

                self.setBasketCount();
            });
        }*/
    }).on('click', '.disable-inputs', function (event) {
        event.stopPropagation();

        return false;
    }).on('click', '.size-box', function () {
        if (!$(this).hasClass('disable')) {
            $(this).siblings().removeClass('active');
            $(this).addClass('active');

            const price = $(this).attr('data-price');
            const discount = $('.sale-percent').attr('data-discount') || 0;

            $('#discountedPrice').text(basketCalculator.numberFormat(price - (price * discount / 100)));

            if (discount) {
                $('#originalPrice').text(basketCalculator.numberFormat(price));
            }
        }
    });

    return self;
});

window.basketBundle = new BasketBundleClass();

$(document).ready(function () {
    //basketBundle.constructSmallBasket();
})
