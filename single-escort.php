<?php while ( have_posts() ) :
    
    the_post();
    ?>

   <?php print_r(get_escort($post->ID)); ?>

<?php endwhile;?>

