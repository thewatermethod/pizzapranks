<?php
/**
 * Template part for displaying the calendar
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */

	$calendar_category = 0;

	if( get_post_meta( get_the_id(), 'calendar_category', true ) ) {
		$calendar_category = get_post_meta( get_the_id(), 'calendar_category', true );
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

		<input type="hidden" id="calendarCategory" value="<?php echo $calendar_category; ?>">
			
	</header><!-- .entry-header -->


	<div class="entry-content">

		<!-- vue app -->
		<div id="calendarApp" class="calendar-app">
			
			<div class="calendar-title">{{ currentMonth }} {{ currentYear }}</div>

			<div class="calendar-main" :style="calendarGrid()">
				<div v-for="day in days" :class="day.class" :data-moment="day.moment">
					{{day.day}}
					<button v-if="day.pixel" v-on:click="showPixel( day.pixel.id )">
						Pixel
					</button>
				</div>
			</div>

			<div class="calendar-footer flex">
				<button class="body" v-on:click="previousMonth()" >Previous Month</button>
				<button class="body" v-on:click="nextMonth()">Next Month</button>
			</div>

			<div v-if="selectedPixel" class="calendar-modal flex flex-column">
				<h2>{{selectedPixel.title}}</h2>
				<img :src="selectedPixel.url" alt="">
				<p>{{selectedPixel.desc}}</p>
				<button class="h3" v-on:click="backToCalendar()">Close</button>
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
