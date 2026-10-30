<?php get_header(); ?>

<main id="content">
<?php while ( have_posts() ) : the_post(); ?>
	<?php
	get_template_part( 'partials/inner-hero', null, array(
		'eyebrow' => get_the_date(),
		'heading' => get_the_title(),
		'lede'    => has_excerpt() ? get_the_excerpt() : '',
		'image'   => get_post_thumbnail_id(),
	) );
	?>
	<section class="section">
		<div class="wrap">
			<article class="rich-copy cms-article">
				<?php the_content(); ?>
			</article>
		</div>
	</section>
<?php endwhile; ?>
</main>

<?php get_footer(); ?>
