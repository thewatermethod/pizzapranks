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
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 83.64 98.08"><defs><style>.cls-1{fill:#e6e7e8;stroke:#231f20;stroke-linecap:round;stroke-miterlimit:10;}</style></defs><title>Asset 1</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="cls-1" d="M26.95,41c-.26,19.44-.26,37.44,0,56.58"/><line class="cls-1" x1="27.77" y1="38.53" x2="83.14" y2="38.53"/><line class="cls-1" x1="0.5" y1="50.93" x2="61.66" y2="50.93"/><line class="cls-1" x1="61.66" y1="49.29" x2="61.66" y2="0.5"/></g></g></svg>
	<?php
	if (  is_active_sidebar( 'sidebar-1' ) ) {
		dynamic_sidebar( 'sidebar-1' ); 
	} ?>
</aside><!-- #secondary -->