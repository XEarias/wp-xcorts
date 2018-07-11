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

<!--<section>SLIDER y BUSCADOR</section>-->
<section class="escorts-container container-fluid">
    <div class="row">
    <?php foreach($dummy_data as $key => $example): ?>
        <div class="escort-item col-md-2 <?php echo ($key == 0 or $key == 5) ? 'offset-md-1' : '';?>">
            <div class="escort-item-internal">
                <svg viewBox="0 0 100 170" class="hidden-background escort-item-internal-image"
                style="background-image: url(https://img1.hottescorts.es/guia-55079.jpg)"
                data-images="<?php echo str_replace('"', "\'", json_encode(['https://img1.hottescorts.es/guia-55079.jpg','https://img1.hottescorts.es/guia-61615.jpg','https://img1.hottescorts.es/guia-61144.jpg','https://img1.hottescorts.es/guia-53165.jpg'], JSON_FORCE_OBJECT)); ?>"
                data-image-index="0">
                </svg>
                <div class="escort-info-container">
                    <div class="escort-info-header">
                        <div class="escort-info-header-left">
                            <a href="#" class="escort-info-header-link" style="color: #666;"><strong>Julia</strong></a>
                            <br>
                            <p>Ciudad de Mexico</p>
                        </div>
                        <div class="escort-info-header-right">
                            <p class="escort-info-header-time">
                                <span style="color: #F39;"><strong>CONSULTAR</strong></span>
                                <br>
                                1 hora
                            </p>
                        </div>
                    </div>
                    <div class="escort-info-body">
                    </div>
                </div>
            </div>
        
        </div>
    <?php endforeach; ?>
    </div>
</section>
<section>PUBLICIDAD</section>

