<?php

$rates = [
    "30 Minutos",
    "45 Minutos",
    "1 Hora",
    "1 Hora y media",
    "2 Horas",
    "3 Horas",
    "Salidas",
    "Toda la noche",
    "Viajes"
];

$ages = range(18, 40);

$hair_colors = [
    "Moreno",
    "Rubio",
    "Castaño",
    "Pelirrojo",
    "Negro"
];

$skin_colors = [
    "Blanca",
    "Negra",
    "Morena",
    "Apiñonada"
];

$langs = [
    "EN" => "Inglés",
    "ES" => "Español",
    "PR" => "Portugués",
    "FR" => "Francés",
    "IT" => "Italiano"
];

$payment_methods = [
    "efective" => "Efectivo",
    "bank_transfer" => "Transferencia bancaria",
    "others" => "Otros"
];

$phone_permissions = [
    "calls" => "Solo llamadas",
    "whatsapps" => "Solo whatsapp",
    "all" => "Llamadas y whatsapp"
];

/******** Escorts ********/

function add_escort_type()
{
	register_post_type('escort',
		[
			'labels' => [
				'name' => "Escorts",
				'singular_name' => "Escort",
				'add_new'  => "Añadir Escort",
				'edit_item' => "Editar Escort",
				'add_new_item' => "Añadir Nueva Escort"
			],
			'public' => true,
			'has_archive' => true,
			"show_in_menu" => true,
			"exclude_from_search" => true,
			'show_in_nav_menus' => true,
			"show_in_admin_bar" => false,
			"supports" => ["title", "thumbnail", "custom-fields", "editor", "the_excerpt"]
		]
    );

}
add_action('init', 'add_escort_type');

function add_escorts_service_taxonomy() { 
    
    /*** SERVICIOS ***/
    
    $labels = [
        'name'              => 'Servicios',
        'singular_name'     => 'Servicio',
        'search_items'      => 'Buscar servicios',
        'all_items'         => 'Todos los servicios',
        'edit_item'         => 'Editar servicio',
        'update_item'       => 'Actualizar servicio',
        'add_new_item'      => 'Agregar nuevo servicio',
        'new_item_name'     => 'Nuevo nombre de servicio',
        'menu_name'         => 'Servicios',
    ];
 
    $args = [
        'labels' => $labels,
        "public" => true,
        'show_ui' => true,
        'query_var' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true
    ];
 
    register_taxonomy( 'escorts_services', 'escort', $args );


    /*** ZONAS ***/

    $labels = [
        'name'              => 'Zonas',
        'singular_name'     => 'Zona',
        'search_items'      => 'Buscar zona',
        'all_items'         => 'Todas las zonas',
        'edit_item'         => 'Editar zona',
        'update_item'       => 'Actualizar zona',
        'add_new_item'      => 'Agregar nueva zona',
        'new_item_name'     => 'Nuevo nombre de zona',
        'menu_name'         => 'Zonas',
    ];
 
    $args = [
        'labels' => $labels,
        "public" => true,
        'show_ui' => true,
        "hierarchical" => true,
        'query_var' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true
    ];
 
    register_taxonomy( 'escorts_zones', 'escort', $args );
}  
add_action( 'init', 'add_escorts_service_taxonomy');


function date_diff_helper($start, $days){
    
    $date = new DateTime($start);
    $now = new DateTime();
    $diff = $now->diff($date);

    return $diff->days > $days;
}


function add_escorts_metaboxes()
{

    add_meta_box(
        'escort_subscription_metabox',          
        'Subscripción Actual:', 
        'escort_subscription_metabox_html', 
        'escort'                
    );

    add_meta_box(
        'escort_basic_metabox',          
        'Datos Básicos', 
        'escort_basic_metabox_html', 
        'escort'                
    );

    add_meta_box(
        'escort_rates_metabox',          
        'Tarifas', 
        'escort_rates_metabox_html', 
        'escort'                
    );
}

add_action('add_meta_boxes', 'add_escorts_metaboxes');

