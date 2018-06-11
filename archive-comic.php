<?php get_header(); ?>

	<div id="apple-and-kiwi">
		<h1 class="h1 vt323 centered-text">Apple & Kiwi Comics></h1>	

		<div id="primary" class="content-area">
					
			<main id="main" class="site-main">

				<article v-for="(comic, key) in comics" class="comic">					
					<img :src="fetchImage( comic.featured_media )" class="comic-image" :id="comic.featured_media">
					<h2><a :href="comic.link" v-html="comic.title.rendered"></a></h2>
					<div class="entry-meta">					
						<p>{{comic.content.rendered}}</p>
						<p class="the-permalink vt323">The Permalink (for sharing): <a :href="comic.link">{{comic.link}}</a></p>
						<!--<p class="the-full-size-image">Full Size Image<a :href="comic.link">{{comic.link}}</a></p>-->
					</div>
				</article>

				<button class="comics-nav aligncenter" v-on:click="loadMoreComics()">Load More Comics</button>

			</main><!-- #main -->

		</div><!-- #primary-->
	</div><!-- #apple-and-kiwi-->

<?php get_footer(); ?>	