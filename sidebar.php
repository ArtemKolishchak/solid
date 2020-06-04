<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package solid
 */
?>
<?php
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		return;
	}
?>

<div class="col-lg-4">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- .col-lg-4 -->

