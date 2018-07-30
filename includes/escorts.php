<?php

$rates = [
    "30 Minutos",
    "45 Minutos",
    "1 Hora",
    "1 Hora y media",
    "2 Horas",
    "3 Horas",
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
    "IT" => "Italiano",
    "RU" => "Ruso",
    "AR" => "Árabe",
    "WE" => "Otro"
];

$payment_methods = [
    "efective" => "Efectivo",
    "bank_transfer" => "Transferencia bancaria",
    "cards" => "Tarjetas"
];

$phone_permissions = [
    "calls" => "Solo llamadas",
    "whatsapps" => "Solo whatsapp",
    "all" => "Llamadas y whatsapp"
];

$countries = ["Afganistán","Albania","Alemania","Andorra","Angola","Antigua y Barbuda","Arabia Saudita","Argelia","Argentina","Armenia","Australia","Austria","Azerbaiyán","Bahamas","Bangladés","Barbados","Baréin","Bélgica","Belice","Benín","Bielorrusia","Birmania","Bolivia","Bosnia y Herzegovina","Botsuana","Brasil","Brunéi","Bulgaria","Burkina Faso","Burundi","Bután","Cabo Verde","Camboya","Camerún","Canadá","Catar","Chad","Chile","China","Chipre","Ciudad del Vaticano","Colombia","Comoras","Corea del Norte","Corea del Sur","Costa de Marfil","Costa Rica","Croacia","Cuba","Dinamarca","Dominica","Ecuador","Egipto","El Salvador","Emiratos Árabes Unidos","Eritrea","Eslovaquia","Eslovenia","España","Estados Unidos","Estonia","Etiopía","Filipinas","Finlandia","Fiyi","Francia","Gabón","Gambia","Georgia","Ghana","Granada","Grecia","Guatemala","Guyana","Guinea","Guinea ecuatorial","Guinea-Bisáu","Haití","Honduras","Hungría","India","Indonesia","Irak","Irán","Irlanda","Islandia","Islas Marshall","Islas Salomón","Israel","Italia","Jamaica","Japón","Jordania","Kazajistán","Kenia","Kirguistán","Kiribati","Kuwait","Laos","Lesoto","Letonia","Líbano","Liberia","Libia","Liechtenstein","Lituania","Luxemburgo","Madagascar","Malasia","Malaui","Maldivas","Malí","Malta","Marruecos","Mauricio","Mauritania","México","Micronesia","Moldavia","Mónaco","Mongolia","Montenegro","Mozambique","Namibia","Nauru","Nepal","Nicaragua","Níger","Nigeria","Noruega","Nueva Zelanda","Omán","Países Bajos","Pakistán","Palaos","Panamá","Papúa Nueva Guinea","Paraguay","Perú","Polonia","Portugal","Reino Unido","República Centroafricana","República Checa","República de Macedonia","República del Congo","República Democrática del Congo","República Dominicana","República Sudafricana","Ruanda","Rumanía","Rusia","Samoa","San Cristóbal y Nieves","San Marino","San Vicente y las Granadinas","Santa Lucía","Santo Tomé y Príncipe","Senegal","Serbia","Seychelles","Sierra Leona","Singapur","Siria","Somalia","Sri Lanka","Suazilandia","Sudán","Sudán del Sur","Suecia","Suiza","Surinam","Tailandia","Tanzania","Tayikistán","Timor Oriental","Togo","Tonga","Trinidad y Tobago","Túnez","Turkmenistán","Turquía","Tuvalu","Ucrania","Uganda","Uruguay","Uzbekistán","Vanuatu","Venezuela","Vietnam","Yemen","Yibuti","Zambia","Zimbabue"];

$complexions = [
    "Delgada",
    "Media/Normal",
    "Media/Gruesa",
    "Muy delgada",
    "Rellenita",
    "Tonificada",
    "Voluptuosa"
];

$working_days = [
    "Full time",
    "Fines de semana",
    "Días de semana"
];

$sexual_orientations = [
    "Heterosexual",
    "Homosexual",
    "Bisexual activa",  
    "Bisexual pasiva",  
    "Bisexual interactiva"
];

$eyes_colors = [
    "Cafés",
    "Miel",
    "Negros", 
    "Verdes",
    "Azules", 
    "Grises"
];

$depilations = [
    "Completa",
    "Area de Bikini",
    "Sin depilar"
];

