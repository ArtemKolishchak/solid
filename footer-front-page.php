<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package solid
 */

    global $solid_option
?>

<div id="footerwrap">
    <div class="container">

	<?php if ( is_active_sidebar( 'sidebar-footer' ) ) { ?>

      	<div class="row">
       
       		<?php dynamic_sidebar( 'sidebar-footer' ); ?>

      	</div><!-- .row -->
      	
    <?php } ?>

    </div><!-- .container -->
  </div><!-- #footerwrap -->

    <div id="copyrights">
        <div class="container">
        
            <?php if($solid_option['footer-copyrights'] != ''):  ?>

            <p>
                <?php echo esc_html($solid_option['footer-copyrights']); ?>
            </p>

            <?php endif; ?>

             <?php if($solid_option['created-by'] != ''):  ?>

            <div class="credits">
                <!--
                  You are NOT allowed to delete the credit link to TemplateMag with free version.
                  You can delete the credit link only if you bought the pro version.
                  Buy the pro version with working PHP/AJAX contact form: https://templatemag.com/solid-bootstrap-business-template/
                  Licensing information: https://templatemag.com/license/
                -->
                <p>
                  <?php echo esc_html($solid_option['created-by']); ?>
                </p>
            </div><!-- .credits -->

             <?php endif; ?>

        </div><!-- .container -->
    </div><!-- #copyrights -->
    
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>



