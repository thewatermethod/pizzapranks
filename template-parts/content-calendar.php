<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */

	$download_link = false;
	$game_price = false;

	if( get_post_meta( get_the_id(), 'download_link', true ) ) {
		$download_link = get_post_meta( get_the_id(), 'download_link', true );
	}

	if( get_post_meta( get_the_id(), 'game_price', true ) ) {
		$game_price = get_post_meta( get_the_id(), 'game_price', true );
	}


?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif; ?>

		<div class="meta-container">

			<?php if( $game_price ) { ?>
				<span class="meta-item meta-price"><?php echo $game_price; ?></span>
			<?php }

			if( $download_link ) { ?>
				<span class="meta-item meta-link"><a href="<?php echo $download_link; ?>">Download</a></span>
			<?php } 

			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
			}

			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() )
			);

			$posted_on = sprintf(
				/* translators: %s: post date. */
				'%s',
				$time_string
			);

			echo '<span class="meta-item posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK. ?>


	    </div>
			
	</header><!-- .entry-header -->

   <!-- <?php if ( has_post_thumbnail() ) : ?>
        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
    <?php endif; ?> -->

	<div class="entry-content">

		<!-- vue app -->
		<div id="calendarApp" class="calendar-app">
			
			<div class="calendar-title">{{ currentMonth }} {{ currentYear }}</div>

			<div class="calendar-main">
				<div v-for="blankDay in daysBeforeMonth"></div>
				<div v-for="day in daysInMonth" class="day">{{day.day}}</div>
				<div v-for="blankDay in daysAfterMonth" class="day blank"></div>
			</div>

			<div class="calendar-footer">
				<button v-on:click="previousMonth()" >Previous Month</button>
				<button v-on:click="nextMonth()">Next Month</button>
			</div>
		</div>
        
		<?php
		    the_content();
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">		
		<span class="meta-container">
			<span class="meta-item">The Permalink (for sharing): <a href="<?php the_permalink();?>"><?php the_permalink();?></a></span>
		</span>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