/****  META BOX CON DATOS DE SUSCRIPCION ***/
function escort_subscription_metabox_html($post){

    $subscription = get_or_set_subscription($post->ID);
    ?>

    <input type="hidden" name="subscription[id]" value="<?php echo $subscription["ID"];?>"/>
    <label><b>Plan:</b></label>
    <span style="text-transform: uppercase;"><b><?php echo $subscription["plan"]["name"];?></b></span>
    <br>

    <label><b>Estado de suscripción:</b></label>
    <span><?php echo ($subscription["status"] == "default") ? "<span style='color:red;'>En deuda</span>" : "<span style='color:green;'>Activa</span>";?> </span>
    <br>

    <label><b>Fecha de suscripción:</b></label>
    <span><?php echo $subscription["pretty_date"];?> </span>
    <br>

    <?php if($subscription["plan"]["name"] != "free"): ;?>
    
    <label><b>Días Restantes:</b></label>
    <span><?php echo $subscription["days"]["left"]; ?> </span>
    <br>

    <label><b>Días Consumidos:</b></label>
    <span><?php echo $subscription["days"]["used"]; ?> </span>
    <br>

    <label><b>Tipo de suscripción:</b></label>
    <span><?php echo ($subscription["plan"]["type"] == "monthly") ? "Mensual" : "Semanal";?> </span>
    <br>

    <label><b>Costo de suscripción:</b></label>
    <span><?php echo $subscription["plan"]["value"];?> </span>
    <br>

        <?php if($subscription["status"] == "default"):?>
        <label for="subscription_paid"><b>Marcar como paga:</b></label>
        <input id="subscription_paid" name="subscription[paid]" type="checkbox"/>
        <br>
        <?php endif;?>
    


    <?php endif;?>

    <?php ?>


    
    <!---->
    <?php
}

