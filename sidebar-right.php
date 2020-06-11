<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */
?>


<aside id="tertiary" class="widget-area flex flex-column">

<?php
	if ( is_active_sidebar( 'sidebar-2' ) ) {
		dynamic_sidebar( 'sidebar-2' ); 
	} ?>
</aside><!-- #secondary -->