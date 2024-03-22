<?php

require_once 'inc/pisspranks_custom_post_types.php';

// Load JS
function theme_js(){
    wp_localize_script( 'theme-js', 'wpApiSettings', array(
      'root' => esc_url_raw( rest_url() ),
      'nonce' => wp_create_nonce( 'wp_rest' ),
     ) );     
    wp_register_script( 'theme-js', get_template_directory_uri().'/js/main.js', array(), '1.2', true);
    wp_enqueue_script( 'theme-js');

}

// Load CSS
function theme_styles() {    
    wp_enqueue_style('compiled', get_template_directory_uri().'/style.css');
}

// Register widgets
function pisspranks_widgets_init() {
  register_sidebar( array(
    'name'          =>  'Sidebar Left',
    'id'            =>  'sidebar-1',
    'description'   => '',
    'before_widget' => '<div class="widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
  register_sidebar( array(
    'name'          =>  'Sidebar Right',
    'id'            =>  'sidebar-2',
    'description'   => '',
    'before_widget' => '<div class="widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
}
add_action( 'widgets_init', 'pisspranks_widgets_init' );

//Add menu support
function register_my_menus() {
	register_nav_menus(
		array(
            'main-menu' => 'Main Menu',
			'links-menu' => 'Footer Links',
            'very-top-menu' => 'Very Top Menu'
		)	
	);
}

add_action('wp_enqueue_scripts', 'theme_styles');
add_action('wp_enqueue_scripts', 'theme_js');
add_action( 'init', 'register_my_menus' );

/**
 * Adds the meta box to the posts (download links, etc)
 */


function pp_add_categories_to_attachments() {
    register_taxonomy_for_object_type( 'category', 'attachment' );
}
add_action( 'init' , 'pp_add_categories_to_attachments' );



// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Add some basic theme support stuff
add_theme_support( 'title-tag' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' ); 

/*
    * Switch default core markup for search form, comment form, and comments
    * to output valid HTML5.
    */
add_theme_support( 'html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
) );

function pp_add_featured_image_to_contributors() {
    register_rest_field( 
        'contributor', 
        'featured_image', 
        array( 
            'get_callback' => 
                function ( $post_arr ) {
                    $image_src_arr = wp_get_attachment_image_src( $post_arr['featured_media'], 'medium' );     
                    return $image_src_arr[0];
                }
        ) 
    );
}

add_action('rest_api_init', 'pp_add_featured_image_to_contributors');

