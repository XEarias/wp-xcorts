<?php 


$page_definitions = [
    'escort-login' => [
        'title' => "Login",
        'content' => ''
    ],
    'escort-account' => [
        'title' => "Tu cuenta",
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


/*function escort_login_redirect()
{
    $account_slug = 'escort-account';
    $login_slug = 'escort-login';

    if( is_page($account_slug) && ! is_user_logged_in() ) //sacar al usuario no logeado del area de Mi cuenta
    {
        $post_page = get_page_by_path($login_slug );
        wp_redirect( home_url() );
        die;
    }

    if( is_page($login_slug ) && is_user_logged_in() ) //sacar al usuario logeado del area de Login
    {
        $post_page = get_page_by_path($login_slug );
        wp_redirect( home_url() );
        die;
    }


}
add_action( 'template_redirect', 'escort_login_redirect' );*/


?>