<?php

require_once 'inc/pizzapranks_custom_post_types.php';

// Load JS
function theme_js(){

    wp_register_script( 'compiled-js', get_template_directory_uri().'/dist/js/compiled.js',array('jquery'),'false', false);

    wp_localize_script( 'compiled-js', 'wpApiSettings', array(
      'root' => esc_url_raw( rest_url() ),
      'nonce' => wp_create_nonce( 'wp_rest' )
     ) );   
  
    if( is_post_type_archive( 'comic' ) || get_post_type() == 'comic' ){
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

    if( is_post_type_archive( 'comic' ) || get_post_type() == 'comic' ){
        wp_enqueue_style('apple-kiwi', get_template_directory_uri().'/dist/css/comics.css'); 
    } else {
        wp_enqueue_style('compiled', get_template_directory_uri().'/dist/css/compiled.css'); 
    }
       
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
			'links-menu' => 'Footer Links' 
		)	
	);
}

add_action('wp_enqueue_scripts', 'theme_styles');
add_action('wp_enqueue_scripts', 'theme_js');
add_theme_support( 'post-thumbnails' ); 
add_action( 'init', 'register_my_menus' );

// gets the first image if you call it within the loop
function catch_that_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches[1][0];
    return $first_img;
}	

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
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

function add_async_attribute($tag, $handle) {
    if ( 'compiled-js' !== $handle )
        return $tag;
    return str_replace( ' src', ' async="async" src', $tag );
}

add_filter('script_loader_tag', 'add_async_attribute', 10, 2);

require get_template_directory() . '/inc/class-pizzapranks-post-metabox.php';

//todo - editorstyles.css

function pp_add_categories_to_attachments() {
    register_taxonomy_for_object_type( 'category', 'attachment' );
}
add_action( 'init' , 'pp_add_categories_to_attachments' );