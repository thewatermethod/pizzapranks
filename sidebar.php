<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */
?>
<div id="calendar"></div>
<?php
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
	$class = "";

if( is_home() || is_front_page() ) {
	$class .= "home-widget-area";
}
?>

<aside id="secondary" class="widget-area <?php echo $class; ?>">

	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->