<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */
?>


<aside id="tertiary" class="widget-area"><?php if (  is_active_sidebar( 'sidebar-2' ) ) { dynamic_sidebar( 'sidebar-2' ); } ?></aside><!-- #secondary -->