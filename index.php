<?php get_header(); ?>

<?php $dummy_data = [0,1,2,3,4,5,6,7,8,9] ;?>

<section>SLIDER y BUSCADOR</section>
<section class="escorts-container container-fluid">
    <div class="row">
    <?php foreach($dummy_data as $key => $example): ?>
        <div class="escort-item col-md-2 <?php echo ($key == 0 or $key == 5) ? 'offset-md-1' : '';?>">
            <div class="escort-item-internal">
                <svg viewBox="0 0 100 170" class="hidden-background" style="background-image: url(https://img1.hottescorts.es/guia-55079.jpg)"></svg>
                <div class="escort-info-container">informacion</div>
            </div>
            
        </div>
    <?php endforeach;?>
    </div>
</section>
<section>PUBLICIDAD</section>

