<?php

add_image_size( 'watermark', 400, 400);


function add_watermark_admin_pages(){
    add_submenu_page("xcorts_theme", "Xcorts Watermark",  "Xcorts Watermark", "manage_options", "xcorts_watermark", "watermark_admin_page_html" );
}
    
    
add_action( 'admin_menu', 'add_watermark_admin_pages', 20);


function watermark_admin_page_html(){
    ?>
    <form name="form" method="POST" action="options.php">
    <?php 

        settings_fields( 'xcorts_watermark' );
        do_settings_sections( 'xcorts_watermark' ); 
        submit_button();
    ?>
    </form>
    <?php
}


function xcorts_watermark_section_html(){

    $xcorts_watermark_image = get_option("xcorts_watermark_image", false);
    
    if($xcorts_watermark_image):
        ?>
        <img style="max-width: 300px;" src="<?php echo $xcorts_watermark_image;?>"/>
        <?php
    else:
        ?>
        <b style="color:red;">No hay Marca de agua definida</b>
        <?php
    endif;
    
}

function xcorts_watermark_active_html(){

    $xcorts_watermark_active = get_option("xcorts_watermark_active", '');

    ?>
    <input type="checkbox" name="xcorts_watermark_active" value="true" <?php checked( 'true', $xcorts_watermark_active );?>/>
    <?php
}

function xcorts_watermark_image_html(){

    $xcorts_watermark_image = get_option("xcorts_watermark_image", '');

    ?>
    <input type="text" name="xcorts_watermark_image" value="<?php echo $xcorts_watermark_image;?>"/>
    <?php

}

function xcorts_do_watermark_section_html(){

    echo 'Esta sección controla la ejecución de la marca de agua';

}


function xcorts_watermark_do_massive_html(){

    ?>
    <input type="checkbox" name="xcorts_watermark_do_massive" value="true"/>
    <?php

}
function xcorts_watermark_do_uploads_html(){

    $xcorts_watermark_do_uploads = get_option("xcorts_watermark_do_uploads", '');

    ?>
    <input type="checkbox" name="xcorts_watermark_do_uploads" value="true" <?php checked( 'true', $xcorts_watermark_do_uploads );?>/>
    <?php

}

function handle_xcorts_watermark_do_massive($option){

    if($option != 'true'){
        return '';
    }

    escorts_do_massive_watermark();
    return '';

}


function add_settings_watermark_pages(){

    //seccion de textos
    add_settings_section(
        'xcorts_watermark_section',
        'Configuración de la marca de agua',
        'xcorts_watermark_section_html',
        'xcorts_watermark'
    );

    add_settings_field(
        'xcorts_watermark_image',
        'Cargar Marca de agua',
        'xcorts_watermark_image_html',
        'xcorts_watermark',
        'xcorts_watermark_section'
    );

    add_settings_field(
        'xcorts_watermark_active',
        'Mostrar Marca de agua en el sitio',
        'xcorts_watermark_active_html',
        'xcorts_watermark',
        'xcorts_watermark_section'
    );    
    
    register_setting( 'xcorts_watermark', 'xcorts_watermark_active' );
    register_setting( 'xcorts_watermark', 'xcorts_watermark_image' );
    

    //seccion de ejecucion
    add_settings_section(
        'xcorts_do_watermark_section',
        'Ejecución de la marca de agua',
        'xcorts_do_watermark_section_html',
        'xcorts_watermark'
    );

    add_settings_field(
        'xcorts_watermark_do_uploads',
        'Ejecutar en nuevas cargas',
        'xcorts_watermark_do_uploads_html',
        'xcorts_watermark',
        'xcorts_do_watermark_section'
    ); 

    add_settings_field(
        'xcorts_watermark_do_massive',
        'Regenerar Marca de Agua másivamente (Esta acción puede llevar varios minutos)',
        'xcorts_watermark_do_massive_html',
        'xcorts_watermark',
        'xcorts_do_watermark_section'
    );

     

    register_setting( 'xcorts_watermark', 'xcorts_watermark_do_massive', 'handle_xcorts_watermark_do_massive'  );
    register_setting( 'xcorts_watermark', 'xcorts_watermark_do_uploads');


}

add_action ('admin_init', 'add_settings_watermark_pages');



