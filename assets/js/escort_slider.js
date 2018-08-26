jQuery(document).ready(function(){
    jQuery('.escort-slider').slick({
        arrows: false,
        autoplay: true,
        autoplaySpeed: 4000,
        pauseOnHover:false
    });

    jQuery('.slick-prev').text('<')
    jQuery('.slick-next').text('>')
})

