jQuery(document).ready(function(){
    jQuery('.escort-slider').slick({
        arrows: true,
        autoplay: true,
        autoplaySpeed: 4000,
        pauseOnHover:false,
        nextArrow: '<i class="fmp-arrow-slider fa fa-arrow-right"></i>',
        prevArrow: '<i class="fmp-arrow-slider fa fa-arrow-left"></i>',
    });

    if (jQuery('button.slick-next.slick-arrow')) {
        jQuery('button.slick-next.slick-arrow').text('>');
    }

    if (jQuery('button.slick-prev.slick-arrow')) {
        jQuery('button.slick-prev.slick-arrow').text('<');
    }
})

