<?php
/**
 * Latest Posts: the most recent blog posts.
 */
global $post;
$count  = (int) get_field( 'count' ) ?: 3;
$recent = get_posts( array( 'numberposts' => $count, 'post_status' => 'publish' ) );
$anchor = ! empty( $block['anchor'] ) ? ' id="' . esc_attr( $block['anchor'] ) . '"' : '';
?>
<section class="section<?php echo esc_attr( cre8_background_class( get_field( 'background' ) ) ); ?>"<?php echo $anchor; ?>>
	<div class="wrap">
		<?php cre8_section_head( get_field( 'eyebrow' ), get_field( 'heading' ), get_field( 'intro' ) ); ?>
		<?php if ( $recent ) : ?>
		<div class="blog-grid">
			<?php foreach ( $recent as $post ) : setup_postdata( $post ); ?>
				<?php get_template_part( 'partials/post-card' ); ?>
			<?php endforeach; wp_reset_postdata(); ?>
		</div>
		<?php else : ?>
		<p class="empty-state">New articles will appear here soon.</p>
		<?php endif; ?>
		<?php $link = get_field( 'link' ); if ( ! empty( $link['url'] ) ) : ?>
		<p class="section-more"><?php echo cre8_link( $link, 'button button--ghost' ); ?></p>
		<?php endif; ?>
	</div>
</section>
