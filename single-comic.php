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

			<h1 class="site-title h1"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a> - Apple & Kiwi Comics</h1>		

			<svg v-on:click="showMenu" height="64px" id="Layer_1" style="enable-background:new 0 0 32 32;" version="1.1" viewBox="0 0 32 32" width="64px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M4,10h24c1.104,0,2-0.896,2-2s-0.896-2-2-2H4C2.896,6,2,6.896,2,8S2.896,10,4,10z M28,14H4c-1.104,0-2,0.896-2,2  s0.896,2,2,2h24c1.104,0,2-0.896,2-2S29.104,14,28,14z M28,22H4c-1.104,0-2,0.896-2,2s0.896,2,2,2h24c1.104,0,2-0.896,2-2  S29.104,22,28,22z"/></svg>

			<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container_class' => 'main-menu h1' ) ); ?>		

		</header>	


		<div id="primary" class="content-area"><!--<?php echo get_post_type(); ?> -->
			
			<main id="main" class="site-main">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


				<article class="single-comic">

					<section>
						<h1><a href = '<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h1>
						<?php the_content(); ?>
						<?php the_post_thumbnail('medium_large'); ?>
					</section>			
						
					
					<aside class="comics-navigation">

						<ul>
							<?php the_previous_comic(); ?>
							<li><a href="<?php the_oldest_comic(); ?>">Read from the beginning</a></li>		
							<li><a href="<?php the_random_comic(); ?>">Read a random comic</a></li>					
							<li><a href="<?php the_newest_comic(); ?>">Newest Comic</a></li>				
							<?php the_next_comic(); ?>				
							
						</ul>

						<a href="<?php the_post_thumbnail_url(); ?>">See the Full Size Comic</a>

					</aside>


				</article>


				<?php endwhile; else: ?>
				
					<p>Sorry, no posts matched your criteria.</p>
				
				<?php endif; ?> 

			</main>

			<div class="comments">
				<?php comments_template(); ?>
			</div>

		</div><!-- #primary-->


<?php get_footer(); ?>
