import 'lightgallery/src/css/lightgallery.css';
import 'lightgallery/src/js/lightgallery.js';
$(document).ready(function() {
    $("#info-lightgallery").lightGallery({
        selector: '.item',
        thumbnail: true,
        pager: false
    });
    $("#about-lightgallery").lightGallery({
        selector: '.item',
        thumbnail: true,
        pager: false
    });
    $('.location-map').on('click', function (){
        const links=$(this).attr('data-src');
        $('iframe').attr('src', links);

    })
});
