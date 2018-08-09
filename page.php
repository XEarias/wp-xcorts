<!-- Archivo de cabecera global de Wordpress -->
<?php get_header(); ?>
<!-- Contenido del post -->
<?php if ( have_posts() ) : the_post(); ?>
  <section class="container">
    <div class="row">
        <div class="<?php if(has_post_thumbnail()): ?>col-md-9<?php else: ?>col-md-12<?php endif; ?> pt-3">
            <div style="text-align: justify;">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
  </section>
<?php endif; ?>
<!-- Archivo de pié global de Wordpress -->
<?php get_footer(); ?>

