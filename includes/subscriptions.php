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

function days_left($date_start, $type){

	if($type == "monthly"){
		$duration = 30;
	} else if($type == "weekly"){
		$duration = 7;
	}

	$earlier = new DateTime($date_start);
	$today = new DateTime();

	$diff = $today->diff($earlier)->d;

	$left = (($duration - $diff) >= 0 ) ? $duration - $diff : 0; 
	$days = [
		"used" => $diff,
		"left" => $left
	];
	return $days;



}
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

	$timestamp = strtotime($subscription_raw->post_date);

	$pretty_date = date('d-m-Y', $timestamp);

	$subscription = [
		"ID" => $subscription_raw->ID,
		"date" => $subscription_raw->post_date,
		"pretty_date" => $pretty_date,
		"status" => $subscription_raw->post_status,
		"plan" => [
			"name" => $plan
		]
	];

	if($type){
		$subscription["plan"]["type"] = $type;

		if(isset($plans[$plan]) && $plans[$plan]["rates"][$type]){
			$value = $plans[$plan]["rates"][$type];
			$subscription["plan"]["value"] = $value;
		}

		$days = days_left($pretty_date, $type);
		$subscription["days"] = $days;
		
	}

	return $subscription;


}


//se obtiene la subscripcion o se crea una free de no existir 
function get_or_set_subscription($escort_ad_id){

	GLOBAL $plans;

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
	if(!$subscriptions || !count($subscriptions) || $subscriptions[0]->post_status == "finished" ){
		$subscription = add_new_subscription($escort_ad_id);
		return $subscription;
	} 


	$subscription_raw = $subscriptions[0];
	
	$plan = get_post_meta($subscription_raw->ID, "subscription_plan", true);
	$type = get_post_meta($subscription_raw->ID, "subscription_type", true);
	$timestamp = strtotime($subscription_raw->post_date);

	$pretty_date = date('d-m-Y', $timestamp );

	$badge_url = ( $plan != "free" ) ? get_template_directory_uri()."/assets/img/badges/".$plan.".png" : false;

	$subscription = [
		"ID" => $subscription_raw->ID,
		"date" => $subscription_raw->post_date,
		"pretty_date" => $pretty_date, 
		"status" => $subscription_raw->post_status,
		"plan" => [
			"name" => $plan,
			"badge" => $badge_url
		]
	];

	if($type){

		$subscription["plan"]["type"] = $type;

		if(isset($plans[$plan]) && $plans[$plan]["rates"][$type]){
			$value = $plans[$plan]["rates"][$type];
			$subscription["plan"]["value"] = $value;
		}

		$days = days_left($pretty_date, $type);
		$subscription["days"] = $days;

	}

	return $subscription;

}



/***** TRABAJO CRONOMETRADO ****/

//registro de evento cronometrado
function escorts_cron_register() {
    if (! wp_next_scheduled ( 'update_escort_status' )) {
	    wp_schedule_event(time(), 'twicedaily', 'update_escort_status');
    }
}
add_action("init", "escorts_cron_register");

function update_escort_status() {
	
	$subscriptions = [];

	$escorts_args = [
		"post_type" => "escort",
		"post_status" => "any",
		"numberposts" => -1
	];
	
	$escorts_ads = get_posts($escorts_args);

	foreach($escorts_ads as $escorts_ad){

		$args = [
			'numberposts' => 1,
			'post_type'  => 'escort_subscription',
			'post_status' => 'any',
			'meta_query' => [
				[
					'key'     => 'subscription_ad',
					'value'   => $escorts_ad->ID,
					'compare' => '='
				],
				[
					'key'     => 'subscription_plan',
					'value'   => 'free',
					'compare' => '!='
				]
			]

		];

		$subscriptions_raw = get_posts($args);

		//si no tiene suscripciones o la ultima suscripcion no esta 'paid'
		if(!$subscriptions_raw || !count($subscriptions_raw) || $subscriptions_raw[0]->post_status != "paid" ){
			continue;
		}


		$subscription_id = $subscriptions_raw[0]->ID;

		$type = get_post_meta($subscription_id, "subscription_type", true);
		$timestamp = strtotime($subscriptions_raw[0]->post_date);
		$pretty_date = date('d-m-Y', $timestamp);
		$days = days_left($pretty_date , $type);

		//si se agotaron los días
		if(!$days["left"]){

			$update_args = [
				"ID" => $subscription_id,
				"post_status" => "finished"
			];

			$result = wp_update_post($update_args);

		} else if((($days["left"] < 5) && ($type == "monthly")) || (($days["left"] < 5) && ($type == "weekly"))){//si esta cerca de vencerse


				//TODO: ENVIAR CORREO
		}

		$subscriptions[] = $days;
		
	}
	   
	return $subscriptions;

}

add_action( 'update_escort_status', 'update_escort_status' );


function test(){
	print_r(get_escorts());
}

add_action( 'admin_post_nopriv_xxx', 'test' );
add_action( 'admin_post_priv_xxx', 'test' );



?>