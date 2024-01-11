window.$ = window.jQuery = require("jquery");
let openlogin = document.querySelectorAll('.modal-login')
for (var i = 0; i < openlogin.length; i++) {
    openlogin[i].addEventListener('click', function (event) {
        event.preventDefault()
        toggleModalLogin()
    })
}

const overlayLogin = document.querySelector('.modal-overlay-login');
overlayLogin.addEventListener('click', toggleModalLogin);


document.onkeydown = function (evt) {
    evt = evt || window.event
    var isEscape = false
    if ("key" in evt) {
        isEscape = (evt.key === "Escape" || evt.key === "Esc")
    } else {
        isEscape = (evt.keyCode === 27)
    }
    if (isEscape && document.body.classList.contains('modal-active')) {
        toggleModalLogin()
    }
};


document.querySelector('.back-to-top').addEventListener('click', function () {
    scrollTo({
        behavior: 'smooth',
        left: 0,
        top: 0
    })
})

function initInputMask() {
    let elements = document.getElementsByClassName('masked-phone-inputs');

    for (let i = 0; i < elements.length; i++) {
        let $element = $(elements[i]);

        $element.inputmask({
            mask: "+374 99999999"
        });

        if ($element.attr('data-value') !== '') {
            $element.val($element.attr('data-value'));
        }
    }
}

function toggleModalLogin() {
    $('.modal-log').toggleClass('opacity-0 hidden');
    $('.modal-log').toggleClass('z-100');
    $('.modal-log').toggleClass('z--10');
    $('body').toggleClass(' overflowHidden');
}

$('.cabinet-overlay').on('click', function (){
    toggleModal();
})

window.resizeMenu = function () {
    let container_width = parseInt($('.menubar').innerWidth() - $('.sidenav-none').width());
    let elems = $(document).find('.sidenav-block');
    let items_width = 0;
    let diff = 0;
    elems.each(function () {
        items_width += $(this).width();
    });
    if ($(window).innerWidth() > 1190) {
        diff = Number(container_width - items_width);
        if (diff <= Math.ceil(elems.last().width() + 50)) {
            elems.last().removeClass('.sidenav-block');
            $('.sidenav-none>ul').append($('.menubar .sidenav-block').last().removeClass('sidenav-block'));
            if ($('.sidenav-none').css('display') == 'none' && !($('.sidenav-none').is(':empty'))) {
                $('.sidenav-none').css('display', 'block');
            }
            resizeMenu();

        } else {
            if (!($('.sidenav-none').is(':empty'))) {
                if (diff - 50 > Math.ceil($('.sidenav-none>ul').width())) {
                    $('.sidenav-none>ul>li').addClass('sidenav-block').insertBefore('.sidenav-none');
                    if (!($('.sidenav-none').find('li').length)) {

                        $('.sidenav-none').addClass('hidden');
                    }
                }
            }
        }
    } else {
        elems.removeClass('.sidenav-block');
        $('.sidenav-none>ul').append($('.menubar .sidenav-block').removeClass('sidenav-block'));
        if ($('.sidenav-none').css('display') == 'none' && !($('.sidenav-none').is(':empty'))) {
            $('.sidenav-none').css('display', 'block');
        }
        if ($(window).innerWidth() < 640) {
            $('#top-bar').appendTo($('.menu_closed'));
        } else {
            $('#top-bar').prependTo($('#top-bar-section'));
        }
    }
    if ($(".menu_closed li").length > 0) {
        $('.sidenav-none').removeClass('hidden');
    }
}
$(window).resize(function () {
    resizeMenu();
});
$(function () {
    $('.content-login');
    resizeMenu();
    initInputMask();
})
// $(window).scroll(function(event){
// if( window.pageYOffset==0){
//         $('.hide-text').removeClass('hidden');
//     }else{
//        $('.hide-text').addClass('hidden');}
//
// });
var lastScrollTop = 0;
$(window).scroll(function (event) {
    var st = $(this).scrollTop();
    if (st > lastScrollTop) {
        $('.hide-text').removeClass('hidden');
    } else {
        $('.hide-text').addClass('hidden');
    }
    lastScrollTop = st;
});
// $(".profileSettings").on("click", (function(){
//     alert('asd');
//     $('.cabinetbar').toggleClass('active');
// }))
function toggleModal() {
    $('.modal').toggleClass('opacity-0 hidden');
    $('.modal').toggleClass('z-999');
    $('body').toggleClass('overflow-hidden');
}

let openmodal = document.querySelectorAll('.profileSettings')
for (var i = 0; i < openmodal.length; i++) {
    openmodal[i].addEventListener('click', function (event) {
        event.preventDefault()
        toggleModal()
    })
}

const overlay = document.querySelector('.modal-overlay');


document.onkeydown = function (evt) {
    evt = evt || window.event
    var isEscape = false
    if ("key" in evt) {
        isEscape = (evt.key === "Escape" || evt.key === "Esc")
    } else {
        isEscape = (evt.keyCode === 27)
    }
    if (isEscape && document.body.classList.contains('profileSettings')) {
        toggleModal();
    }
};

