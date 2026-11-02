<?php get_header(); ?>

<main id="content">
<?php while ( have_posts() ) : the_post(); ?>
	<?php
	get_template_part( 'partials/page-header', null, array(
		'eyebrow' => get_the_date(),
		'heading' => get_the_title(),
		'lede'    => has_excerpt() ? get_the_excerpt() : '',
		'image'   => get_post_thumbnail_id(),
	) );
	?>
	<section class="section">
		<div class="container">
			<article class="rich-copy rich-copy--article">
				<?php the_content(); ?>
			</article>
		</div>
	</section>
<?php endwhile; ?>
</main>

<?php get_footer(); ?>
