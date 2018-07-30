<?php if(!isset($_GET['p'])): ?>

    <?php wp_redirect(get_home_url().'/escort-account?p=dash'); die(); ?>

<?php endif; ?>

<?php
    $page = "";

    switch ($_GET['p']) {
        case 'dash':
            $page = "dash";
            break;

        case 'info':
            $page = "edit-info";
            break;

        case 'rates':
            $page = "edit-rates";
            break;

        case 'services':
            $page = "edit-services";
            break;

        case 'photos':
            $page = "edit-photos";
            break;

        case 'plan':
            $page = "edit-plan";
            break;
        default:
            wp_redirect(get_home_url().'/escort-account?p=dash'); die();
            break;
    }

    set_query_var( 'rates', $rates );
    set_query_var( 'ages', $ages );
    set_query_var( 'hair_colors', $hair_colors );
    set_query_var( 'langs', $langs );
    set_query_var( 'countries', $countries );
    set_query_var( 'skin_colors', $skin_colors );
    set_query_var( 'payment_methods', $payment_methods );
    set_query_var( 'phone_permissions', $phone_permissions );
    set_query_var( 'eyes_colors', $eyes_colors);
    set_query_var( 'sexual_orientations', $sexual_orientations);
    set_query_var( 'complexions', $complexions);
    set_query_var( 'depilations', $depilations);
    set_query_var( 'working_days', $working_days);

    $zones = get_escorts_zones(); 
    $services = get_escorts_services(); 
    
    set_query_var( 'zones', $zones );
    set_query_var( 'services', $services );

    set_query_var( 'plans', $plans );

    set_query_var( 'login_slug', $login_slug );

    $user = get_escort_user_data();
    set_query_var( 'user', $user );

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