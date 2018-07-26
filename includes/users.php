<?php 

$account_slug = 'escort-account';
$login_slug = 'escort-login';
$subscription_slug = 'escort-subscription';


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


function escort_page_redirect($page_slug, $query_var = ""){
    $page = get_page_by_path($page_slug);
    $page_url = get_page_link($page->ID);
    if (wp_redirect( $page_url.$query_var)) { die; }
}

function escort_security_redirect()
{
    GLOBAL $account_slug, $login_slug;
    

    if(!is_user_logged_in()){

        if(is_page($account_slug)){
            escort_page_redirect($login_slug);
        }
        return;
    } 



    if( is_page($account_slug)){

        if(current_user_can('escort_user')){
            return;
        }        
        
        wp_redirect( home_url());
        exit;       
        return;
    } else if (is_page($login_slug)){

        if(current_user_can('escort_user')){
            escort_page_redirect($account_slug);
            return;
        } 

        wp_redirect( home_url());
        exit;
     }
}
add_action( 'template_redirect', 'escort_security_redirect' );

function do_cleaner_array(&$files) {

    $file_array = array();
    $file_count = count($files['name']);
    $file_keys = array_keys($files);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_array[$i][$key] = $files[$key][$i];
        }
    }

    return $file_array;
}




function add_new_escort(){
  //print_r($_POST);

    GLOBAL $subscription_slug, $login_slug;

    $nonce = $_POST['escort_nounce'];
    
    if(!wp_verify_nonce( $nonce, 'escort-register-account' )){
        escort_page_redirect($subscription_slug);
        return;
    }

    $username = wp_strip_all_tags($_POST["username"]);
    $password = wp_strip_all_tags($_POST["password"]);
    $email = wp_strip_all_tags($_POST["email"]);
    $first_name = wp_strip_all_tags($_POST["first_name"]);
    $last_name = wp_strip_all_tags($_POST["last_name"]);
    $visible_name = wp_strip_all_tags($_POST["visible_name"]);
    $description = wp_strip_all_tags($_POST['description']);
    $plan = $_POST["plan"];

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

    } else {//error creando el usuario
        escort_page_redirect($subscription_slug);
        return;
    }

    $escort_data = [
        'post_title'    =>  $visible_name,
        'post_content'  => $description,
        'post_author'   => $user_id,
        'post_type' => 'escort',
        'post_status' => 'publish'
    ];
   
    $escort_ad_id = wp_insert_post( $escort_data );

    if(!$escort_ad_id){//error creando el anuncio
        escort_page_redirect($subscription_slug);
        return;
    }

    $plan_name = $plan["name"];
    $plan_type = ($plan["name"] != 'free') ? $plan["type"] : null;

    //nueva suscripcion gratis
    $subscription_id = add_new_subscription($escort_ad_id, $plan_name, $plan_type);
  
    //OBTENEMOS EL POST COMO OBJETO PARA AGREGAR SUS CAMPOS EXTRA
    $escort_ad_object = get_post($escort_ad_id);

    admin_save_escort($escort_ad_id,$escort_ad_object );

    escort_page_redirect($login_slug);

}

add_action( 'admin_post_nopriv_add_new_escort', 'add_new_escort' );
add_action( 'admin_post_add_new_escort', 'add_new_escort' );

//OBTENER LA INFO DE USUARIO DE UNA ESCORT
function get_escort_user_data(){

    if(!is_user_logged_in()){
        return false;
    }

    $escort_user = wp_get_current_user();

    if(!$escort_user || in_array('escort',$escort_user->roles)){
        return false;
    }

    $user = [
        'ID' => $escort_user->ID,
        'first_name' => $escort_user->first_name,
        'last_name' => $escort_user->last_name,
        'username' => $escort_user->user_login,
        'email' => $escort_user->user_email
    ];

    $escort_ad_args = [
        "post_type" => "escort",
        "author" => $escort_user->ID,

    ];

    $escort_ad = get_posts($escort_ad_args);

    if($escort_ad){

        $ad = [
           "ID" => $escort_ad[0]->ID,
           "display_name" => $escort_ad[0]->post_title,
           "description" => $escort_ad[0]->post_content
        ];

        $user["ad"] = $ad;
    }

    return $user;

}


// ACTUALIZAR EL ANUNCIO DE UNA ESCORT DESDE SU PERFIL
function update_escort_ad(){

    GLOBAL $account_slug;

    $query_var = (isset($_POST["redirect_p"])) ? '?p='.$_POST['redirect_p'] : "";

    $escort_user = get_escort_user_data();

    if(!$escort_user){
        escort_page_redirect($account_slug, $query_var);
        return;
    }

    $escort_ad_args = [
        'posts_per_page' => '1',
        'author' => $escort_user['ID'],
        "post_type" => "escort"
    ];

    $escort_ads = get_posts($escort_ad_args);

    if(!$escort_ads || !count($escort_ads) ){
        escort_page_redirect($account_slug, $query_var);
        return;
    }

    $escort_ad = $escort_ads[0];

    $escort_ad_id = $escort_ad->ID;
    
    if(isset($_POST['display_name']) || isset($_POST['description'])) {

        $escort_ad_data = ['ID' => $escort_ad_id];

        if(isset($_POST['display_name'])){

            $escort_ad_display_name = wp_strip_all_tags($_POST['display_name']);
            $escort_ad_data['post_title'] = $escort_ad_display_name;
        
        }

        if(isset($_POST['description'])){

            $escort_ad_description = wp_strip_all_tags($_POST['description']);
            $escort_ad_data['post_content'] = $escort_ad_description;
        }

        $escort_ad_updated = wp_update_post( $escort_ad_data );

       
    } else {

        admin_save_escort($escort_ad_id, $escort_ad);
    }

    escort_page_redirect($account_slug, $query_var);
    

    
    
}

add_action( 'admin_post_nopriv_update_escort_ad', 'update_escort_ad' );
add_action( 'admin_post_update_escort_ad', 'update_escort_ad' );

/*

function verify_email(){
    print_r($_POST);
    $email = $_POST["email"];

    $user_id = username_exists($email);
    
    if($user_id){
        wp_send_json( "false");
        return;
    }

    wp_send_json( "true");

}


add_action( 'wp_ajax_nopriv_verify_email', 'verify_email' );
add_action( 'wp_ajax_verify_email', 'verify_email' );



function verify_username(){


    

}


add_action( 'admin_post_nopriv_verify_email', 'verify_username' );
add_action( 'admin_post_verify_email', 'verify_username' );
*/



function verify_username(WP_REST_Request $request){

    $username = $request->get_param("username");

    $user_id = username_exists($username);
    
    if($user_id){
        return "El usuario ya está en uso";
    }

    return "true";

}


function verify_email(WP_REST_Request $request){

    $email = $request->get_param("email");

    $exists = email_exists($email);
    
    if($exists){
        return "El email ya está en uso";
    }

    return "true";

}



add_action( 'rest_api_init', function () {
            
    register_rest_route( 'escorts/v1', 'verify-username',[

        'methods'  => 'POST',
        'callback' => 'verify_username'

    ]) ;

    register_rest_route( 'escorts/v1', 'verify-email',[

        'methods'  => 'POST',
        'callback' => 'verify_email'

    ]) ;

} );


?>