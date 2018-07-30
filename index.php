<?php get_header(); ?>

<?php get_template_part( 'template-parts/escort-slider' ); ?>


<?php get_search_form(); ?>

<section class="container">
    <div class="row">
        <div class="col-md-12">
            <div style="height: 5px; background-color: #999; margin: 25px 0;"></div>
            <h4 style="color: #f39; text-align:center"><?php xcorts_title();?></h4>
            <p style="text-align:center"><?php xcorts_description();?></p>
        </div>
    </div>
</section>

<?php prepare_escorts(); ?>

<?php get_template_part( 'template-parts/escort-list' ); ?>

<?php get_footer(); ?>
