<?php 

/* ***** SIDEBARS **** */

function escorts_sidebars(){

	register_sidebar(
		[
		"name" => __("Footer 1"),
		"id" => __("escorts_footer_1"),
		"before_widget" => "<div class='escorts-widget footer-1'>",
		"after_widget" => "</div>",
		"before_title" => "<div class='escorts-widget-title'>",
		"after_title" => "</div>" 
		]
	);

	register_sidebar(
		[
		"name" => __("Footer 2"),
		"id" => __("escorts_footer_2"),
		"before_widget" => "<div class='escorts-widget footer-2'>",
		"after_widget" => "</div>",
		"before_title" => "<div class='escorts-widget-title'>",
		"after_title" => "</div>" 
		]
	);
}

add_action("init", "escorts_sidebars");

?>