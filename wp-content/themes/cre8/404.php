<?php get_header(); ?>

<main id="content">
	<?php
	get_template_part( 'partials/inner-hero', null, array(
		'eyebrow' => '404',
		'heading' => __( 'Page not found', 'cre8' ),
		'lede'    => __( 'The page you asked for has moved or no longer exists.', 'cre8' ),
	) );
	?>
	<section class="section">
		<div class="wrap">
			<a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to the homepage', 'cre8' ); ?></a>
		</div>
	</section>
</main>

<?php get_footer(); ?>
