<?php 

function get_carousel_images(){

$xcorts_images = get_option( 'xcorts_carousel', [] );

$xcorts_images = ($xcorts_images) ? $xcorts_images : []; 

$xcorts_slides = [];
foreach($xcorts_images as $xcorts_image ){

    $image_url_array = wp_get_attachment_image_src( $xcorts_image, 'full' );
    $is_valid = is_array( $image_url_array );

    if( $is_valid ){
        $xcorts_slides[] = [
            "url" => $image_url_array[0],
            "ID" => $xcorts_image
        ];        
    }
   
}

return $xcorts_slides;
}


function meta_index_tag(){

GLOBAL $account_slug, $login_slug, $subscription_slug;

$whitelist = [$account_slug, $login_slug, $subscription_slug];

$xcorts = get_option( 'xcorts', []);

$xcorts_must_hide = (isset($xcorts["hide_robots"])) ? true : false;

foreach($whitelist as $page_slug){
   
    if( is_page($page_slug)){
        echo '<meta name="robots" content="noindex,nofollow">';
        return;
    }
}   

if(!$xcorts_must_hide || is_front_page()){
    return;
}
echo '<meta name="robots" content="noindex,nofollow">';
}

function xcorts_title(){

$xcorts = get_option( 'xcorts', []);

$xcorts = (isset($xcorts["principal_title"])) ? $xcorts["principal_title"] : false;

if(!$xcorts){
    return;
}

echo $xcorts;

}

function xcorts_description(){
$xcorts = get_option( 'xcorts', []);

$xcorts = (isset($xcorts["principal_description"])) ? $xcorts["principal_description"] : false;

if(!$xcorts){
    return;
}

echo $xcorts;
}


function xcorts_admin_page($hook) {

if($hook != 'toplevel_page_xcorts_theme') {
    return;
}
wp_enqueue_media();

wp_enqueue_script( 'xcorts_admin_page', get_template_directory_uri() . '/assets/js/escort_admin_page.js' );
}
add_action( 'admin_enqueue_scripts', 'xcorts_admin_page' );


//seccion de textos
function xcorts_section_1_callback (){
echo "Titulo y descripción de la página de inicio";
}

function xcorts_principal_title_setting_callback(){

$xcorts = get_option( 'xcorts' );
?>

<input type="text"  class="code" style="width: 100%; max-width:600px" name="xcorts[principal_title]" value="<?php echo $xcorts['principal_title']; ?>"/>

<?php 
}

function xcorts_principal_description_setting_callback(){


$xcorts = get_option( 'xcorts' );

?>
 <textarea class="code" rows="4" style="width: 100%; max-width:600px" name="xcorts[principal_description]"><?php echo $xcorts['principal_description']; ?></textarea>

<?php 
}

//seccion de disuadir navegadores
function xcorts_section_2_callback(){
echo "Control de visibilidad para robots";
}

function xcorts_hide_robots_setting_callback(){

$xcorts = get_option( 'xcorts' );

$value = (isset($xcorts['hide_robots'])) ? $xcorts['hide_robots'] : false ;

?>
 <input type="checkbox" name="xcorts[hide_robots]" value="1" <?php checked(1, $value); ?> />

<?php 
}

//seccion de carrousel
function xcorts_section_3_callback(){
echo "Carrusel de Portada";
}

function xcorts_carousel_setting_callback(){

$xcorts_slides = get_carousel_images();

?>

<div style="display:none;" class="xcorts-caption-template">
    <div id="0" style="position: relative; display: inline-block: width: 80%">
        <details>
            <summary style="outline: none; cursor:pointer;"></summary>
            <button class="button button-primary delete-image" style="position:absolute; top: 10%; right: 5%; color: white; font-weight: bold; cursor: pointer " data-id="0" type="button">Eliminar</button>
            <img style="max-width:100%;" src="">
        </details>
    </div>
</div>


<div class="xcorts-carousel-input-container">
    <?php foreach($xcorts_slides as $xcorts_slide):?>
        <input type="hidden" name="xcorts_carousel[]"  value="<?php echo $xcorts_slide['ID'];?>"/>
    <?php endforeach;?>
</div>

<div class="xcorts-carousel-image-container">
    <?php foreach($xcorts_slides as $key => $xcorts_slide):?>
        <div id="<?php echo $xcorts_slide['ID'];?>" style="position: relative; display: inline-block: width: 80%">
            <details>
                <summary style="outline: none; cursor:pointer;">Imagen #<?php echo $key+1; ?></summary>
                <button class="button button-primary delete-image" style="position:absolute; top: 10%; right: 5%; color: white; font-weight: bold; cursor: pointer " data-id="<?php echo $xcorts_slide['ID'];?>" type="button">Eliminar</button>
                <img style="max-width:100%;" src="<?php echo $xcorts_slide['url'];?>"/>
            </details>
        </div>            
    <?php endforeach;?>
</div>
<br>
<button class="xcorts-carousel-change-images button button-primary">Cambiar Imagenes</button>

<?php 
}



function add_settings_theme_pages(){

//seccion de textos
add_settings_section(
    'xcorts_section_1',
    'Textos de Portada',
    'xcorts_section_1_callback',
    'xcorts_theme'
);

 add_settings_field(
    'xcorts_principal_title',
    'Titulo Principal',
    'xcorts_principal_title_setting_callback',
    'xcorts_theme',
    'xcorts_section_1'
);

add_settings_field(
    'xcorts_principal_description',
    'Descripción del sitio',
    'xcorts_principal_description_setting_callback',
    'xcorts_theme',
    'xcorts_section_1'
);

//seccion de textos
add_settings_section(
    'xcorts_section_2',
    'Visibilidad',
    'xcorts_section_2_callback',
    'xcorts_theme'
);

add_settings_field(
    'xcorts_hide_robots',
    'Disuadir Robots',
    'xcorts_hide_robots_setting_callback',
    'xcorts_theme',
    'xcorts_section_2'
);

//seccion de textos
add_settings_section(
    'xcorts_section_3',
    'Carrusel Principal',
    'xcorts_section_3_callback',
    'xcorts_theme'
);

add_settings_field(
    'xcorts_carousel',
    'Imagenes para Carrusel',
    'xcorts_carousel_setting_callback',
    'xcorts_theme',
    'xcorts_section_3'
);


register_setting( 'xcorts_theme', 'xcorts' );
register_setting( 'xcorts_theme', 'xcorts_carousel' );
}

add_action ('admin_init', 'add_settings_theme_pages');


function theme_admin_page_html(){

?>
<form method="POST" action="options.php">
<?php 

    settings_fields( 'xcorts_theme' );
    do_settings_sections( 'xcorts_theme' ); 
    submit_button();
?>
</form>
<?php 

}

function add_theme_admin_pages(){
add_menu_page("Xcorts Theme",  "Xcorts Theme", "manage_options", "xcorts_theme", "theme_admin_page_html" );
}


add_action( 'admin_menu', 'add_theme_admin_pages' );



