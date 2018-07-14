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
			"show_in_nav_menus" => false,
			"show_in_admin_bar" => false,
			"supports" => ["title", "thumbnail", "custom-fields", "editor"]
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
        'show_admin_column' => true
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
        'rewrite' => true, 
        'show_admin_column' => true
    ];
 
    register_taxonomy( 'escorts_zones', 'escort', $args );
}  
add_action( 'init', 'add_escorts_service_taxonomy');


function add_escorts_metaboxes()
{
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


/****  META BOX CON DATOS BASICOS ***/
function escort_basic_metabox_html($post){

    /***** Global Values ****/
    
    GLOBAL $ages, $hair_colors, $skin_colors, $langs;
    

    $post_id = $post->ID;
    //Escort Metas
    $meta_age = get_post_meta($post_id, "escort_age", true);
    $meta_stature = get_post_meta($post_id, "escort_stature", true);
    $meta_weight = get_post_meta($post_id, "escort_weight", true);
    $meta_langs = (get_post_meta($post_id, "escort_langs", true)) ? get_post_meta($post_id, "escort_langs", true) : [] ;
    $meta_skin_color = get_post_meta($post_id, "escort_skin_color", true);
    $meta_hair_color = get_post_meta($post_id, "escort_hair_color", true);
    $meta_profession = get_post_meta($post_id, "escort_profession", true);
    $meta_measure = get_post_meta($post_id, "escort_measure", true) ? get_post_meta($post_id, "escort_measure", true) : [];
  


    ?> 
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
    <input id="stature" type="text" placeholder="Estatura" name="stature" value="<?php echo $meta_stature;?>"></input>
    <br>

    <!-- PESO -->
    <label for="weight"><b>Peso:</b></label>
    <input id="weight" type="text" placeholder="Peso" name="weight" value="<?php echo $meta_weight;?>"></input>
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
    <input type="text" placeholder="Profesión" name="profession" value="<?php echo $meta_profession;?>"></input>
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

    GLOBAL $rates;

    $post_id = $post->ID;
    $meta_rates = get_post_meta($post_id, "escort_rates", true) ? get_post_meta($post_id, "escort_rates", true) : [];
   
    ?>
    <div>
        
        <?php foreach($rates as $key => $rate):?>
            <label><b><?php echo $rate; ?></b></label>
            <input name="rates[<?php echo $key; ?>]" placeholder="<?php echo $rate; ?>" value="<?php echo ($meta_rates && isset($meta_rates[$key])) ? $meta_rates[$key] : "" ;?>">
            <br>
        <?php endforeach;?>
        
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

    if(isset($_POST["rates"])){
        $rates = $_POST["rates"];
        update_post_meta($post_id, "escort_rates", $rates );
    }
   
}


add_action('post_updated', 'admin_save_escort', 10, 2);



function get_escorts($quantity = false, $offset = false){

    GLOBAL $rates, $langs;

    $args = [
        "numberposts" => 80,
        "post_status" => 'publish',
        "post_type" => "escort"
    ];

    $escorts_raw = get_posts($args);

    $escorts = [];

    if($escorts_raw) {
        foreach($escorts_raw as $escort_raw){

            $escort_raw_id = $escort_raw->ID;
            $escort_name = $escort_raw->post_title;
            $escort_description = $escort_raw->post_content;
            $url = get_post_permalink($escort_raw_id);
            $image = get_the_post_thumbnail_url($escort_raw_id);

            $meta_age = get_post_meta($escort_raw_id, "escort_age", true);
            $meta_stature = get_post_meta($escort_raw_id, "escort_stature", true);
            $meta_weight = get_post_meta($escort_raw_id, "escort_weight", true);
            $meta_langs = (get_post_meta($escort_raw_id, "escort_langs", true)) ? get_post_meta($escort_raw_id, "escort_langs", true) : [] ;
            $meta_skin_color = get_post_meta($escort_raw_id, "escort_skin_color", true);
            $meta_hair_color = get_post_meta($escort_raw_id, "escort_hair_color", true);
            $meta_profession = get_post_meta($escort_raw_id, "escort_profession", true);
            $meta_measure = get_post_meta($escort_raw_id, "escort_measure", true) ? get_post_meta($escort_raw_id, "escort_measure", true) : [];

            $langs_with_labels = [];

            foreach($meta_langs as $meta_lang){
                $langs_with_labels[$meta_lang] = $langs[$meta_lang];
            }

            $meta_rates = get_post_meta($escort_raw_id, "escort_rates", true) ? get_post_meta($escort_raw_id, "escort_rates", true) : [];

            $rates_with_labels = [];

            foreach($meta_rates as $key => $meta_rate){
                $rates_with_labels[$key] = [
                    "label" => $rates[$key], 
                    "value" => ($meta_rate) ? $meta_rate : false
                ];
            }

            $services_raw = get_the_terms( $escort_raw_id, "escorts_services" );

            $services = [];

            if($services_raw){
                foreach($services_raw as $service_raw){
                    $services[] = [
                        "name" => $service_raw->name,
                        "ID" => $service_raw->term_id
                    ];
                }
            }

            $zones_raw = get_the_terms( $escort_raw_id, "escorts_zones" );

            $zones = [];

            if($zones_raw){
                foreach($zones_raw as $zone_raw){
                    $zones[] = [
                        "name" => $zone_raw->name,
                        "ID" => $zone_raw->term_id
                    ];
                }
            }

            

            $escorts[] = [
                "ID" => $escort_raw_id,
                "name" => $escort_name,
                "url" => $url,
                "image" => $image,
                "gallery" => json_encode([]),
                "description" => $escort_description,
                "basic_info" => [
                    "skin_color" => $meta_skin_color,
                    "hair_color" => $meta_hair_color,
                    "measure" => $meta_measure,
                    "langs" => $langs_with_labels,
                    "profession" => $meta_profession,
                    "weight" => $meta_weight,
                    "age" => $meta_age,
                    "stature" => $meta_stature
                ],
                "rates" => $rates_with_labels,
                "principal_rate" => $rates_with_labels[2],
                "services" => $services,
                "zone" => $zones
            ];    
        }
      
        return $escorts;
    }

    return false;
}

function get_escorts_by_ids($array = []){
    return [];
}


?>