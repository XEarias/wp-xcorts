<?php if(!isset($_GET['p'])): ?>

    <?php wp_redirect(get_home_url().'/escort-account?p=dash'); die(); ?>

<?php endif; ?>

<?php
    $page = "";

    switch ($_GET['p']) {
        case 'dash':
            $page = "dash";
            break;

        case 'ad':
            $page = "edit-ad";
            break;

        case 'plan':
            $page = "edit-plan";
            break;
        default:
            wp_redirect(get_home_url().'/escort-account?p=dash'); die();
            break;
    }

    set_query_var( 'langs', $langs );

?>

<?php get_header(); ?>

<section class="escort-account-container container-fluid pt-5">
    <div class="row">
        <div class="col-md-3">
            <?php get_template_part( 'template-parts/escort-account/sidebar' ); ?>
        </div>
        <div class="col-md-9">
            <?php get_template_part( 'template-parts/escort-account/'.$page ); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>