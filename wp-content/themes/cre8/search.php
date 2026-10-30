<?php get_header(); ?>

<main id="content">
	<?php
	get_template_part( 'partials/inner-hero', null, array(
		'eyebrow' => 'Search',
		'heading' => sprintf( __( 'Results for "%s"', 'cre8' ), get_search_query() ),
	) );
	?>
	<section class="section">
		<div class="wrap search-layout">
			<form class="search-page-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" role="search">
				<label for="search-page-input"><?php esc_html_e( 'Search again', 'cre8' ); ?></label>
				<div>
					<input id="search-page-input" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" required>
					<button class="button" type="submit"><?php esc_html_e( 'Search', 'cre8' ); ?></button>
				</div>
			</form>
			<?php if ( have_posts() ) : ?>
			<div class="search-results">
				<?php while ( have_posts() ) : the_post(); ?>
				<article class="search-result">
					<h2><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
					<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 30 ) ); ?></p>
					<a class="text-link" href="<?php echo esc_url( get_permalink() ); ?>"><?php esc_html_e( 'View page', 'cre8' ); ?></a>
				</article>
				<?php endwhile; ?>
			</div>
			<?php the_posts_pagination( array( 'class' => 'pagination', 'mid_size' => 1 ) ); ?>
			<?php else : ?>
			<p class="empty-state"><?php esc_html_e( 'Nothing matched your search. Try a different word, or contact us and we will point you in the right direction.', 'cre8' ); ?></p>
			<?php endif; ?>
		</div>
	</section>
</main>

<?php get_footer(); ?>
