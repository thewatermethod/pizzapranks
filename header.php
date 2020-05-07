<!doctype html>
<?php 

	$is_comic = is_comic();

?>

<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
	
	<body <?php body_class('pizzapranks');?>>


	<header class="site-header">
		
		<?php if( is_home() ) : ?>
			<h1 class="site-title"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
		<?php else: ?>
			<p class="site-title"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></p>			
		<?php endif; ?>
		

		<button id="menuToggle" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
			<div class="menui top-menu"></div>
			<div class="menui mid-menu"></div>
			<div class="menui bottom-menu"></div>
		</button>
	
		<div class="main"><?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'container_class' => 'main-menu h1' ) ); ?><?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container_class' => 'main-menu h1' ) ); ?><div>	
		
	
	
	</header>

	<?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'container_class' => 'main-menu h3' ) ); ?>