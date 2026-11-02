<?php
/**
 * Blog listing (the Posts page), and fallback for any other view.
 */
get_header();
$blog_page = (int) get_option( 'page_for_posts' );
?>

<main id="content">
	<?php
	get_template_part( 'partials/page-header', null, array(
		'eyebrow' => is_archive() ? '' : 'News & insight',
		'heading' => is_archive() ? wp_strip_all_tags( get_the_archive_title() ) : ( $blog_page ? get_the_title( $blog_page ) : __( 'Blog', 'cre8' ) ),
		'lede'    => is_archive() ? wp_strip_all_tags( get_the_archive_description() ) : ( $blog_page ? get_the_excerpt( $blog_page ) : '' ),
		'image'   => $blog_page && ! is_archive() ? get_post_thumbnail_id( $blog_page ) : 0,
	) );
	?>
	<section class="section">
		<div class="container">
			<?php if ( have_posts() ) : ?>
			<div class="post-grid">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'partials/post-card' ); ?>
				<?php endwhile; ?>
			</div>
			<?php the_posts_pagination( array( 'class' => 'pagination', 'mid_size' => 1 ) ); ?>
			<?php else : ?>
			<p class="empty-state"><?php esc_html_e( 'There are no articles to show yet.', 'cre8' ); ?></p>
			<?php endif; ?>
		</div>
	</section>
</main>

<?php get_footer(); ?>
