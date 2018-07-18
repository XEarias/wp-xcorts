<?php 
/******** Subscriptions ********/

function escort_subscription()
{
	register_post_type('escort_subscription',
		[
			'labels' => [
				'name' => "Suscripción",
				'singular_name' => "Suscripción",
				'add_new'  => "Añadir Suscripción",
				'edit_item' => "Editar Suscripción",
				'add_new_item' => "Añadir Nueva Suscripción"
			],
			'public' => true,
			'has_archive' => true,
			"show_in_menu" => true,
			"exclude_from_search" => true,
			'show_in_nav_menus' => true,
			"show_in_admin_bar" => false,
			"supports" => ["title", "custom-fields"]
		]
    );


           register_post_status( 'unread', array(
            'label'                     => _x( 'Unread', 'post' ),
            'public'                    => true,
            'exclude_from_search'       => false,
            'show_in_admin_all_list'    => true,
            'show_in_admin_status_list' => true,
            'label_count'               => _n_noop( 'Unread <span class="count">(%s)</span>', 'Unread <span class="count">(%s)</span>' ),
        ) );
    

}
add_action('init', 'escort_subscription');
?>