function generate_escort_watermarked_image( $meta, $attachment_id ) {

    if (!wp_attachment_is_image( $attachment_id )){
        return;
    }

    $xcorts_watermark_image = get_option("xcorts_watermark_image", '');

    if(!$xcorts_watermark_image){
        return;
    } 

    $escort_ad_id = wp_get_post_parent_id($attachment_id);

    if(!$escort_ad_id){
        return;
    }

    $escort_ad = get_post($escort_ad_id);

    if(!$escort_ad || $escort_ad->post_type != 'escort'){
        return;
    }

    $time = substr( $meta['file'], 0, 7); // Extract the date in form "2015/04"
    $upload_dir = wp_upload_dir( );
  
    $filename = $meta['file'];

    $watermarked_file = escort_watermark_image( $filename, $upload_dir, $xcorts_watermark_image );

    update_post_meta($attachment_id, 'escort_watermarked', $watermarked_file);
  
}
  
//add_filter( 'wp_generate_attachment_metadata', 'generate_escort_watermarked_image', 10, 2 );

function escort_watermark_image( $filename, $upload_dir, $watermark_image ) {

    $original_image_path = trailingslashit( $upload_dir['basedir'] ) . $filename;
  
    $image_resource = new Imagick( $original_image_path );
   
    //$image_resource->blurImage( 20, 10 );

    $watermark_resource = new Imagick($watermark_image);

    // tamaños
    $iWidth = $image_resource->getImageWidth();
    $iHeight = $image_resource->getImageHeight();

    $wWidth = $watermark_resource->getImageWidth();
    $wHeight = $watermark_resource->getImageHeight();

    if ($iHeight < $wHeight || $iWidth < $wWidth) {
        // resize the watermark
        $watermark_resource->scaleImage($iWidth, $iHeight);
    
        // get new size
        $wWidth = $watermark_resource->getImageWidth();
        $wHeight = $watermark_resource->getImageHeight();
    }


    // calculate the position
    $x = ($iWidth - $wWidth) / 2;
    $y = ($iHeight - $wHeight) / 2;

    $image_resource->compositeImage( $watermark_resource, Imagick::COMPOSITE_OVER, $x, $y );
  
    return save_watermarked_image( $image_resource, $original_image_path, $upload_dir );
  
}

function save_watermarked_image( $image_resource, $original_image_path, $upload_dir) {

    $image_data = pathinfo( $original_image_path );
  
    $new_filename = $image_data['filename'] . '-watermarked.' . $image_data['extension'];
  
    $watermarked_image_path = str_replace($image_data['basename'], $new_filename, $original_image_path);
  
    if ( ! $image_resource->writeImage( $watermarked_image_path ) ){
        return $image_data['basename'];
    }
    //unlink( $original_image_path );

    return $new_filename;
  
}


/////////FILTRO PARA DEVOLVER MARCA DE AGUA

add_filter('wp_get_attachment_url', 'escorts_watermark', 10, 2);

function escorts_watermark($url, $escort_attach_id) {

    $xcorts_watermark_active = get_option("xcorts_watermark_active", '');
    $xcorts_watermark_image = get_option("xcorts_watermark_image", '');

    $display_raw = get_query_var( 'display_images_raw', false);

    if(!$xcorts_watermark_active || !$xcorts_watermark_image || $display_raw){
        return $url;
    } 


    $escort_ad_id = wp_get_post_parent_id($escort_attach_id);

    if(!$escort_ad_id){
        return $url;
    }
    
    $escort_ad = get_post($escort_ad_id);

    if($escort_ad->post_type != 'escort'){
        return $url;
    }

    $escort_watermarked_image = get_post_meta($escort_attach_id, 'escort_watermarked', true );


    if(!$escort_watermarked_image){
        return $url;
    }

    return $escort_watermarked_image;
}



function escorts_do_massive_watermark(){

    set_query_var( 'display_images_raw', true);

    $escorts_ads = get_escorts();

    if(!$escorts_ads){
        return;
    }

    foreach($escorts_ads as $escort_ad){
        
        $images = $escort_ad["gallery"];
       
        foreach($images as $image){
          
            $metadata = wp_get_attachment_metadata($image["ID"]);   

            if(!$metadata){
                continue;
            }
            
            generate_escort_watermarked_image($metadata, $image["ID"]);
            
        }
        
    }

}
/*

function text_zzz(){

    escorts_do_massive_watermark(); 

    wp_send_json_success(get_escorts());
}

add_action( 'wp_ajax_nopriv_zzz', 'text_zzz' );
add_action( 'wp_ajax_priv_zzz', 'text_zzz' );

*/


?>