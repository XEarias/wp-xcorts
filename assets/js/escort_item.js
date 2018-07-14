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
})