/****  META BOX CON DATOS BASICOS ***/
function escort_basic_metabox_html($post){

    /***** Global Values ****/
    
    GLOBAL $ages, $hair_colors, $skin_colors, $langs, $phone_permissions;
    

    $post_id = $post->ID;
    //Escort Metas
    $meta_email = get_post_meta($post_id, "escort_email", true);
    $meta_age = get_post_meta($post_id, "escort_age", true);
    $meta_stature = get_post_meta($post_id, "escort_stature", true);
    $meta_weight = get_post_meta($post_id, "escort_weight", true);
    $meta_langs = (get_post_meta($post_id, "escort_langs", true)) ? get_post_meta($post_id, "escort_langs", true) : [] ;
    $meta_skin_color = get_post_meta($post_id, "escort_skin_color", true);
    $meta_hair_color = get_post_meta($post_id, "escort_hair_color", true);
    $meta_profession = get_post_meta($post_id, "escort_profession", true);
    $meta_measure = (get_post_meta($post_id, "escort_measure", true)) ? get_post_meta($post_id, "escort_measure", true) : [];
    $meta_phone = (get_post_meta($post_id, "escort_phone", true)) ? get_post_meta($post_id, "escort_phone", true) : [];


    ?> 

    <!-- Email -->
    <label for="email"><b>Email:</b></label>
    <input id="email" type="email" placeholder="Email" name="email" value="<?php echo $meta_email;?>"/>
    <br>

    <!-- TELEFONO -->
    <label for="phone"><b>Télefono:</b></label>
    <input id="phone" type="text" placeholder="Télefono" name="phone[value]" value="<?php echo (isset($meta_phone['value'])) ? $meta_phone['value'] : "";?>"/>
    <br>

    <!-- PERMISOS TELEFONO -->
    <label for="phone_permission"><b>Permisos de télefono:</b></label>
    <select id="phone_permission" name="phone[permission]">
    <?php foreach($phone_permissions as $key => $phone_permission):?>
        <option <?php echo (isset($meta_phone["permission"]) && $meta_phone["permission"] == $key) ?  "selected='selected'" : "" ?> value="<?php echo $key; ?>"><?php echo $phone_permission;?></option>
    <?php endforeach;?>
    </select>
    <br>


    <!-- EDAD -->
    <label for="edad"><b>Edad:</b></label>
    <select id="edad" name="age">
    <?php foreach($ages as $age):?>
        <option <?php echo ($meta_age == $age) ?  "selected='selected'" : "" ?>><?php echo $age;?></option>
    <?php endforeach;?>
    </select>
    <br>

    <!-- ESTATURA -->
    <label for="stature"><b>Estatura:</b></label>
    <input id="stature" type="text" placeholder="Estatura" name="stature" value="<?php echo $meta_stature;?>"/>
    <br>

    <!-- PESO -->
    <label for="weight"><b>Peso:</b></label>
    <input id="weight" type="text" placeholder="Peso" name="weight" value="<?php echo $meta_weight;?>"/>
    <br>

    <!-- IDIOMAS -->
    <label><b>Idiomas:</b></label>
    <?php foreach($langs as $key => $lang):?>
    <label><?php echo $lang;?>:</label>
    <input type="checkbox" name="langs[<?php echo $key;?>]" <?php echo (in_array($key, $meta_langs)) ? "checked='checked'" : ""; ?>>
    <?php endforeach;?>
    <br>

    <!-- COLOR DE PELO -->
    <label for="cabello"><b>Color de cabello:</b></label>
    <select id="cabello" name="hair_color">
    <?php foreach($hair_colors as $hair_color):?>
        <option <?php echo ($meta_hair_color == $hair_color) ?  "selected='selected'" : "" ?>><?php echo $hair_color;?></option>
    <?php endforeach;?>
    </select>
    <br>
    <!-- COLOR DE PIEL -->
    <label for="piel"><b>Color de piel:</b></label>
    <select id="piel" name="skin_color">
    <?php foreach($skin_colors as $skin_color):?>
        <option <?php echo ($meta_skin_color == $skin_color) ?  "selected='selected'" : "" ?>><?php echo $skin_color;?></option>
    <?php endforeach;?>
    </select>
    <br>

    <!-- PROFESION -->
    <label for="profession"><b>Profesión:</b></label>
    <input type="text" placeholder="Profesión" name="profession" value="<?php echo $meta_profession;?>"/>
    <br>

    <!-- MEDIDAS -->
    <label><b>Medidas:</b></label>
    <input type="text" placeholder="Pecho" name="measure[chest]" value="<?php echo ($meta_measure && isset($meta_measure['chest'])) ? $meta_measure['chest'] : "" ?>">
    <input type="text" placeholder="Cintura" name="measure[waist]" value="<?php echo ($meta_measure && isset($meta_measure['waist'])) ? $meta_measure['waist'] : "" ?>">
    <input type="text" placeholder="Caderas" name="measure[hip]" value="<?php echo ($meta_measure && isset($meta_measure['hip'])) ? $meta_measure['hip'] : "" ?>">
    <br>

    <?php

}

/****  META BOX de TARIFAS ***/
function escort_rates_metabox_html($post){

    GLOBAL $rates, $payment_methods;

    $post_id = $post->ID;
    $meta_rates = (get_post_meta($post_id, "escort_rates", true)) ? get_post_meta($post_id, "escort_rates", true) : [];
    $meta_payment_methods = (get_post_meta($post_id, "escort_payment_methods", true)) ? get_post_meta($post_id, "escort_payment_methods", true) : [] ;
    ?>

    <div>
        
        <?php foreach($rates as $key => $rate):?>
            <label><b><?php echo $rate; ?></b></label>
            <input name="rates[<?php echo $key; ?>]" placeholder="<?php echo $rate; ?>" value="<?php echo ($meta_rates && isset($meta_rates[$key])) ? $meta_rates[$key] : "" ;?>">
            <br>
        <?php endforeach;?>
        
    </div>

    <div>
        <label><b>Metódos de Pago:</b></label>
        <?php foreach($payment_methods as $key => $payment_method): ?>
            <label><?php echo $payment_method;?></label>
            <input type="checkbox" name="payment_methods[<?php echo $key;?>]" <?php echo (in_array($key, $meta_payment_methods)) ? "checked='checked'" : ""; ?>/>
        <?php endforeach; ?>
    </div>
    <?php
   
}


