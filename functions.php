<?php

require_once 'inc/pizzapranks_custom_post_types.php';

// Load JS
function theme_js(){

    wp_register_script( 'compiled-js', get_template_directory_uri().'/dist/js/compiled.js',array('jquery'),'false', false);

    wp_localize_script( 'compiled-js', 'wpApiSettings', array(
      'root' => esc_url_raw( rest_url() ),
      'nonce' => wp_create_nonce( 'wp_rest' )
     ) );   
  
    if( is_comic() ){
        wp_register_script( 'apple-kiwi', get_template_directory_uri().'/dist/js/apple-and-kiwi.js',array('jquery', 'compiled-js'),'false', true);
    
        wp_localize_script( 'apple-kiwi', 'wpApiSettings', array(
          'root' => esc_url_raw( rest_url() ),
          'nonce' => wp_create_nonce( 'wp_rest' )
         ) );
      
        wp_enqueue_script( 'apple-kiwi');        
        return;
    } 

    wp_enqueue_script( 'compiled-js');

}

// Load CSS
function theme_styles() {    
 
    wp_enqueue_style('compiled', get_template_directory_uri().'/dist/css/compiled.css');     
      
    //todo - editorstyles.css

}

// Register widgets
function pizzapranks_widgets_init() {
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
add_action( 'widgets_init', 'pizzapranks_widgets_init' );

function the_oldest_comic(){
    $args = array(
        'numberposts'     => 1,
        'offset'          => 0,
        'orderby'         => 'post_date',
        'order'           => 'ASC',
        'post_type'       => 'comic',
        'post_status'     => 'publish' );
    $comics = get_posts( $args );
    $permalink = get_permalink($comics[0]->ID);

    echo $permalink;
}

function the_newest_comic(){

    $args = array(
        'numberposts'     => 1,
        'offset'          => 0,
        'orderby'         => 'post_date',
        'order'           => 'DESC',
        'post_type'       => 'comic',
        'post_status'     => 'publish' );
    $myposts = get_posts( $args );
    $permalink = get_permalink($myposts[0]->ID);
    echo $permalink;
}

	

function the_random_comic(){

    $args = array(
        'numberposts'     => 1,
        'offset'          => 0,
        'orderby'         => 'rand',
        'order'           => 'DESC',
        'post_type'       => 'comic',
        'post_status'     => 'publish' );
    $myposts = get_posts( $args );
    $permalink = get_permalink($myposts[0]->ID);
    echo $permalink;
}

//Add menu support
function register_my_menus() {
	register_nav_menus(
		array(
            'header-menu' => 'Header Menu',
            'main-menu' => 'Main Menu',
			'links-menu' => 'Footer Links' 
		)	
	);
}

add_action('wp_enqueue_scripts', 'theme_styles');
add_action('wp_enqueue_scripts', 'theme_js');
add_action( 'init', 'register_my_menus' );


/**
 *  Some stuff to make the comics nav links
 * 
 */

function the_next_comic(){

    $the_next_comic = get_adjacent_post(false, '', false);

    if( $the_next_comic == '' ){
        return;
    }
    
    $permalink = get_the_permalink( $the_next_comic );

    if( $permalink ){ ?>
        <li><a href="<?php echo $permalink;?>">Next Comic</a></li>
    <?php
    }

}

function the_previous_comic(){
    $the_previous_comic = get_adjacent_post(false, '', true);
    
    if( $the_previous_comic == '' ){
        return;
    }

    $permalink = get_the_permalink( $the_previous_comic );
    
    if( $permalink ){ ?>
        <li><a href="<?php echo $permalink;?>">Previous Comic</a></li>
    <?php
    }
}

/**
 * A little helper to see if we are on a comics page
 */

function is_comic(){
    if( is_post_type_archive( 'comic' ) || get_post_type() == 'comic' ){
        return true;
    }
    return false;
}


/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

function add_async_attribute($tag, $handle) {
    if ( 'compiled-js' !== $handle )
        return $tag;
    return str_replace( ' src', ' async="async" src', $tag );
}

add_filter('script_loader_tag', 'add_async_attribute', 10, 2);

/**
 * Adds the meta box to the posts (download links, etc)
 */

require get_template_directory() . '/inc/class-pizzapranks-post-metabox.php';

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


// some light cleanup

function pp_after_setup_theme() {
    // add a custom image size for the calendar        
    add_image_size( 'calendar', 32, 32, false );
}

add_action('after_setup_theme', 'pp_after_setup_theme');


/**
 *
 * @param $form_fields array, fields to include in attachment form
 * @param $post object, attachment record in database
 * @return $form_fields, modified form fields
 */
  
function pp_attachment_date_changer( $form_fields, $post ) {
    $form_fields['pp_upload_date'] = array(
        'label' => 'New Upload Date',
        'input' => 'text',
        'value' => get_post_meta( $post->ID, 'pp_upload_date', true ),
        'helps' => 'Date formatted like "MM/DD/YYYY"',
    );
 
    return $form_fields;
}
 
add_filter( 'attachment_fields_to_edit', 'pp_attachment_date_changer', 10, 2 );
 
/**
 *
 * @param $post array, the post data for database
 * @param $attachment array, attachment fields from $_POST form
 * @return $post array, modified post data
 */
 
function pp_attachment_field_date_save( $post, $attachment ) {
    if( isset( $attachment['pp_upload_date'] ) )
        update_post_meta( $post['ID'],'pp_upload_date', $attachment['pp_upload_date'] );
 
    return $post;
}
 
add_filter( 'attachment_fields_to_save', 'pp_attachment_field_date_save', 10, 2 );

function pp_register_meta() {
    register_meta( 'post', 'pp_upload_date', array('show_in_rest'=> true, 'single'=>true), null );
}

add_action('rest_api_init', 'pp_register_meta');