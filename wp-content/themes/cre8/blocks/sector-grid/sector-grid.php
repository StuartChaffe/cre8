<?php
/**
 * Sector Grid: image cards, the first one large.
 */
$cards  = get_field( 'cards' ) ?: array();
$anchor = ! empty( $block['anchor'] ) ? ' id="' . esc_attr( $block['anchor'] ) . '"' : '';
?>
<section class="section sector-grid"<?php echo $anchor; ?>>
	<div class="container">
		<?php cre8_section_head( get_field( 'eyebrow' ), get_field( 'heading' ), get_field( 'intro' ) ); ?>
		<div class="sector-grid__grid">
		<?php foreach ( $cards as $i => $card ) :
			$url = $card['link']['url'] ?? '';
			$tag = $url ? 'a' : 'div';
			?>
			<<?php echo $tag; ?> class="sector-grid__card<?php echo empty( $card['image'] ) ? ' sector-grid__card--plain' : ''; ?> u-reveal"<?php echo $url ? ' href="' . esc_url( $url ) . '"' : ''; ?>>
				<?php echo cre8_image( $card['image'], 0 === $i ? 'full' : 'large', array( 'class' => 'sector-grid__image', 'loading' => 'lazy' ) ); ?>
				<div class="sector-grid__content">
					<?php if ( $card['label'] ) : ?><span class="sector-grid__label"><?php echo esc_html( $card['label'] ); ?></span><?php endif; ?>
					<?php if ( $card['title'] ) : ?><h3 class="sector-grid__title"><?php echo esc_html( $card['title'] ); ?></h3><?php endif; ?>
					<?php if ( $card['text'] ) : ?><p class="sector-grid__text"><?php echo esc_html( $card['text'] ); ?></p><?php endif; ?>
				</div>
			</<?php echo $tag; ?>>
		<?php endforeach; ?>
		</div>
	</div>
</section>