$(".typeChange").on('click',function (){
    $(this).toggleClass('passChange');
    if($(this).hasClass('passChange')) {
        $(this).children('.fa-eye').addClass('hidden');
        $(this).children('.fa-eye-slash').removeClass('hidden');
        $(this).siblings().attr('type', 'text');
    }else{
        $(this).children('.fa-eye').removeClass('hidden');
        $(this).children('.fa-eye-slash').addClass('hidden');
        $(this).siblings().attr('type', 'password');
    }
})
$('#cabinetHome').click(function () {
    $('.cabinet-home-section').toggleClass('hidden');
    $('body').toggleClass('overflow-hidden');
    if ($('.cabinet-home-section:has(*)').length == 0) {

        $(window).scrollTop(0);
        const heightTop = $('header').innerHeight();
        $('.modal-log').css('top', heightTop);
        toggleModalLogin();
    }
    $('#cabinetHome').toggleClass('bg-pink-custom')
})
$("#types").click(function () {
    $(window).scrollTop(0);
    typeMenu();
})
$("#middle-types").click(function () {
    typeMenu();
})
window.rightMenu = function () {
    if ($('.menu_closed').hasClass('hidden')) {
        $('.menu_closed').removeClass('hidden');
        $('.menu_closed').addClass('animate__animated  animate__fadeInRight');
        $('body').addClass('overflow-hidden');
    } else {
        $('.menu_closed').removeClass('animate__animated  animate__fadeInRight ');
        $('.menu_closed').addClass('animate__animated  animate__fadeOutRight ');
        setTimeout(function () {
            $('.menu_closed').addClass('hidden');
            $('.menu_closed').removeClass('animate__animated  animate__fadeOutRight');
        }, 1000);
        $('body').removeClass('overflow-hidden');
    }
}
window.typeMenu = function () {
    if ($('#menu-type').hasClass('hidden')) {
        $('#menu-type').removeClass('hidden');
        if ($(window).innerWidth() > 1024) {
            $('#menu-type').addClass('dropDown');
        } else {
            $('#menu-type').addClass('animate__animated  animate__fadeInLeft');
            $('#types').toggleClass('bg-pink-custom');
        }
        $('body').addClass('overflow-hidden');
    } else {
        if ($(window).innerWidth() > 1024) {
            $('#menu-type').removeClass('dropDown');
            $('#menu-type').addClass('animate__animated  animate__fadeOutDown ');
            setTimeout(function () {
                $('#menu-type').addClass('hidden');
                $('#menu-type').removeClass('animate__animated  animate__fadeOutDown ');
            }, 1000);
        } else {
            $('#menu-type').removeClass('animate__animated  animate__fadeInLeft ');
            $('#menu-type').addClass('animate__animated  animate__fadeOutLeft ');
            setTimeout(function () {
                $('#menu-type').addClass('hidden');
                $('#menu-type').removeClass('animate__animated  animate__fadeOutLeft ');
            }, 1000);
            $('#types').toggleClass('bg-pink-custom');
        }
        $('body').removeClass('overflow-hidden');
    }
}
$(document).on("click", function (event) {
    if ($(event.target).closest('#cabinetHome').length === 0) {
        if ($(event.target).closest(".cabinet-home-section").length === 0) {
            if (!$('.cabinet-home-section').hasClass('hidden')) {
                $('.cabinet-home-section').addClass('hidden');
                $('body').removeClass('overflow-hidden');
                $('#cabinetHome').removeClass('bg-pink-custom')

            }
        }

    }
    // if ($(event.target).closest('.cabinet-overlay').length === 0 ){
    //     if ($('.modal').hasClass('z-100')) {
    //         toggleModal();
    //     }
    // }
    if ($(event.target).closest('.modal-content').length === 0 && $(event.target).closest('#cabinetHome').length === 0) {
        if ($(event.target).closest('.modal-login').length === 0) {
            if ($('.modal-log').hasClass('z-100')) {
                toggleModalLogin();
            }
        }
    }
    if ($(event.target).closest('#middle-types').length === 0 && $(event.target).closest('#types').length === 0) {
        if ($(event.target).closest("#menu-type").length === 0) {
            if (!$('#menu-type').hasClass('hidden')) {
                typeMenu();

            }
        }

    }
    if ($(event.target).closest('#options-menu').length === 0) {
        if (!$('#lang-bar').hasClass('hidden')) {
            $('#lang-bar').toggleClass('hidden');

        }
    }
})
$(".navs-bar").click(function () {
    $(".navs-bar").toggleClass('active');
    rightMenu();
})
$('.nav-top-menu').click(function () {
    $('.nav-top-menu').toggleClass('active');
    rightMenu();
})
$('#options-menu').click(function () {
    $('#lang-bar').toggleClass('hidden');
})


