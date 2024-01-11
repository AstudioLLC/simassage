const for_empty_img = document.createElement("div");
const header_section = document.querySelector(".header-section");
const lang_tel_block = document.querySelector(".lang-tel-block");
// header_section.prepend(for_empty_img);
const first_header = document.querySelector(".first-header");
const header = document.querySelector("header");
const nav_bar_icon = document.querySelector(".navbar-app-icon");
// first_header.style.transition = "none";

window.addEventListener('load', () => {
        first_header.style.marginTop = -first_header.offsetHeight + "px";
        for_empty_img.remove();
        nav_bar_icon.style.display = "block";
        header.style.background = "#800020";
})

window.addEventListener("scroll", (event) => {
        if (window.pageYOffset > first_header.offsetHeight) {
            nav_bar_icon.style.display = "block";
            first_header.style.marginTop = -first_header.offsetHeight + "px";
            first_header.style.transition = ".2s";
            for_empty_img.remove();
            header.style.background = "#800020";

            if (window.matchMedia("(max-width: 1024px)").matches) {
                header_section.append(lang_tel_block);
            }
        } else {
            first_header.style.marginTop = 0 + "px";
            first_header.style.transition = ".2s";
            nav_bar_icon.style.display = "none";
            header_section.prepend(for_empty_img);
            if (window.matchMedia("(max-width: 1024px)").matches) {
                first_header.append(lang_tel_block);
            }
            header.style.background = "transparent";
        }

});
// $(window).scroll(function(){
//     if ($(this).scrollTop() > 50) {
//         $('.header_top_info').animate({
//             display: 'none',
//         },"slow");
//         $('header').addClass('bg-white');
//         $('.header-logo').addClass('bg-logo-color');
//         $('.burger-btn').addClass('burger-btn-color');
//         $('.header-menu-items').addClass('number-color');
//         $('.header-menu-item-number').addClass('number-color');
//         if($(window).width() < 1024){
//             $('.header-menu-item').addClass('text-color');
//             $('.header-menu-items').addClass('#800020');
//             $('.header-menu-item-number').addClass('number-color');
//         }
//     } else {
//         $('.header_top_info').animate({
//             display: 'block',
//         },"slow");
//         $('header').removeClass('bg-white')
//         $('.header-logo').removeClass('bg-logo-color');
//         $('.burger-btn').removeClass('burger-btn-color');
//         $('.header-menu-item').removeClass('text-color');
//         $('.header-menu-items').removeClass('number-color');
//         $('.header-menu-item-number').removeClass('number-color');
//     };
// });

// $(window).resize(function () {
//     if ($(window).width() > 1024) {
//         $(".header-menu").css("display", "flex");
//     } else $(".header-menu").css("display", "none");
// });


$(".dropbtn, .dropdown").click(function () {
    $(".dropdown-content").toggleClass("open");
});

$(".dropbtn, .dropdown, .dropdown-content").click(function (e) {
    e.stopPropagation();
});

$("body").click(function () {
    $(".dropdown-content").removeClass("open");
});

$(".burger-btn").click(function () {
    $(".header-menu").css("display", "flex");
    $("body").css("overflow-y", "hidden");
    $(this).hide();
    $(".burger-close-btn").show();
});

$(".burger-close-btn").click(function () {
    $(".header-menu").css("display", "none");
    $("body").css("overflow-y", "");
    $(this).hide();
    $(".burger-btn").show();
});


(function () {
    "use strict";
    const breakpoint = window.matchMedia("(min-width: 576px)");
    let productCardSlider;

    const breakpointChecker = function () {
        // if larger viewport and multi-row layout needed
        if (breakpoint.matches === true) {
            // clean up old instances and inline styles when available
            if (productCardSlider !== undefined)
                productCardSlider.destroy(true, true);

            // or/and do nothing
            return;

            // else if a small viewport and single column layout needed
        } else if (breakpoint.matches === false) {
            // fire small viewport version of swiper
            return enableSwiper();
        }
    };

    const enableSwiper = function () {
        productCardSlider = new Swiper(".product-card-slider", {
            loop: true,
            slidesPerView: "auto",
            centeredSlides: true,
            slidesPerView: 1.3,
            spaceBetween: 1,

            a11y: true,
            keyboardControl: true,
            grabCursor: true,

        });
    };

    // keep an eye on viewport size changes
    breakpoint.addListener(breakpointChecker);

    // kickstart
    breakpointChecker();
})(); /* IIFE end */

// product-slider

(function () {
    "use strict";
    const breakpoint = window.matchMedia("(min-width: 576px)");
    let productItemSlider;

    const breakpointChecker = function () {
        // if larger viewport and multi-row layout needed
        if (breakpoint.matches === true) {
            // clean up old instances and inline styles when available
            if (productItemSlider !== undefined)
                productItemSlider.destroy(true, true);

            // or/and do nothing
            return;

            // else if a small viewport and single column layout needed
        } else if (breakpoint.matches === false) {
            // fire small viewport version of swiper
            return enableSwiper();
        }
    };

    const enableSwiper = function () {
        productItemSlider = new Swiper(".product-item-slider", {
            loop: true,
            slidesPerView: "auto",
            centeredSlides: true,
            slidesPerView: 1,
            spaceBetween: 10,

            a11y: true,
            keyboardControl: true,
            grabCursor: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },

            paginationClickable: true,
        });
    };

    // keep an eye on viewport size changes
    breakpoint.addListener(breakpointChecker);

    // kickstart
    breakpointChecker();
})(); /* IIFE end */


const swiperEl = document.querySelector('swiper-container')
Object.assign(swiperEl, {
    slidesPerView: 1,
    spaceBetween: 5,
    loop: true,
    autoplay: {
        delay: 1500,
    },
    breakpoints: {
        575: {
            slidesPerView: 1.5,
            spaceBetween: 1,
        },
        640: {
            slidesPerView: 2,
            spaceBetween: 1,
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 1,
        },
        1024: {
            slidesPerView: 4,
            spaceBetween: 1,
        },
        1920: {
            slidesPerView: 5,
            spaceBetween: 1,
        },
    },
});
swiperEl.initialize();

document.querySelector('.back-to-top').addEventListener('click', function () {
    scrollTo({
        behavior: 'smooth',
        left: 0,
        top: 0
    })
})
