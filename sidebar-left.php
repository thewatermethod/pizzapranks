<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */
?>

<aside id="secondary" class="widget-area flex flex-column">

	<?php
	if (  is_active_sidebar( 'sidebar-1' ) ) {
		dynamic_sidebar( 'sidebar-1' ); 
	} ?>
</aside><!-- #secondary -->