/******** Escorts ********/

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
        'show_in_nav_menus' => true,
        'rewrite' => [
            "slug" => 'servicio'
        ]
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
        'show_in_nav_menus' => true,
        'rewrite' => [
            "slug" => "ciudad"
        ]
    ];
 
    register_taxonomy( 'escorts_zones', 'escort', $args );
}  
add_action( 'init', 'add_escorts_service_taxonomy');


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
			"supports" => ["title", "thumbnail", "custom-fields", "editor", "the_excerpt", "author"]
		]
    );

}
add_action('init', 'add_escort_type');



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
    
    GLOBAL $ages, $hair_colors, $skin_colors, $langs, $phone_permissions, $countries, $eyes_colors, $complexions, $sexual_orientations, $depilations;
    

    $post_id = $post->ID;
    //Escort Metas
    $meta_email = get_post_meta($post_id, "escort_email", true);
    $meta_age = get_post_meta($post_id, "escort_age", true);
    $meta_stature = get_post_meta($post_id, "escort_stature", true);
    $meta_weight = get_post_meta($post_id, "escort_weight", true);
    $meta_langs = (get_post_meta($post_id, "escort_langs", true)) ? get_post_meta($post_id, "escort_langs", true) : [] ;
    $meta_skin_color = get_post_meta($post_id, "escort_skin_color", true);
    $meta_hair_color = get_post_meta($post_id, "escort_hair_color", true);
    //$meta_profession = get_post_meta($post_id, "escort_profession", true);
    $meta_measure = (get_post_meta($post_id, "escort_measure", true)) ? get_post_meta($post_id, "escort_measure", true) : [];
    $meta_phone = (get_post_meta($post_id, "escort_phone", true)) ? get_post_meta($post_id, "escort_phone", true) : [];

    //nuevos campos
    $meta_eyes_color = get_post_meta($post_id, "escort_eyes_color", true);
    $meta_complexion = get_post_meta($post_id, "escort_complexion", true);
    $meta_origin = get_post_meta($post_id, "escort_origin", true);
    $meta_sexual_orientation = get_post_meta($post_id, "escort_sexual_orientation", true);
    $meta_depilation = get_post_meta($post_id, "escort_depilation", true);
  


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

    <!-- MEDIDAS -->
    <label><b>Medidas:</b></label>
    <input type="text" placeholder="Pecho" name="measure[chest]" value="<?php echo ($meta_measure && isset($meta_measure['chest'])) ? $meta_measure['chest'] : "" ?>">
    <input type="text" placeholder="Cintura" name="measure[waist]" value="<?php echo ($meta_measure && isset($meta_measure['waist'])) ? $meta_measure['waist'] : "" ?>">
    <input type="text" placeholder="Caderas" name="measure[hip]" value="<?php echo ($meta_measure && isset($meta_measure['hip'])) ? $meta_measure['hip'] : "" ?>">
    <br>


    <!-- ORIENTACION SEXUAL -->
    <label for="orientacion"><b>Orientacion Sexual:</b></label>
    <select id="orientacion" name="sexual_orientation">
    <?php foreach($sexual_orientations as $sexual_orientation):?>
        <option <?php echo ($meta_sexual_orientation == $sexual_orientation) ?  "selected='selected'" : "" ?>><?php echo $sexual_orientation;?></option>
    <?php endforeach;?>
    </select>
    <br>

    <!-- COLOR DE OJOS -->
    <label for="ojos"><b>Color de Ojos:</b></label>
    <select id="ojos" name="eyes_color">
    <?php foreach($eyes_colors as $eyes_color):?>
        <option <?php echo ($meta_eyes_color == $eyes_color) ?  "selected='selected'" : "" ?>><?php echo $eyes_color;?></option>
    <?php endforeach;?>
    </select>
    <br>

    <!-- ORIGIN -->
    <label for="nacionalidad"><b>Nacionalidad:</b></label>
    <select id="nacionalidad" name="origin">
    <?php foreach($countries as $country):?>
        <option <?php echo ($meta_origin == $country) ?  "selected='selected'" : "" ?>><?php echo $country;?></option>
    <?php endforeach;?>
    </select>
    <br>

    <!-- COMPLEXION -->
    <label for="nacionalidad"><b>Complexión:</b></label>
    <select id="nacionalidad" name="complexion">
    <?php foreach($complexions as $complexion):?>
        <option <?php echo ($meta_complexion == $complexion) ?  "selected='selected'" : "" ?>><?php echo $complexion;?></option>
    <?php endforeach;?>
    </select>
    <br>

    <!-- DEPILATION -->
    <label for="depilation"><b>Complexión:</b></label>
    <select id="depilation" name="depilation">
    <?php foreach($depilations as $depilation):?>
        <option <?php echo ($meta_depilation == $depilation) ?  "selected='selected'" : "" ?>><?php echo $depilation;?></option>
    <?php endforeach;?>
    </select>
    <br>


    <?php

}

