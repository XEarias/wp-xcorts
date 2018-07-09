 <?php

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
 
    register_taxonomy( 'escorts-services', 'escort', $args );
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

    ?> 
    <!-- EDAD -->
    <label for="edad"><b>Edad:</b></label>
    <select id="edad">
    <?php foreach($ages as $age):?>
        <option><?php echo $age;?></option>
    <?php endforeach;?>
    </select>
    <br>

    <!-- ESTATURA -->
    <label for="stature"><b>Estatura:</b></label>
    <input id="stature" type="text" placeholder="Estatura" name="stature"></input>
    <br>

    <!-- PESO -->
    <label for="weight"><b>Estatura:</b></label>
    <input type="text" placeholder="Peso" name="weight"></input>
    <br>

    <!-- IDIOMAS -->

    <label><b>Idiomas:</b></label>
    <?php foreach($langs as $key => $lang):?>
    <label><?php echo $lang;?>:</label>
    <input type="checkbox" name="langs[<?php echo $key;?>]">
    <?php endforeach;?>
    <br>

    <!-- COLOR DE PELO -->
    <label for="cabello"><b>Color de cabello:</b></label>
    <select id="cabello">
    <?php foreach($hair_colors as $hair_color):?>
        <option><?php echo $hair_color;?></option>
    <?php endforeach;?>
    </select>
    <br>
    <!-- COLOR DE PIEL -->
    <label for="piel"><b>Color de piel:</b></label>
    <select id="piel">
    <?php foreach($skin_colors as $skin_color):?>
        <option><?php echo $skin_color;?></option>
    <?php endforeach;?>
    </select>
    <br>

    <!-- PROFESION -->
    <label for="profession"><b>Profesión:</b></label>
    <input type="text" placeholder="Profesión" name="profession"></input>
    <br>

    <!-- MEDIDAS -->
    <label><b>Medidas:</b></label>
    <input type="text" placeholder="Pecho" name="measure[chest]">
    <input type="text" placeholder="Cintura" name="measure[waist]">
    <input type="text" placeholder="Caderas" name="measure[hip]">
    <br>

    <?php

}

/****  META BOX de TARIFAS ***/
function escort_rates_metabox_html($post){

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

    ?>
    <div>
        <select>
        <?php foreach($rates as $rate):?>
            <option><?php echo $rate;?></option>
        <?php endforeach;?>
        </select>
    </div>
    <?php
   
}


 ?>