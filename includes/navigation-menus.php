<?php 
    
    function escorts_menu() {
        register_nav_menus(
            [    
                'principal-menu' => "Menú principal",
                'footer-menu' => "Menú del Footer"
            ]        
        );
    }
    add_action( 'init', 'escorts_menu' );


    function build_tree( array &$elements, $parent_id = 0 )
    {
        $branch = [];
        foreach ( $elements as &$element )
        {
            if ( $element->menu_item_parent == $parent_id )
            {
                $children = build_tree( $elements, $element->ID );
                if ( $children )
                    $element->childrens = $children;

                $branch[$element->ID] = $element;
                unset( $element );
            }
        }
        return $branch;
    }


function wpse_nav_menu_2_tree( $menu_id )
{
    $items = wp_get_nav_menu_items( $menu_id );
    return  $items ? build_tree( $items, 0 ) : null;
}


function get_single_menu($theme_location){

    if(($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
        
        $menu = get_term( $locations[$theme_location], 'nav_menu' );
        $menu_items = wpse_nav_menu_2_tree($menu->term_id);

        return $menu_items;
    }
}

?>