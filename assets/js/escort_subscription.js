//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

jQuery(document).ready(function () {
    jQuery(".next-step").click(function () {
        console.log('siguiente')
        if (animating) return false;
        animating = true;

        current_fs = jQuery(this).parent();
        next_fs = jQuery(this).parent().next();

        //activate next step on progressbar using the index of next_fs
        jQuery("#progressbar li").eq(jQuery("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({ opacity: 0 }, {
            step: function (now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale current_fs down to 80%
                scale = 1 - (1 - now) * 0.2;
                //2. bring next_fs from the right(50%)
                left = (now * 50) + "%";
                //3. increase opacity of next_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({
                    'transform': 'scale(' + scale + ')',
                    'position': 'absolute'
                });
                next_fs.css({ 'left': left, 'opacity': opacity });
            },
            duration: 800,
            complete: function () {
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });

    jQuery(".previous-step").click(function () {
        if (animating) return false;
        animating = true;

        current_fs = jQuery(this).parent();
        previous_fs = jQuery(this).parent().prev();

        //de-activate current step on progressbar
        jQuery("#progressbar li").eq(jQuery("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();
        //hide the current fieldset with style
        current_fs.animate({ opacity: 0 }, {
            step: function (now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale previous_fs from 80% to 100%
                scale = 0.8 + (1 - now) * 0.2;
                //2. take current_fs to the right(50%) - from 0%
                left = ((1 - now) * 50) + "%";
                //3. increase opacity of previous_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({ 'left': left });
                previous_fs.css({ 'transform': 'scale(' + scale + ')', 'opacity': opacity, position: 'relative' });
            },
            duration: 800,
            complete: function () {
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });

    jQuery(".submit").click(function () {
        return false;
    });


    jQuery('input#featured_image').on('change', function () { 
        var files = jQuery(this).prop('files')
        if (files && files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var img = jQuery('<img />', {
                    src: e.target.result,
                    height: '100%',
                    width: '100%'
                });

                jQuery('.featured-image-box > .item > label').empty();
                img.appendTo('.featured-image-box > .item > label');
            }

            reader.readAsDataURL(files[0]);
        }
    });

    jQuery('input#images, label[for="images"]').click(function(e) {
        var files = jQuery('input#images').prop("files");
        if (files.length == 5) {
            console.log(files.length)
            e.preventDefault();
        }
    })

    jQuery('input#images').on("change", function () {
        var files = jQuery(this).prop("files");

        jQuery('.images-box .item:not(.main)').remove();

        for (let index = 0; index < files.length; index++) {
            const file = files[index];

            var reader = new FileReader();

            reader.onload = function (e) {

                var img = jQuery('<img />', {
                    src: e.target.result,
                    style: 'max-width: 100% ; max-height: 100%',
                });

                /*var divDelete = jQuery('<div >', {
                    class: 'images-delete-item',
                    'data-index': files.length - 1
                });*/

                var imageLabel = jQuery('<label >', {
                    for: 'images',
                    style: 'height: 130px'
                });

                var imageDiv = jQuery('<div >', {
                    class: 'col-md-2 item',
                    'data-index': files.length - 1
                });

                img.appendTo(imageLabel);

                imageLabel.appendTo(imageDiv)
                //divDelete.appendTo(imageDiv)

                imageDiv.appendTo('.images-box');
            }

            reader.readAsDataURL(file);
        }
    });

    jQuery('.rates label').click(function() {
        console.log(jQuery(this));
    })
});