/**** Actualizar Info de la escorts ***/
function admin_save_escort( $post_id, $post_object)
{
    
    if( !isset( $post_object->post_type ) or ($post_object->post_type != 'escort')){
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
	}
    
    //actualizar edad
    if(isset($_POST["age"])){
        $age = $_POST["age"];
        update_post_meta($post_id, "escort_age", $age );
    }

    //actualizar estatura
    if(isset($_POST["stature"])){
        $stature = $_POST["stature"];
        update_post_meta($post_id, "escort_stature", $stature );
    }

    //actualizar peso
    if(isset($_POST["weight"])){
        $weight = $_POST["weight"];
        update_post_meta($post_id, "escort_weight", $weight );
    }

    //actualizar idiomas
    if(isset($_POST["langs"])){
        $langs = [];
        foreach($_POST["langs"] as $key => $lang){
           $langs[] = $key;
        }
        update_post_meta($post_id, "escort_langs", $langs );
    }

    //actualizar color de piel
    if(isset($_POST["skin_color"])){
        $skin_color = $_POST["skin_color"];
        update_post_meta($post_id, "escort_skin_color", $skin_color );
    }
    
    if(isset($_POST["hair_color"])){
        $hair_color = $_POST["hair_color"];
        update_post_meta($post_id, "escort_hair_color", $hair_color );
    }

    if(isset($_POST["profession"])){
        $profession = $_POST["profession"];
        update_post_meta($post_id, "escort_profession", $profession );
    }

    if(isset($_POST["measure"])){
        $measure = $_POST["measure"];
        update_post_meta($post_id, "escort_measure", $measure );
    }

    if(isset($_POST["phone"])){
        $phone = $_POST["phone"];
        update_post_meta($post_id, "escort_phone", $phone );
    }

    if(isset($_POST["email"])){
        $email = $_POST["email"];
        update_post_meta($post_id, "escort_email", $email );
    }

    if(isset($_POST["rates"])){
        $rates = $_POST["rates"];
        update_post_meta($post_id, "escort_rates", $rates );
    }

    //actualizar formas de pago
    if(isset($_POST["payment_methods"])){
        $payment_methods = [];
        foreach($_POST["payment_methods"] as $key => $payment_method){
           $payment_methods[] = $key;
        }
        update_post_meta($post_id, "escort_payment_methods", $payment_methods );
    }

   
    if(isset($_POST["subscription"]) && isset($_POST["subscription"]["paid"])){

        $subscription_id = $_POST["subscription"]["id"];
        
        $subscription = get_post($subscription_id);
       
        if($subscription){
            if ( ! wp_is_post_revision( $post_id ) ){
               
                remove_action('post_updated', 'admin_save_escort');

                $update_subscription_args = [
                    "ID" => $subscription_id,
                    "post_status" => "paid"
                ];

                $updated_subscription = wp_update_post($update_subscription_args);

                add_action('post_updated', 'admin_save_escort');
            }
        }

       

    }

    /*
    if(isset($_FILES["IMAGES"]) and){

    }
    */
   
}

add_action('post_updated', 'admin_save_escort', 10, 2);




function get_escort_ad_attachments($escort_ad_id){

    $escort_thumbnail_id = get_post_thumbnail_id( $escort_ad_id  ); 

    $images_raw = get_attached_media("image/*", $escort_ad_id );

    $images = [];

    foreach($images_raw as $image_raw){

        if($image_raw->ID == $escort_thumbnail_id){
            continue;
        }

        $image_url = wp_get_attachment_url($image_raw->ID);

        $image = [
            "ID" => $image_raw->ID,
            "url" => $image_url
        ];

        $images[] = $image;
    }

    $media = [
        "images" => $images,
        "videos" => []
    ];

}

