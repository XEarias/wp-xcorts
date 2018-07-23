<?php 

/****PLAN VALUE ****/

$plans = [
	"free" => [
		"rates" => [
			"weekly" => 0,
			"monthly" => 0
		],
		"description" => "",
		"items" => []
	],
	"bronze" => [
		"rates" => [
			"weekly" => 199,
			"monthly" => 499
		],
		"description" => "",
		"items" => []
	],
	"silver" => [
		"rates" => [
			"weekly" => 399,
			"monthly" => 999
		],
		"description" => "",
		"items" => []		
	],
	"gold" => [
		"rates" => [
			"weekly" => 499,
			"monthly" => 1499
		],
		"description" => "",
		"items" => []		
	]
];

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
			'exclude_from_search' => true,
			'show_in_nav_menus' => true,
			"show_in_admin_bar" => false,
			"supports" => ["custom-fields"]
		]
    );

	//en deuda
	register_post_status( 'default', [
		'public'                    => true,
		'exclude_from_search'       => false
	]);

	//pagado
	register_post_status( 'paid', [
		'public'                    => true,
		'exclude_from_search'       => false
	]);
	
	//concluido
	register_post_status( 'finished', [
		'public'                    => true,
		'exclude_from_search'       => false
	]);
    

}
add_action('init', 'escort_subscription');


function add_new_subscription($escort_ad_id, $plan = "free", $type = false){

	$ad_status = ($plan == "free") ? "paid" : "default";
	
	$subscription_args = [
		"post_type" => "escort_subscription", 
		"post_status" => $ad_status
	];

	$subscription_id = wp_insert_post($subscription_args);

	add_post_meta($subscription_id, "subscription_plan", $plan, true);
	add_post_meta($subscription_id, "subscription_type", $type, true);
	add_post_meta($subscription_id, "subscription_ad", $escort_ad_id, true);

	$subscription_raw = get_post($subscription_id);

	$subscription = [
		"ID" => $subscription_raw->ID,
		"date" => $subscription_raw->post_date,
		"status" => $subscription_raw->post_status,
		"plan" => [
			"name" => $plan
		]
	];

	if($type){
		$subscription["plan"]["type"] = $type;
	}

	return $subscription;


}


//se obtiene la subscripcion o se crea una free de no existir 
function get_or_set_subscription($escort_ad_id){

	$args = [
		'numberposts' => 1,
		'post_type'  => 'escort_subscription',
		'post_status' => 'any',
		'meta_query' => [
			[
				'key'     => 'subscription_ad',
				'value'   => $escort_ad_id,
				'compare' => '=',
			]
		]

	];

	$subscriptions = get_posts($args);

	//si no tiene suscripciones o la ultima suscripcion finalizo se le crea una nueva de tipo 'free'
	if(!$subscriptions || !count($subscriptions) || $subscriptions[0]["post_status"] == "finished" ){
		$subscription = add_new_subscription($escort_ad_id);
		return $subscription;
	} 


	$subscription_raw = $subscriptions[0];
	
	$plan = get_post_meta($subscription_raw->ID, "subscription_plan", true);
	$type = get_post_meta($subscription_raw->ID, "subscription_type", true);

	$subscription = [
		"ID" => $subscription_raw->ID,
		"date" => $subscription_raw->post_date,
		"status" => $subscription_raw->post_status,
		"plan" => [
			"name" => $plan
		]
	];

	if($type){
		$subscription["plan"]["type"] = $type;
	}


	return $subscription;


}
/*
add_action( 'admin_post_nopriv_xxx', 'get_subscription' );
add_action( 'admin_post_priv_xxx', 'get_subscription' );
*/
?>