import Swiper, {Autoplay, EffectFade, Thumbs, Lazy, Navigation, Pagination} from 'swiper';
import 'swiper/swiper-bundle.css';

Swiper.use([Autoplay, Pagination, Navigation, EffectFade, Lazy, Thumbs]);
window.Swiper = Swiper;
$(function () {
    let galleryImg = $('.gallery-top').innerHeight();
    let gallerysection = galleryImg - 150;
    $('.gallery-thumbs').css('height', galleryImg);
    $('.gallery-thumbs>  .swiper-wrapper').css('height', gallerysection);
    let galleryThumbs = new Swiper('.gallery-thumbs', {
        spaceBetween: 10,
        slidesPerView: 5,
        breakpoints: {
            // when window width is <= 499px
            700: {
                slidesPerView: 3,
            },
            1200: {
                slidesPerView: 5,
            }
        },
        direction: 'vertical',
        loop: false,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        navigation: {
            nextEl: '.next_gallery',
            prevEl: '.prev_gallery',
        },

    });
    let galleryTop = new Swiper('.gallery-top', {

        spaceBetween: 2,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        thumbs: {
            swiper: galleryThumbs,
        },
    });
    constructAccordion();
    constructCharacters();
})
let accordionMobile = false;
const accordionBreakpoint = 786;
let accordionElements = $('#tab-section > li');
let charactersMobilMobile = false;
window.constructCharacters = function () {
    if($(window).innerWidth() < 1024 && !charactersMobilMobile){
        charactersMobilMobile = true;
        $('#characters').children().appendTo($('#characters-mobile'));
    } else if(charactersMobilMobile){
        charactersMobilMobile = false;
        $('#characters-mobile').children().appendTo($('#characters'));
    }
}
window.constructAccordion = function () {
    if ($(window).innerWidth() < accordionBreakpoint && !accordionMobile) {
        accordionMobile = true;

        $.each(accordionElements, function () {
            const navId = ($(this).children('a').attr('data-id'));
            $('#' + navId).appendTo(this);
        });
    } else if (accordionMobile) {
        accordionMobile = false;
        $.each(accordionElements, function () {
            const navId = ($(this).children('a').attr('data-id'));
            $('#' + navId).appendTo($('#tab-section').parent());
        });
    }
}

$(window).resize(function () {
    constructAccordion();
    constructCharacters();
})

$("#tab-section > li").on('click', function (event) {
    $("#tab-section > li ").each(function () {
        $(this).removeClass('bg-white');
        $(this).addClass('bg-gray');
        let aId = $(this).children('a').attr('data-id');
        $('#' + aId).addClass('hidden');
    });

    $(this).removeClass('bg-gray');
    $(this).addClass('bg-white');
    let navId = ($(this).children('a').attr('data-id'));
    $('#' + navId).removeClass('hidden');
});

$(document).ready(function() {
    jQuery(document).on('click','.collectionItemChange',function () {
        let wrapperSelector = '#collection-wrapper';
        let loaderElement = '<div class="flex items-center justify-center my-4 w-full"><div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>';
        let itemId = $(this).data('id');
        $.ajax({
            url: window.customConfig.changeItemByCollection,
            type: 'get',
            cache: false,
            enctype: "multipart/form-data",
            contentType: false,
            data: {
                itemId: itemId,
                _token: csrf,
            },
            beforeSend () {
                $(wrapperSelector).html(loaderElement).css('height', $(window).innerHeight());
            },
            error: function () {
            },
            success: function (response) {
                if (response) {
                    $(wrapperSelector).html(response).css('height', 'auto');

                    let galleryImg = $('.gallery-top').innerHeight();
                    let gallerysection = galleryImg - 150;
                    $('.gallery-thumbs').css('height', galleryImg);
                    $('.gallery-thumbs>  .swiper-wrapper').css('height', gallerysection);
                    let galleryThumbs = new Swiper('.gallery-thumbs', {
                        spaceBetween: 10,
                        slidesPerView: 5,
                        breakpoints: {
                            // when window width is <= 499px
                            700: {
                                slidesPerView: 3,
                            },
                            1200: {
                                slidesPerView: 5,
                            }
                        },
                        direction: 'vertical',
                        loop: false,
                        watchSlidesVisibility: true,
                        watchSlidesProgress: true,
                        navigation: {
                            nextEl: '.next_gallery',
                            prevEl: '.prev_gallery',
                        },
                    });
                    let galleryTop = new Swiper('.gallery-top', {

                        spaceBetween: 2,
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        },
                        thumbs: {
                            swiper: galleryThumbs,
                        },
                    }).slideTo(1, false, false);
                    constructAccordion();
                    constructCharacters();

                    $("#tab-section > li").on('click', function (event) {
                        $("#tab-section > li ").each(function () {
                            $(this).removeClass('bg-white');
                            $(this).addClass('bg-gray');
                            let aId = $(this).children('a').attr('data-id');
                            $('#' + aId).addClass('hidden');
                        });

                        $(this).removeClass('bg-gray');
                        $(this).addClass('bg-white');
                        let navId = ($(this).children('a').attr('data-id'));
                        $('#' + navId).removeClass('hidden');
                    });

                } else {

                }
            }
        });
    })
});
