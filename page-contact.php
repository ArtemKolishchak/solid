<?php
/**
 * Template name: Contact Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package solid
 */

get_header();
?>

	<!--  BLUE WRAP -->
  	<div id="blue" class="contact-page-blue">
    	<div class="container">
      		<div class="row">
      			<?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
      		</div><!-- .row -->
    	</div><!-- .container -->
  	</div><!-- #blue -->
  	
	<!-- Map -->
	<div id="solid-map"></div>
	
	<!-- BLOG CONTENT -->
  	<div class="container mtb">
  		<div class="row">
  			<div class="col-lg-8">
  				<?php if( function_exists('acf_add_local_field_group') ): ?>
	  				<h4><?php the_field('field_contact_heading'); ?></h4>
	  				<div class="hline"></div>
	  				<p><?php the_field('field_contact_text'); ?></p>
  				<?php endif; ?>
				<div class="contact-content">
					<?php
						while ( have_posts() ) :
							the_post();

							the_content();

						endwhile; // End of the loop.
					?>
				</div>
  			</div>
  			<div class="col-lg-4">
				<?php if( function_exists('acf_add_local_field_group') ): ?>
	        		<h4><?php the_field('field_address_heading'); ?></h4>
	        			<div class="hline"></div>
	        				<p><?php the_field('field_address_text'); ?></p>
	        				<p>
	          					Email: <?php the_field('field_email_address_text'); ?><br> Tel: <?php the_field('field_phone_text'); ?>
	        				</p>
	        				<p><?php the_field('field_address_description'); ?></p>
      					</div>
      			<?php endif; ?>
  			</div>
  		</div>
<?php
get_footer();
