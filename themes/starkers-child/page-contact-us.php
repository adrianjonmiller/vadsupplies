<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<h2 class="heading-large"><?php the_title(); ?></h2>
<div class="col-2-3">
	<div class="module white-bg">
		<?php do_shortcode('[easy_contact_forms fid=1]') ?>

		
		<?php the_content(); ?>
		
	</div>
</div>

<div class="col-1-3">
	<div class="module white-bg">
	<?php 
		$key_1_value = get_post_meta( get_the_ID(), 'contact-details', true );
		// check if the custom field has a value
		if( ! empty( $key_1_value ) ) {
		  echo $key_1_value;
		} 
		?>		

	</div>
</div>
<?php endwhile; ?>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>