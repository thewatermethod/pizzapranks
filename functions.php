<?php

require_once 'inc/pizzapranks_custom_post_types.php';

// Load JS
function theme_js(){
  wp_enqueue_script( 'compiled-js', get_template_directory_uri().'/dist/js/compiled.js',array('jquery'),'false', true);
}
// Load CSS
function theme_styles() {
    wp_enqueue_style('compiled-css', get_template_directory_uri().'/dist/css/compiled.css');
}

// Register widgets
function pizzapranks_widgets_init() {
  register_sidebar( array(
    'name'          =>  'Sidebar',
    'id'            =>  'sidebar-1',
    'description'   => '',
    'before_widget' => '<div class="widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );
}
add_action( 'widgets_init', 'pizzapranks_widgets_init' );

//Handling random comic
function random_add_rewrite() {
      global $wp;
      $wp->add_query_var('random');
      add_rewrite_rule('random/?$', 'index.php?random=1', 'top');
}

function random_template() {
    if (get_query_var('random') == 1) {
      $posts = get_posts('post_type=post&orderby=rand&numberposts=1');
      foreach($posts as $post) {
              $link = get_permalink($post);
      }
      wp_redirect($link,307);
      exit;
    }
}

function the_oldest_comic(){
   global $post;
    $tmp_post = $post;
    $args = array(
        'numberposts'     => 1,
        'offset'          => 0,
        'orderby'         => 'post_date',
        'order'           => 'ASC',
        'post_type'       => 'comic',
        'post_status'     => 'publish' );
    $myposts = get_posts( $args );
    $permalink = get_permalink($myposts[0]->ID);
    $post = $tmp_post;
    return $permalink;
}

function the_newest_comic(){
   global $post;
    $tmp_post = $post;
    $args = array(
        'numberposts'     => 1,
        'offset'          => 0,
        'orderby'         => 'post_date',
        'order'           => 'DESC',
        'post_type'       => 'comic',
        'post_status'     => 'publish' );
    $myposts = get_posts( $args );
    $permalink = get_permalink($myposts[0]->ID);
    $post = $tmp_post;
    return $permalink;
}

	
function the_oldest_chapter(){
    global $post;
    $tmp_post = $post;
    $args = array(
        'numberposts'     => 1,
        'offset'          => 0,
        'orderby'         => 'post_date',
        'order'           => 'ASC',
        'post_type'       => 'chapter',
        'post_status'     => 'publish' );
    $myposts = get_posts( $args );
    $permalink = get_permalink($myposts[0]->ID);
    $post = $tmp_post;
    return $permalink;
}

function the_newest_chapter(){
   global $post;
    $tmp_post = $post;
    $args = array(
        'numberposts'     => 1,
        'offset'          => 0,
        'orderby'         => 'post_date',
        'order'           => 'DESC',
        'post_type'       => 'chapter',
        'post_status'     => 'publish' );
    $myposts = get_posts( $args );
    $permalink = get_permalink($myposts[0]->ID);
    $post = $tmp_post;
    return $permalink;
}


function random_comic(){
   global $post;
    $tmp_post = $post;
    $args = array(
        'numberposts'     => 1,
        'offset'          => 0,
        'orderby'         => 'rand',
        'order'           => 'DESC',
        'post_type'       => 'comic',
        'post_status'     => 'publish' );
    $myposts = get_posts( $args );
	  $permalink = get_permalink($myposts[0]->ID);
    $post = $tmp_post;
    return $permalink;
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

add_action('init','random_add_rewrite');
add_action('wp_enqueue_scripts', 'theme_styles');
add_action('wp_enqueue_scripts', 'theme_js');
add_theme_support( 'post-thumbnails' ); 
add_action( 'init', 'register_my_menus' );
add_action('template_redirect','random_template');

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

