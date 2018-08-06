<!-- Archivo de cabecera global de Wordpress -->
<?php get_header(); ?>
<!-- Contenido del post -->
<?php if ( have_posts() ) : the_post(); ?>
  <section class="container">
    <div class="row">
        <div class="col-md-12 pt-5">
            <h1><?php the_title(); ?></h1>
            <time datatime="<?php the_time('Y-m-j'); ?>"><?php the_time('j F, Y'); ?></time>
        </div>
        <div class="<?php if(has_post_thumbnail()): ?>col-md-9<?php else: ?>col-md-12<?php endif; ?> pt-3">
            <div style="text-align: justify;">
                <?php the_content(); ?>
            </div>
        </div>
        <?php if(has_post_thumbnail()): ?>
        <div class="col-md-3 pt-3">
            <img src="<?php the_post_thumbnail_url( 'medium' ); ?> " alt="<?php get_the_post_thumbnail_caption() ?>">
        </div>
        <?php endif; ?>
        <div class="col-md-12 <?php if(has_post_thumbnail()): ?>pt-4<?php endif; ?>">
            <address style="color: grey;">Por <?php the_author_posts_link() ?></address>
        </div>
    </div>
  </section>
<?php else : ?>
  <p><?php _e('Ups!, esta entrada no existe.'); ?></p>
<?php endif; ?>
<!-- Archivo de pié global de Wordpress -->
<?php get_footer(); ?>

