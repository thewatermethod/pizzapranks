<?php

add_action( 'init', 'pisspranks_post_types' );

function pisspranks_post_types() {
		/**
		 * Post Type: Contributors.
		 */
	
		$contributor_labels = [
			"name" => __( "Contributors", "custom-post-type-ui" ),
			"singular_name" => __( "Contributor", "custom-post-type-ui" ),
		];
	
		$contributor_args = [
			"label" => __( "Contributors", "custom-post-type-ui" ),
			"labels" => $contributor_labels,
			"description" => "",
			"public" => true,
			"publicly_queryable" => true,
			"show_ui" => true,
			"show_in_rest" => true,
			"rest_base" => "",
			"rest_controller_class" => "WP_REST_Posts_Controller",
			"has_archive" => false,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"delete_with_user" => false,
			"exclude_from_search" => false,
			"capability_type" => "post",
			"map_meta_cap" => true,
			"hierarchical" => false,
			"rewrite" => [ "slug" => "contributor", "with_front" => true ],
			"query_var" => true,
			"supports" => [ "title", "editor", "thumbnail" ],
			"taxonomies" => [ "post_tag" ],
		];
	
		register_post_type( "contributor", $contributor_args );

}