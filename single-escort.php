<?php get_header(); ?>

<?php  while ( have_posts() ) : the_post(); ?>

    <?php $escort = get_escort($post->ID); ?>

<?php endwhile;?>

<section class="single-escort-container container pt-5">
    <div class="row">

        <div class="col-md-12 pt-5 pb-5 bg-primary">
            <h5 class="text-center pt-5 pb-5 mt-5 mb-5">IMAGENES</h5>            
        </div>
    
    </div>

    <div class="row">

        <div class="col-md-9 pt-4 pb-2 pl-0 pr-0">
            <h2 class="single-escort-name"><?= $escort['name'] ?></h2>
            <?php if(count($escort['zone'])): ?>
                <p class="single-escort-link"><a href="<?= $escort['zone'][0]['url'] ?>">Escorts en <strong><?= $escort['zone'][0]['name'] ?></strong></a></p>
            <?php else: ?>
                <p class="single-escort-link"><a href="<?= home_url() ?>">Ver mas <strong>chicas</strong></a></p>
            <?php endif; ?>
        </div>
        <div class="col-md-3 pt-4 pb-2 pl-0 pr-0">
            <h2 class="single-escort-phone"><?= $escort['basic-info']['phone'] ?> <span><small>VER TELEFONO</small></span> </h2>
        </div>

    </div>
</section>

<?php get_footer(); ?>