<?php get_header(); ?>

<?php get_template_part( 'template-parts/escort-filterbar' ); ?>
<?php get_template_part( 'template-parts/escort-slider' ); ?>

<?php prepare_escorts(); ?>

<?php get_template_part( 'template-parts/escort-list' ); ?>

<?php get_footer(); ?>
