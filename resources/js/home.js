window.$ = window.jQuery = require("jquery");
import Swiper, {Autoplay, EffectFade, Lazy, Navigation, Pagination} from 'swiper';
import 'swiper/swiper-bundle.css';
Swiper.use([Autoplay, Pagination,  Navigation, EffectFade, Lazy]);
window.Swiper = Swiper;
window.homeSlider = new Swiper('.home-top-swiper', {
    loop: false,
    autoplay: {
        delay: 5000,
        disableOnInteraction: true
    },
    speed: 1000,
    effect: 'fade',
    fadeEffect: {
        crossFade: true
    },
    pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});

window.sale = new Swiper('.sale',{
    allowTouchMove: true,
    spaceBetween: 2,
    slidesPerView: 5,
    speed: 1000,
    breakpoints: {
        // when window width is >= 320px
        320: {
            slidesPerView: 1.3,
            spaceBetween: 10
        },
        // when window width is >= 480px
        480: {
            slidesPerView: 2,
            spaceBetween: 10
        },
        // when window width is >= 640px
        640: {
            slidesPerView: 3,
            spaceBetween: 10
        },
        1024: {
            slidesPerView: 5,
            spaceBetween: 15
        },
        1440: {
            allowTouchMove: false,
            spaceBetween: 15,
        }
    }
})
window.discount = new Swiper('.discount',{
    allowTouchMove: true,
    spaceBetween: 2,
    slidesPerView: 5,
    speed: 1000,
    breakpoints: {
        320: {
            slidesPerView: 1.3,
            spaceBetween: 10
        },
        480: {
            slidesPerView: 2,
            spaceBetween: 10
        },
        640: {
            slidesPerView: 3,
            spaceBetween: 10
        },
        1024: {
            slidesPerView: 5,
            spaceBetween: 15
        },
        1440: {
            allowTouchMove: false,
            spaceBetween: 15,
        }
    }
})
window.news = new Swiper('.new',{
    allowTouchMove: true,
    spaceBetween: 2,
    slidesPerView: 5,
    speed: 1000,
    breakpoints: {
        // when window width is >= 320px
        320: {
            slidesPerView: 1.3,
            spaceBetween: 10
        },
        // when window width is >= 480px
        480: {
            slidesPerView: 2,
            spaceBetween: 10
        },
        // when window width is >= 640px
        640: {
            slidesPerView: 3,
            spaceBetween: 10
        },
        1024: {
            slidesPerView: 5,
            spaceBetween: 15
        },
        1440: {
            allowTouchMove: false,
            spaceBetween: 15,
        }
    }
})
window.partners = new Swiper('.partners',{
    spaceBetween:2,
    slidesPerView: 6,
    breakpoints: {
        // when window width is >= 320px
        320: {
            slidesPerView: 2,
            spaceBetween: 10
        },
        // when window width is >= 480px
        480: {
            slidesPerView: 2,
            spaceBetween: 10
        },
        // when window width is >= 640px
        640: {
            slidesPerView: 3,
            spaceBetween: 10
        },
        1024: {
            slidesPerView: 5,
            spaceBetween: 15
        }

    },
    navigation: {
        nextEl: '.next1',
        prevEl: '.prev1',
    },
})
window.homeCategories = new Swiper('.home-categories',{
    slidesPerView: 3,
    slidesPerColumn:2,
    spaceBetween:15,
    navigation: {
        nextEl: '.next_categories',
        prevEl: '.prev_categories',
    },
})
