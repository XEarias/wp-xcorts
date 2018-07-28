<?php 

    get_header();
    
    get_search_form();

    prepare_escorts_by_taxonomy();

    get_template_part("template-parts/escort-list");
    
    get_footer();
?>
