<?php

add_action( 'init', 'pizzapranks_post_types' );

function pizzapranks_post_types() {
	$labels = array(
		"name" => __( 'I Have Stabbed... Chapters', '' ),
		"singular_name" => __( 'I Have Stabbed... Chapter ', '' ),
		);

	$args = array(
		"label" => __( 'I Have Stabbed... Chapters', '' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "stabbed_chapter", "with_front" => true ),
		"query_var" => true,
				
		"supports" => array( "title", "editor", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "thumbnail", "author", "page-attributes", "post-formats" ),				
	);
	register_post_type( "stabbed_chapter", $args );

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
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
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