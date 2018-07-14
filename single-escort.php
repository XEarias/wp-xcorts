<?php while ( have_posts() ) :
    
    the_post();
    ?>

    <?php the_title()?>;
    <?php the_content()?>;

    <?php the_terms( get_the_ID(), 'escorts_services', 'Servicios: ', ' / ' ); ?>

<?php endwhile;?>