function get_escort_extra_info($id, &$data){
    
    GLOBAL $rates, $langs, $payment_methods, $phone_permissions;

    $url = get_post_permalink($id);
    $image = get_the_post_thumbnail_url($id);

    $meta_email = get_post_meta($id, "escort_email", true);
    $meta_age = get_post_meta($id, "escort_age", true);
    $meta_stature = get_post_meta($id, "escort_stature", true);
    $meta_weight = get_post_meta($id, "escort_weight", true);
    $meta_langs = (get_post_meta($id, "escort_langs", true)) ? get_post_meta($id, "escort_langs", true) : [] ;
    $meta_skin_color = get_post_meta($id, "escort_skin_color", true);
    $meta_hair_color = get_post_meta($id, "escort_hair_color", true);
    $meta_profession = get_post_meta($id, "escort_profession", true);
    $meta_measure = (get_post_meta($id, "escort_measure", true)) ? get_post_meta($id, "escort_measure", true) : [];
    $meta_phone = (get_post_meta($id, "escort_phone", true)) ? get_post_meta($id, "escort_phone", true) : [];

    //TELEFONO
    $phone = [
        "value" => "",
        "permission" => ""
    ];
    
    if($meta_phone){
        
        $permission = $meta_phone["permission"];
        

        $phone["value"] = isset($meta_phone["value"]) ? $meta_phone["value"] : "";
        $phone["permission"] = isset($meta_phone["permission"]) ? $phone_permissions[$permission] : "";
    }

    //LENGUAJES
    $langs_with_labels = [];

    foreach($meta_langs as $meta_lang){
        $langs_with_labels[$meta_lang] = $langs[$meta_lang];
    }


    //TARIFAS
    $meta_rates = (get_post_meta($id, "escort_rates", true)) ? get_post_meta($id, "escort_rates", true) : [];

    $rates_with_labels = [];
    
    foreach($meta_rates as $key => $meta_rate){
        $rates_with_labels[$key] = [
            "label" => $rates[$key], 
            "value" => ($meta_rate) ? $meta_rate : false
        ];
    }

    //METODOS DE PAGO
    $meta_payment_methods = (get_post_meta($id, "escort_payment_methods", true)) ? get_post_meta($id, "escort_payment_methods", true) : [] ;

    $payment_methods_with_labels = [];

    foreach($meta_payment_methods as $meta_payment_method){
        $payment_methods_with_labels[$meta_payment_method] = $payment_methods[$meta_payment_method];
    }

    //SERVICIOS

    $services_raw = get_the_terms( $id, "escorts_services" );

    $services = [];

    if($services_raw){
        foreach($services_raw as $service_raw){

            $service_url = get_term_link( $service_raw, "escorts_services" );
            
            $services[] = [
                "name" => $service_raw->name,
                "ID" => $service_raw->term_id,
                "url" => $service_url
            ];
        }
    }
    //ZONAS DE SERVICIO
    $zones_raw = get_the_terms( $id, "escorts_zones" );

    $zones = [];

    if($zones_raw){
        foreach($zones_raw as $zone_raw){

            $zone_url = get_term_link( $zone_raw, "escorts_zones" );
            $zones[] = [
                "name" => $zone_raw->name,
                "ID" => $zone_raw->term_id,
                "url" => $zone_url
            ];
        }
    }

    $media = get_escort_ad_attachments($id);

    $subscription = get_or_set_subscription($id);


    $extra_data = [
        "image" => $image,
        "url" => $url,
        "gallery" => $media["images"],
        "videos" => $media["videos"],
        "basic_info" => [
            "skin_color" => $meta_skin_color,
            "hair_color" => $meta_hair_color,
            "measure" => $meta_measure,
            "langs" => $langs_with_labels,
            "profession" => $meta_profession,
            "weight" => $meta_weight,
            "age" => $meta_age,
            "stature" => $meta_stature,
            "phone" => $phone,
            "email" => $meta_email
        ],
        "rates" => $rates_with_labels,
        "principal_rate" => $rates_with_labels[2],
        "payment_methods" => $payment_methods_with_labels,
        "services" => $services,
        "zone" => $zones,
        "subscription" => $subscription
    ];


    $data = array_merge($data, $extra_data);

}



function get_escort($id){
   
    if($escort_raw = get_post($id)){
        $escort_raw_id = $escort_raw->ID;
        $escort_name = $escort_raw->post_title;
        $escort_description = $escort_raw->post_content;
        $is_new = !date_diff_helper($escort_raw->post_date, 30);

        $escort = [
            "ID" => $escort_raw_id,
            "name" => $escort_name,
            "description" => $escort_description,
            "is_new" => $is_new
        ];
    
        get_escort_extra_info($escort_raw_id, $escort);
    
        return $escort;  
    }

    return false;
    
  


    
}


