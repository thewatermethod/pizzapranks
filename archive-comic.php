<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
	
	<body <?php body_class('pizzapranks');?> >
	
	<div id="apple-and-kiwi">

		<header class="site-header">
			
			<?php if( is_home() ) : ?>
				<h1 class="site-title h1"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
			<?php else: ?>
				<p class="site-title h1"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></p>			
			<?php endif; ?>

			<svg v-on:click="showMenu" height="64px" id="Layer_1" style="enable-background:new 0 0 32 32;" version="1.1" viewBox="0 0 32 32" width="64px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M4,10h24c1.104,0,2-0.896,2-2s-0.896-2-2-2H4C2.896,6,2,6.896,2,8S2.896,10,4,10z M28,14H4c-1.104,0-2,0.896-2,2  s0.896,2,2,2h24c1.104,0,2-0.896,2-2S29.104,14,28,14z M28,22H4c-1.104,0-2,0.896-2,2s0.896,2,2,2h24c1.104,0,2-0.896,2-2  S29.104,22,28,22z"/></svg>

			<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container_class' => 'main-menu h1' ) ); ?>		

		</header>	

		<div id="primary" class="content-area">
			
			<main id="main" class="site-main">

				<article v-for="(comic, key) in comics" class="comic">					
					<img :src="fetchImage( comic.featured_media )" class="comic-image" :id="comic.featured_media">
					<h2 v-html="comic.title.rendered"></h2>
					<div class="entry-meta">					
						<p>{{comic.content.rendered}}</p>
						<p class="the-permalink">The Permalink (for sharing): <a :href="comic.link">{{comic.link}}</a></p>
						<!--<p class="the-full-size-image">Full Size Image<a :href="comic.link">{{comic.link}}</a></p>-->
					</div>
				</article>

			</main><!-- #main -->

		</div><!-- #primary-->
	</div><!-- #apple-and-kiwi-->
<?php get_footer(); ?>	