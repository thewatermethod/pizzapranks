<?php

function my_get_posts( $query ) {

	if ( is_home() && $query->is_main_query() )
		$query->set( 'post_type', array( 'post', 'comic', 'book','podcast' ) );

	return $query;
}

//Load JS
function theme_js(){
	wp_enqueue_script('jquery','https://code.jquery.com/jquery-2.1.1.min.js','',true);
	wp_enqueue_script('modernizr', get_template_directory_uri().'/js/vendor/modernizr.min.js','','',true);
	wp_enqueue_script('plugins', get_template_directory_uri().'/js/plugins.js','','',true);	
    wp_enqueue_script('bootstrap','https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js','jquery','',true);
}
//Load CSS
function theme_styles() {
    wp_enqueue_style('bootstrap','https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css');
    wp_enqueue_style('normalize', get_template_directory_uri().'/normalize.css');
    wp_enqueue_style('resets', get_template_directory_uri().'/main.css');
    wp_enqueue_style('main', get_template_directory_uri().'/style.css');
    wp_enqueue_style('VT323','http://fonts.googleapis.com/css?family=VT323');
    wp_enqueue_style('lato','http://fonts.googleapis.com/css?family=Lato');
    wp_enqueue_style("Oran","http://fonts.googleapis.com/css?family=Oranienbaum");
}

function pizzapranks_widgets_init() {
  register_sidebar( array(
    'name'          => __( 'Header Ad Code', 'twilit_grotto' ),
    'id'            => 'header-ad',
    'description'   => '',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '',
    'after_title'   => '',
  ) );
  register_sidebar( array(
    'name'          => __( 'Andrew Bio', 'twilit_grotto' ),
    'id'            => 'andrew-bio',
    'description'   => '',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>',
  ) );
  register_sidebar( array(
    'name'          => __( 'Gino Bio', 'twilit_grotto' ),
    'id'            => 'gino-bio',
    'description'   => '',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>',
  ) );  
  register_sidebar( array(
    'name'          => __( 'Matt Bio', 'twilit_grotto' ),
    'id'            => 'matt-bio',
    'description'   => '',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>',
  ) );
    register_sidebar( array(
    'name'          => __( 'Book Info', 'twilit_grotto' ),
    'id'            => 'book-info',
    'description'   => '',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>',
  ) );
    register_sidebar( array(
    'name'          => __( 'Footer Left', 'twilit_grotto' ),
    'id'            => 'footer-left',
    'description'   => '',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h5>',
    'after_title'   => '</h5>',
  ) );
  register_sidebar( array(
    'name'          => __( 'Footer Middle', 'pizzapranks' ),
    'id'            => 'footer-middle',
    'description'   => '',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h5>',
    'after_title'   => '</h5>',
  ) );  
  register_sidebar( array(
    'name'          => __( 'Footer Right', 'pizzapranks' ),
    'id'            => 'footer-right',
    'description'   => '',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h5>',
    'after_title'   => '</h5>',
  ) );
    register_sidebar( array(
    'name'          => __( 'About Games', 'pizzapranks' ),
    'id'            => 'about-games',
    'description'   => '',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>',
  ) );
  register_sidebar( array(
    'name'          => __( 'About Comics', 'pizzapranks' ),
    'id'            => 'about-comics',
    'description'   => '',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>',
  ) );  

    register_sidebar( array(
    'name'          => __( 'About Podcast', 'about-podcast' ),
    'id'            => 'about-comics',
    'description'   => '',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>',
  ) );  
  register_sidebar( array(
    'name'          => __( 'Podcast Right Area', 'podcast-second' ),
    'id'            => 'about-novel',
    'description'   => '',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>',
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
			'header-menu' =>__( 'Header Menu' ),
			'links-menu' =>__( 'Footer Links' )
		)	
	);
}

//hide menu bar because it's ugly
function mdw_hide_admin_bar() {
     show_admin_bar(false);
 }

add_action('set_current_user', 'mdw_hide_admin_bar');
add_action('init','random_add_rewrite');
add_action('wp_enqueue_scripts', 'theme_styles');
add_action('wp_enqueue_scripts', 'theme_js');
add_filter( 'pre_get_posts', 'my_get_posts' );
add_theme_support( 'post-thumbnails' ); 
add_action( 'init', 'register_my_menus' );
add_action('template_redirect','random_template');