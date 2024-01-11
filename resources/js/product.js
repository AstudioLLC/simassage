import ionRangeSlider from 'ion-rangeslider';

window.ionRangeSlider = ionRangeSlider;
window.needCloseFilters = true;

window.colors = [];
$.fn.colorSelect = function () {
    var colorItems = "";
    $('.color-select-input').find('option').each(function () {
        colorItems += '' +
            '<li class="w-10 h-10 block pointer relative shadow-lg m-1 px-3 py-2 '+($(this).prop('selected') ? 'active' : '')+'" style="background:' + this.dataset.color + '" data-colorVal="' + this.dataset.color + '" title="' + this.text + '" data-color-filter="'+this.value+'">' +
            '<span class="invisible"><i class="fa fa-check" aria-hidden="true"></i></span>' +
            '</li>';
        if ($(this).prop('selected')) {
            window.colors.push(this.dataset.color);
        }
    });
    $('.color-select-input').addClass('d-none');
    $('.color-select').html(`<div class="color-select"> <ul class="flex flex-wrap">${colorItems}</ul></div>`);



}
$(function () {
    $('[data-colorselect]').colorSelect();
})
$('.product-types').on('click', 'ul > li > a', function () {
    $(this).parent().addClass('active');

})
$('.color-select').on('click', 'ul > li', function () {
    $(this).toggleClass('active');
    $(this).children().toggleClass('visible');
    if($(this).children().hasClass('visible')){
        $(this).children().removeClass('invisible')
    }else{
        $(this).children().addClass('invisible')
    }
    const color = $(this).attr('data-colorval');

    let action = true;
    if (colors.indexOf(color) === -1) {
        colors.push(color);
    } else {
        action = false;
        window.colors.splice(colors.indexOf(color), 1)
    }

    // $.each(values, function (i, e) {
    $(".color-select-input option[data-color='" + color + "']").prop("selected", action);
    // });
})
$(function () {
    $(".size-bar").slice(0, 5).show();
    $(".loadMore").on('click', function (e) {
        e.preventDefault();
        $(this).prev(".size-bar:hidden").slice(0, 4).slideDown();
        $(this).fadeOut('slow');
        $(this).prev('.size-bar').animate({
            scrollTop: $(this).offset().top
        }, 1500);
    });
});
$('.size-bar').click( function(){$('input[type=checkbox]').each(function () {
   if(this.checked){
       $(this).siblings().addClass('text-blue');
   }else{
       $(this).siblings().removeClass('text-blue');
   }
})});
$('.country').click( function(){$('input[type=checkbox]').each(function () {
    if(this.checked){
        $(this).siblings().addClass('text-blue');
    }else{
        $(this).siblings().removeClass('text-blue');
    }
})});
/*
let $range = $(".js-range-slider"),
    $inputFrom = $(".js-input-from"),
    $inputTo = $(".js-input-to"),
    instance,
    min = 0,
    max = 1000,
    from = 0,
    to = 0;

$range.ionRangeSlider({
    skin: "big",
    type: "double",
    min: min,
    max: max,
    from: 200,
    to: 800,
    onStart: updateInputs,
    onChange: updateInputs
});
instance = $range.data("ionRangeSlider");

function updateInputs(data) {
    from = data.from;
    to = data.to;

    $inputFrom.prop("value", from);
    $inputTo.prop("value", to);
}

$inputFrom.on("input", function () {
    var val = $(this).prop("value");

    // validate
    if (val < min) {
        val = min;
    } else if (val > to) {
        val = to;
    }

    instance.update({
        from: val
    });
});
$inputTo.on("input", function () {

    var val = $(this).prop("value");

    // validate
    if (val < from) {
        val = from;
    } else if (val > max) {
        val = max;
    }

    instance.update({
        to: val
    });
});*/
