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
	<div class="col-1-">
		<div class="module text-block">
			<?php the_content(); ?>
		</div>
	</div>
<?php endwhile; ?>
</div> <!--- End Grid -->

<div class="grid grid-outset">
	<div class="col-1-3">
		<?php
			$args = array( 'post_type' => 'insurance_patients', 'name' => 'medicare-patients');
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<h3 class="title-medicare"><?php the_title() ?></h3>
		<article class="module insurance_patients-medicare">
			
				<?php the_content(); ?>
			<?php endwhile; ?>	
		</article>
	</div>
	<div class="col-1-3">
		<?php
			$args = array( 'post_type' => 'insurance_patients', 'name' => 'medicaid-patients');
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<h3 class="title-medicaid"><?php the_title() ?></h3>
		<article class="module insurance_patients-medicaid">
			
				<?php the_content(); ?>
			<?php endwhile; ?>	
		</article>
	</div>
	<div class="col-1-3">
		<?php
			$args = array( 'post_type' => 'insurance_patients', 'name' => 'commercial-insurance-patients');
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<h3 class="title-commercial"><?php the_title() ?></h3>
		<article class="module insurance_patients-commercial">
			
				<?php the_content(); ?>
			<?php endwhile; ?>	
		</article>
	</div>

</div>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>