function get_escorts($options = []){

    $args = [
        "numberposts" => -1,
        "post_status" => 'publish',
        "post_type" => "escort"
    ];

    if($options){
        
        if(isset($options["taxonomy"]) && isset($options["term"])){
            $taxonomy = $options["taxonomy"];
            $term = $options["term"];
            
            $args['tax_query'] = [
                [
                    'taxonomy' => $taxonomy,
                    'field' => 'slug',
                    'terms' => $term,
                    'include_children' => false
                ]
            ];
        }

        if(isset($options["limit"])){

            $limit = $options["limit"];
            $args["numberposts"] = $limit; 

        }
    }


    $escorts_raw = get_posts($args);

    $escorts = [
        "free" => [],
        "bronze" => [],
        "silver" => [],
        "gold" => []
    ];

    $test = [];

    if($escorts_raw) {
        foreach($escorts_raw as $escort_raw){

            $escort_raw_id = $escort_raw->ID;
            $escort_name = $escort_raw->post_title;
            $escort_description = $escort_raw->post_content;
            $is_new = !date_diff_helper($escort_raw->post_date, 30);          
    
            $escort = [
                "ID" => $escort_raw_id,
                "name" => $escort_name,
                "description" => $escort_description,
                "is_new" => $is_new
            ];

            get_escort_extra_info($escort_raw_id, $escort);
            
            if($escort["subscription"]["plan"]["name"] != "free" && $escort["subscription"]["plan"]["status"] == 'default'){
                continue;
            }

            $escort_tier = $escort["subscription"]["plan"]["name"];
            $escorts[$escort_tier][] = $escort;
        }
    }

    $sorted_escorts = array_merge($escorts["gold"],$escorts["silver"], $escorts["bronze"], $escorts["free"]);

    return $sorted_escorts;
}

function get_escorts_by_ids($array = []){
    return [];
}

function prepare_escorts($options = []) {
    $escorts = get_escorts($options);
    set_query_var( 'escorts', $escorts );

    return  $escorts;
}

function prepare_escorts_by_taxonomy($options = []){
    $term_slug = get_query_var( 'term' );
    $taxonomy_name = get_query_var( 'taxonomy' );
    $term = get_term_by( 'slug', $term_slug, $taxonomy_name); 

    $options_taxonomy = [
        "taxonomy" =>  $taxonomy_name,
        "term" => $term_slug
    ];

    $options = array_merge($options, $options_taxonomy);

    $escorts = get_escorts($options);
    set_query_var( 'escorts', $escorts );
}


function get_escorts_zones(){
    
    $zones = [];

    $parent_args = [
        'taxonomy'     => 'escorts_zones',
        'parent'        => 0,
        'hide_empty'    => false           
    ];
    $parent_zones_raw = get_terms( $parent_args );
    
    foreach($parent_zones_raw as $parent_zone_raw){
        
        $parent_zone = [
            "ID" => $parent_zone_raw->term_id,
            "name" => $parent_zone_raw->name,
            "childs" => []
        ];

        $child_args = [
            'taxonomy'     => 'escorts_zones',
            'parent'        => $parent_zone["ID"],
            'hide_empty'    => false           
        ];

        $child_zones_raw = get_terms( $child_args);

        foreach($child_zones_raw as $child_zone_raw){
            $child_zone = [
                "ID" => $child_zone_raw->term_id,
                "name" => $child_zone_raw->name
            ];

            $parent_zone["childs"][] = $child_zone;

        }

        $zones[] = $parent_zone;

    }

    return $zones; 

}

function get_escorts_services(){
    
    $services = [];

    $args = [
        'taxonomy'     => 'escorts_services',
        'hide_empty'    => false           
    ];
    $services_raw = get_terms( $args );

    foreach($services_raw as $service_raw){
        $service = [
            "ID" => $service_raw->term_id,
            "name" => $service_raw->name
        ];

        $services[] = $service;
    }

    return $services;


}

?>