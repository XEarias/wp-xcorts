jQuery(document).ready(function () {

    var intervalImages;

    jQuery('.escort-item-internal-image').hover(function () {

        var internalImage = jQuery(this);

        var images = internalImage.data('images').split(';');

        var index = parseInt(internalImage.data('image-index'));

        if (images.length) {

            intervalImages = setInterval(function () {

                if (index == images.length - 1) {
                    index = 0;
                } else {
                    index++;
                }

                internalImage.data('image-index', index);
                internalImage.css('background-image', 'url(' + images[index] + ')');
            }, 1500)

        } else {
            return false;
        }
    }, function () {
        clearInterval(intervalImages);
    })

    jQuery('.your-class').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 2,
        centerMode: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
})