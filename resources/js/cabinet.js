$(document).ready(function () {

    $('.radio-button__input').click(function () {
        $('input:not(:checked)').closest('.bg-gray-light').removeClass("active");
        $('input:checked').closest('.bg-gray-light').addClass("active");
    });
    $('input:checked').closest('.bg-gray-light').addClass("active");
    $('.payment').click(function () {
        $('input[name="payment-type"]:checked').val();
        if ($('input[name="payment-type"]:checked').val() == 'prepayment') {
            $('.price').removeAttr('disabled');
            $('.price').focus();
        } else {
            $('.price').val('');
            $('.price').attr('disabled', 'disabled');
        }
    })
    $('.order-date-id').on('click', function () {
        $('.order-date-id').removeClass('order-active');
        $('.order-info').removeClass('order-info ');
        const orderDate = $(this).attr('data-id');
        $(this).addClass('order-active');
        $('#' + orderDate).addClass('order-info ');
    });
    $("#order-section > li").on('click', function (event) {
        $("#order-section > li ").each(function () {
            $(this).removeClass('tab-active');
            let aId = $(this).children('a').attr('data-id');
            $('#' + aId).addClass('hidden');
        });
        $(this).addClass('tab-active');
        let navId = ($(this).children('a').attr('data-id'));
        $('#' + navId).removeClass('hidden');
    })

})