/****  META BOX de TARIFAS ***/
function escort_rates_metabox_html($post){

    GLOBAL $rates, $payment_methods, $working_days;

    $post_id = $post->ID;
    $meta_rates = (get_post_meta($post_id, "escort_rates", true)) ? get_post_meta($post_id, "escort_rates", true) : [];
    $meta_payment_methods = (get_post_meta($post_id, "escort_payment_methods", true)) ? get_post_meta($post_id, "escort_payment_methods", true) : [] ;
    $meta_working_days = get_post_meta($post_id, "escort_working_days", true);


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

    <!-- WORKING DAYS -->
    <label for="habiles"><b>Dias de Atención:</b></label>
    <select id="habiles" name="working_days">
    <?php foreach($working_days as $working_day):?>
        <option <?php echo ($meta_working_days == $working_day) ?  "selected='selected'" : "" ?>><?php echo $working_day;?></option>
    <?php endforeach;?>
    </select>
    <br>

    <?php
   
}



function upload_attachments_escorts_ads($escort_ad_id, $file){

    if ( !function_exists( 'wp_handle_upload' ) ) {
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
    }
    
    $uploaded_file = $file;
    
    $upload_overrides = ['test_form' => false ];
    
    $moved_file = wp_handle_upload( $uploaded_file, $upload_overrides );
    
    if ( !$moved_file || isset( $moved_file['error'] ) ) {

        return;
    } 

    $date = date_create();
    $unix = date_timestamp_get($date);

    $attachment = [
        'guid'           => $moved_file["url"], 
        'post_mime_type' => $moved_file['type'],
        'post_title'     => "escort-".$unix,
        'post_content'   => '',
        'post_status'    => 'inherit'
    ];

    $attach_id = wp_insert_attachment( $attachment, $moved_file["file"], $escort_ad_id );

    if(!$attach_id){
        
        return;
    }

        

    require_once( ABSPATH . 'wp-admin/includes/image.php' );

    $attach_data = wp_generate_attachment_metadata( $attach_id, $moved_file["file"] );

    $updated_data = wp_update_attachment_metadata( $attach_id, $attach_data );

    return $attach_id;

}


