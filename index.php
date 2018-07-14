<?php get_header(); ?>

<?php $dummy_data = [0,1,2,3,4,5,6,7,8,9] ;?>

<script>

    var intervalImages;

    jQuery(document).ready(function() {
        jQuery('.escort-item-internal-image').hover(function() {

            var images = JSON.parse('"'+jQuery(this).data('images').replace(/'/gi, '"')+'"');
            
            console.log('"'+jQuery(this).data('images').replace(/'/gi, '"')+'"')
            console.log(images)
            console.log(Object.keys(images))

            var index = parseInt(jQuery(this).data('image-index'));

            if(Object.keys(images).length) {

                console.log('cambiando')

                intervalImages = setInterval(function() {

                    console.log(index, Object.keys(images).length - 1);

                    if(index == Object.keys(images).length - 1) {
                        index = 0;
                    } else {
                        index++;
                    }

                    jQuery(this).css('background-image', 'url('+ images[index] +')');
                    jQuery(this).data('image-index', index);
                }, 1000)

            } else {
                return false;
            }
        }, function () {
            clearInterval(intervalImages);
        })
    })
</script>


<?php 

prepare_escorts();

get_template_part("template-parts/escort-list");


?>

