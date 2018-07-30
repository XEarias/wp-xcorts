
<?php $xcorts_slides = get_carousel_images(); ?>

<section class="slider-container container-fluid" style="padding:0px !important;">

    <div class="escort-slider">
        <?php foreach($xcorts_slides as $xcorts_slide):?>
        <div>
            <img src="<?php echo $xcorts_slide['url'];?>" style="width: 100%"/>
        </div>
    <?php endforeach;?>
    </div>
   
</section>