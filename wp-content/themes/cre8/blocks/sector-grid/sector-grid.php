<?php
/**
 * Sector Grid: image cards, the first one large.
 */
$cards  = get_field( 'cards' ) ?: array();
$anchor = ! empty( $block['anchor'] ) ? ' id="' . esc_attr( $block['anchor'] ) . '"' : '';
?>
<section class="section sectors"<?php echo $anchor; ?>>
	<div class="wrap">
		<?php cre8_section_head( get_field( 'eyebrow' ), get_field( 'heading' ), get_field( 'intro' ) ); ?>
		<div class="sector-grid">
		<?php foreach ( $cards as $i => $card ) :
			$url = $card['link']['url'] ?? '';
			$tag = $url ? 'a' : 'div';
			?>
			<<?php echo $tag; ?> class="sector-card reveal"<?php echo $url ? ' href="' . esc_url( $url ) . '"' : ''; ?>>
				<?php echo cre8_image( $card['image'], 0 === $i ? 'full' : 'large', array( 'loading' => 'lazy' ) ); ?>
				<div class="sector-copy">
					<?php if ( $card['label'] ) : ?><span><?php echo esc_html( $card['label'] ); ?></span><?php endif; ?>
					<?php if ( $card['title'] ) : ?><h3><?php echo esc_html( $card['title'] ); ?></h3><?php endif; ?>
					<?php if ( $card['text'] ) : ?><p><?php echo esc_html( $card['text'] ); ?></p><?php endif; ?>
				</div>
			</<?php echo $tag; ?>>
		<?php endforeach; ?>
		</div>
	</div>
</section>
