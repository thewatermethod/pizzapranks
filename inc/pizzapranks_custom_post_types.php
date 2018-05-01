<?php

add_action( 'init', 'pizzapranks_post_types' );

function pizzapranks_post_types() {

	$labels = array(
		"name" => __( 'Comics', '' ),
		"singular_name" => __( 'Comic', '' ),
		);

	$args = array(
		"label" => __( 'Comics', '' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "comic", "with_front" => true ),
		"query_var" => true,
				
		"supports" => array( "title", "editor", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "thumbnail", "author", "page-attributes", "post-formats" ),				
	);
	register_post_type( "comic", $args );

}