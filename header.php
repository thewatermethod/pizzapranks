<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>
		<?php 
			wp_title(' - ', true, 'right'); 
			bloginfo('name'); 			
		?>
		</title>
        <meta name="description" content="Pizza Pranks What A Good Time you Might Have With Our Apple and Kiwi Pizza Comics and Games">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	
		
		
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
  		<?php wp_head(); ?>
	</head>
	
	<body <?php body_class('pizzapranks');?> >
	
    <div class="container">
		<header>
			
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<?php if( is_home() ) : ?>
					<h1 class="navbar-brand site-title"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
				<?php else: ?>
					<p class="navbar-brand site-title"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></p>
				<?php endif; ?>

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
					
				<?php wp_nav_menu( array( 
					'theme_location' => 'header-menu', 
					'menu_class' => 'collapse navbar-collapse',
					'menu_id' => 'navbarSupportedContent' ) 
				); ?>

			</nav>	

		</header>