<?php 


$page_definitions = [
    'escort-login' => [
        'title' => "Login",
        'content' => ''
    ],
    'escort-account' => [
        'title' => "Tu cuenta",
        'content' => ''
    ],
    'escort-subscription' => [
        'title' => "Anunciate",
        'content' => ''
    ]
];


function add_escort_role(){
    $escort_role = get_role("escort_user");
    if(!$escort_role){
        add_role('escort_user', 'Escort' );
    }
}
add_action('after_setup_theme','add_escort_role');


function add_accounts_pages(){

    GLOBAL $page_definitions;

    foreach ( $page_definitions as $slug => $page ) {
    
        $post_page = get_page_by_path($slug);
        
        if ( !$post_page ) {
            wp_insert_post(
                [
                    'post_content'   => $page['content'],
                    'post_name'      => $slug,
                    'post_title'     => $page['title'],
                    'post_status'    => 'publish',
                    'post_type'      => 'page',
                    'ping_status'    => 'closed',
                    'comment_status' => 'closed',
                ]
            );
        }
    }

}

add_action('init','add_accounts_pages');


function escort_login_redirect()
{
    $account_slug = 'escort-account';
    $login_slug = 'escort-login';

    if( is_page($account_slug) && ! is_user_logged_in() ) //sacar al usuario no logeado del area de Mi cuenta
    {
        $post_page = get_page_by_path($login_slug);
        wp_redirect( home_url() );
        die;
    }

    if( is_page($login_slug ) && is_user_logged_in() ) //sacar al usuario logeado del area de Login
    {
        $post_page = get_page_by_path($login_slug);
        wp_redirect( home_url() );
        die;
    }


}
add_action( 'template_redirect', 'escort_login_redirect' );


function add_new_escort(){
  //print_r($_POST);

    $nonce = $_POST['escort_nounce'];
    
    if(!wp_verify_nonce( $nonce, 'escort-register-account' )){
        echo "ERROR DE NONCE";
        return;
    }

    $username = wp_strip_all_tags($_POST["username"]);
    $password = wp_strip_all_tags($_POST["password"]);
    $email = wp_strip_all_tags($_POST["email"]);
    $first_name = wp_strip_all_tags($_POST["first_name"]);
    $last_name = wp_strip_all_tags($_POST["last_name"]);
    $visible_name = wp_strip_all_tags($_POST["visible_name"]);
    
    $description = wp_strip_all_tags($_POST['description']);



    $user_id = username_exists( $username );
    if ( !$user_id and email_exists($email) == false ) {
        
        $user_data = [
            'user_login'  =>  $username,
            'user_pass'    =>  $password,
            'role'   => 'escort_user',
            'user_email' => $email,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'display_name' => $visible_name
        ];
        $user_id = wp_insert_user( $user_data ) ;

    } else {
        echo "Error Al crear el usuario";
        return;
    }

    $escort_data = [
        'post_title'    =>  $visible_name,
        'post_content'  => $description,
        'post_author'   => $user_id,
        'post_type' => 'escort' 
    ];
   
    $escort_ad_id = wp_insert_post( $escort_data );

    if(!$escort_ad_id){
        echo "error al crear el post";
        return;
    }

    $escort_ad_object = get_post($escort_ad_id);

    admin_save_escort($escort_ad_id,$escort_ad_object );

    if ( ! function_exists( 'wp_handle_upload' ) ) {
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
    }
    
    $uploaded_featured_image = $_FILES["featured_image"];
    
    $upload_overrides = ['test_form' => false ];
    
    $featured_image_file = wp_handle_upload( $uploaded_featured_image, $upload_overrides );
    
    if ( !$featured_image_file || isset( $featured_image_file['error'] ) ) {
        return;
    } 

    $attachment = [
        'guid'           => $featured_image_file["url"], 
        'post_mime_type' => $featured_image_file['type'],
        'post_title'     => "escort-featured-image-".$escort_ad_id,
        'post_content'   => '',
        'post_status'    => 'inherit'
    ];

    $attach_id = wp_insert_attachment( $attachment, $featured_image_file["file"], $escort_ad_id );

    if(!$attach_id){
        echo "fallo en insertar el attachment";
        return;
    }

    require_once( ABSPATH . 'wp-admin/includes/image.php' );

    $attach_data = wp_generate_attachment_metadata( $attach_id, $featured_image_file["file"] );

    $updated_data = wp_update_attachment_metadata( $attach_id, $attach_data );

    $post_meta_id = set_post_thumbnail( $escort_ad_id, $attach_id );

    if(!$post_meta_id){
        echo "error al setear post thumbnail";
        return;
    };


    print_r($_FILES["images"]);



 

}

add_action( 'admin_post_nopriv_add_new_escort', 'add_new_escort' );
add_action( 'admin_post_add_new_escort', 'add_new_escort' );
?>