function handle_attachments_escorts_ads($escort_ad_id, $images, $multiple = false){


    if($multiple){//multiples archivos

        $attachs_ids = [];

        $images = do_cleaner_array($images);

        foreach($images as $image){
            $attach_id = upload_attachments_escorts_ads($escort_ad_id, $image);

            if($attach_id){
                $attachs_ids[] = $attach_id;
            }
            
        }       
    
        return $attachs_ids;

    } else {//solo un archivo
     
        $attach_id = upload_attachments_escorts_ads($escort_ad_id, $images);
    
        $post_meta_id = set_post_thumbnail( $escort_ad_id, $attach_id );

        return $post_meta_id;
    
    }    

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

    if(isset($_POST["eyes_color"])){
        $eyes_color = $_POST["eyes_color"];
        update_post_meta($post_id, "escort_eyes_color", $eyes_color );
    }

    if(isset($_POST["sexual_orientation"])){
        $sexual_orientation = $_POST["sexual_orientation"];
        update_post_meta($post_id, "escort_sexual_orientation", $sexual_orientation );
    }

    if(isset($_POST["origin"])){
        $origin = $_POST["origin"];
        update_post_meta($post_id, "escort_origin", $origin );
    }

    if(isset($_POST["complexion"])){
        $complexion = $_POST["complexion"];
        update_post_meta($post_id, "escort_complexion", $complexion );
    }

    if(isset($_POST["working_days"])){
        $working_days = $_POST["working_days"];
        update_post_meta($post_id, "escort_working_days", $working_days );
    }

    if(isset($_POST["depilation"])){
        $depilation = $_POST["depilation"];
        update_post_meta($post_id, "escort_depilation", $depilation );
    }

      /*
    if(isset($_POST["profession"])){
        $profession = $_POST["profession"];
        update_post_meta($post_id, "escort_profession", $profession );
    }*/

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
               
                remove_action(' post_updated', 'admin_save_escort');

                $update_subscription_args = [
                    "ID" => $subscription_id,
                    "post_status" => "paid"
                ];

                $updated_subscription = wp_update_post($update_subscription_args);

                add_action('post_updated', 'admin_save_escort');
            }
        }

    }

    //AGREGAR SERVICIOS y ZONA A UN ANUNCIO
    if(isset( $_POST["zone"])){
        $services_raw = $_POST["services"];
        $services = [];
        foreach($services_raw as $service_raw){
            $services[] = (int) $service_raw;
        }   

        wp_set_object_terms( $post_id, $services, 'escorts_services');
    
    }

    if(isset( $_POST["zone"])){

        $zone = (int) $_POST["zone"];
        
        wp_set_object_terms( $post_id, $zone , 'escorts_zones');

    }
    
    //eliminar imagenes viejas
    if(isset($_POST["delete_images"])){

        $old_images = $_POST["delete_images"];

        foreach($old_images as $old_image){
            wp_delete_attachment($old_image, true );
        }

    }

    //subir imagen destacada
    if(isset($_FILES["featured_image"]) && $_FILES["featured_image"]["name"]){

        if(has_post_thumbnail($post_id)){
            $thumbnail_id = get_post_thumbnail_id( $post_id );
            wp_delete_attachment( $thumbnail_id, true);
        }

        //carga de imagen destacada
        $uploaded_featured_image = $_FILES["featured_image"];
        
        $attach_id = handle_attachments_escorts_ads($post_id, $uploaded_featured_image);

        $post_meta_id = set_post_thumbnail( $post_id, $attach_id );

    }
    
    //subir nuevas imagenes
    if(isset($_FILES["images"])){

        $uploaded_images = $_FILES["images"];

        $attachs_ids = handle_attachments_escorts_ads($post_id, $uploaded_images, true); 

    }

    if(isset($_FILES["video"])){

        $media = get_escort_ad_attachments($post_id);

        if(count($media["videos"])){
            $videos = $media["videos"];
            foreach($videos as $video){
                wp_delete_attachment( $video["ID"], true);
            }
        }

        $uploaded_video = $_FILES["video"];

        $attach_id = handle_attachments_escorts_ads($post_id, $uploaded_video); 

    }
}

add_action('post_updated', 'admin_save_escort', 10, 2);




function get_escort_ad_attachments($escort_ad_id){

    $escort_thumbnail_id = get_post_thumbnail_id( $escort_ad_id  ); 

    //obtener todas las imagenes del anuncio
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
    
    //obtener videos del anuncio
    $videos_raw = get_attached_media("video/*", $escort_ad_id );

    $videos = [];

    foreach($videos_raw as $video_raw){

        $video_url = wp_get_attachment_url($video_raw->ID);

        $video = [
            "ID" => $video_raw->ID,
            "url" => $video_url
        ];

        $videos[] = $video;
    }


    $media = [
        "images" => $images,
        "videos" => $videos
    ];

    return $media;

}

function get_escort_ad_services($escort_ad_id){

    $services_raw = get_the_terms( $escort_ad_id, "escorts_services" );

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

    return $services;
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
    //$meta_profession = get_post_meta($id, "escort_profession", true);
    $meta_measure = (get_post_meta($id, "escort_measure", true)) ? get_post_meta($id, "escort_measure", true) : [];
    $meta_phone = (get_post_meta($id, "escort_phone", true)) ? get_post_meta($id, "escort_phone", true) : [];


    $meta_eyes_color = get_post_meta($id, "escort_eyes_color", true);
    $meta_complexion = get_post_meta($id, "escort_complexion", true);
    $meta_origin = get_post_meta($id, "escort_origin", true);
    $meta_sexual_orientation = get_post_meta($id, "escort_sexual_orientation", true);
    $meta_working_days = get_post_meta($id, "escort_working_days", true);

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

    $services = get_escort_ad_services($id);    

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
            //"profession" => $meta_profession,
            "weight" => $meta_weight,
            "age" => $meta_age,
            "stature" => $meta_stature,
            "phone" => $phone,
            "email" => $meta_email,
            "eyes_color" => $meta_eyes_color,
            "complexion" => $meta_complexion,
            "origin" => $meta_origin,
            "sexual_orientation" => $meta_sexual_orientation

        ],
        "rates" => $rates_with_labels,
        "principal_rate" => $rates_with_labels[2],
        "payment_methods" => $payment_methods_with_labels,
        "working_days" => $meta_working_days,
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
        

        $tax_query = [];
        $meta_query = [];

        //busquedas de un termino especifico en una taxonomia
        if(isset($options["taxonomy"]) && isset($options["term"])){

            $taxonomy = $options["taxonomy"];
            $term = $options["term"];
            
            $tax_query[] = [
                'taxonomy' => $taxonomy,
                'field' => 'slug',
                'terms' => $term
                //'include_children' => false
            ];
        }


        //busquedas de serivicios especificos por su ID
        if(isset($options["services"])){

            $services_id = $options["services"];

            foreach($services_id as $service_id){
                $tax_query[] = [
                    'taxonomy' => 'escorts_services',
                    'field' => 'term_id',
                    'terms' => $service_id
                ];
            }
        }

        //busquedas de zonas especificos por su ID
        if(isset($options["zone"])){

            $zone_id = $options["zone"];
          
            $tax_query[] = [
                'taxonomy' => 'escorts_zones',
                'field' => 'term_id',
                'terms' => $zone_id
            ];
        }


        //busqueda por caracteristicas

        if(isset($options["basic_info"])){
            
            $basic_info = $options["basic_info"];

            foreach($basic_info as $key => $info){
                
                switch ($key){

                    case "skin_color": 
                    case "hair_color":
                    case "eyes_color":
                    case "sexual_orientation":
                    case "complexion":
                    case "age":
                    case "working_days":

                        $meta_query[] = [
                            "key" => "escort_".$key,
                            "value" => $info,
                            "compare" => "="
                        ];
                        break;

                    case "stature":

                        switch ((int) $info){
                            case 1:
                                $value = 160;
                                $operator = "<=";
                                break;
                            case 2:
                                $value = 170;
                                $operator = "<=";
                                break;
                            case 3:
                                $value = 170;
                                $operator = ">=";
                                break;
                        }


                        $meta_query[] = [
                            "key" => "escort_".$key,
                            "value" => $value,
                            "compare" => $operator,
                            "type" => "NUMERIC"
                        ];
                }

            }            

        }

        $args['meta_query'] = $meta_query;
        $args['tax_query'] = $tax_query;

        //limite
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
            
            if($escort["subscription"]["plan"]["name"] != "free" && $escort["subscription"]["status"] == 'default'){
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

function prepare_escorts_by_custom_search (){

    $custom_options = [];


    if(isset($_GET["services"])){

        $services = $_GET["services"];
        $custom_options["services"] = $services;

    }

    if(isset($_GET["zone"]) && $_GET["zone"]){

        $zone = $_GET["zone"];
        $custom_options["zone"] = $zone;

    }

    if(isset($_GET["basic_info"])){

        $basic_info = [];

        $data = $_GET["basic_info"];

        foreach($data as $key => $info){
            
            if($info){
                $basic_info[$key] = $info;
            }

        }

        if($basic_info){
            $custom_options["basic_info"] = $basic_info;
        }
        

    }

    $escorts = get_escorts($custom_options);

    set_query_var( 'escorts', $escorts );
}


function images_report(){
    

    if(!isset($_POST['report_nonce']) || !wp_verify_nonce( $_POST['report_nonce'], 'escort-report-image' )){
        wp_redirect(home_url());
        die;
        return;
    }
    

    if(!isset($_POST["id"]) || !isset($_POST["url"])){
        wp_redirect(home_url());
        die;
        return;
    }

    $report_url = $_POST["url"];
    $escort_ad_id = $_POST["id"];

    $escort_ad = get_post($escort_ad_id);

    if(!$escort_ad){
        wp_redirect(home_url());
        die;
        return;
    }

    $escort_ad_url = get_post_permalink($escort_ad);
    $escort_ad_title = $escort_ad->post_title;

    $admin_email = get_bloginfo('admin_email');
    $message = "<p>Se ha denunciado el siguiente anuncio: </p>".
                "<a href='".$escort_ad_url."'>".$escort_ad_title."</a>".
                "<p>Sus fotos pueden encontrarse en:</p>".
                "<a href='".$report_url."'>".$report_url."</a>";

    print_r($message);
    wp_mail($admin_email, 'Denuncia de Imagen', $message);

    wp_redirect($escort_ad_url);
    die;
}

add_action( 'admin_post_nopriv_report_image', 'images_report' );
add_action( 'admin_post_priv_report_image', 'images_report' );

?>