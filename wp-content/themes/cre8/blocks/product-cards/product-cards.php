<?php
/**
 * Product Cards: feature style (homepage) or list style (products page).
 */
$style  = get_field( 'style' ) ?: 'feature';
$cards  = get_field( 'cards' ) ?: array();
$note   = get_field( 'note' );
$anchor = ! empty( $block['anchor'] ) ? ' id="' . esc_attr( $block['anchor'] ) . '"' : '';
$bg     = get_field( 'background' );
$class  = 'section' . ( 'feature' === $style && ( ! $bg || 'default' === $bg ) ? ' products' : cre8_background_class( $bg ) );
?>
<section class="<?php echo esc_attr( $class ); ?>"<?php echo $anchor; ?>>
	<div class="wrap">
		<?php cre8_section_head( get_field( 'eyebrow' ), get_field( 'heading' ), get_field( 'intro' ) ); ?>

		<div class="<?php echo 'list' === $style ? 'product-list-grid' : 'product-grid'; ?>">
		<?php foreach ( $cards as $card ) :
			$points = array_filter( array_map( 'trim', explode( "\n", (string) $card['points'] ) ) );
			$url    = $card['link']['url'] ?? '';
			?>
			<?php if ( 'list' === $style ) : ?>
			<article class="product-list-card">
				<?php if ( ! empty( $card['image'] ) ) : ?>
				<<?php echo $url ? 'a href="' . esc_url( $url ) . '" tabindex="-1" aria-hidden="true"' : 'div'; ?> class="product-list-card__image"><?php echo cre8_image( $card['image'], 'large' ); ?></<?php echo $url ? 'a' : 'div'; ?>>
				<?php endif; ?>
				<div class="product-list-card__copy">
					<?php if ( $card['label'] ) : ?><span class="service-card__no"><?php echo esc_html( $card['label'] ); ?></span><?php endif; ?>
					<h3><?php echo esc_html( $card['title'] ); ?></h3>
					<?php if ( $card['text'] ) : ?><p><?php echo esc_html( $card['text'] ); ?></p><?php endif; ?>
					<?php if ( $points ) : ?><ul class="product-points"><?php foreach ( $points as $p ) echo '<li>' . esc_html( $p ) . '</li>'; ?></ul><?php endif; ?>
					<?php echo cre8_link( $card['link'], 'text-link', 'View product' ); ?>
				</div>
			</article>
			<?php else : ?>
			<article class="product-card reveal">
				<div class="product-visual">
					<?php echo ! empty( $card['image'] ) ? cre8_image( $card['image'], 'large' ) : '<div class="signal" aria-hidden="true"></div>'; ?>
				</div>
				<div class="product-copy">
					<?php if ( $card['label'] ) : ?><span class="service-card__no"><?php echo esc_html( $card['label'] ); ?></span><?php endif; ?>
					<h3><?php echo esc_html( $card['title'] ); ?></h3>
					<?php if ( $card['text'] ) : ?><p><?php echo esc_html( $card['text'] ); ?></p><?php endif; ?>
					<?php if ( $points ) : ?><ul class="product-points"><?php foreach ( $points as $p ) echo '<li>' . esc_html( $p ) . '</li>'; ?></ul><?php endif; ?>
					<?php echo cre8_link( $card['link'], 'text-link', 'Find out more' ); ?>
				</div>
			</article>
			<?php endif; ?>
		<?php endforeach; ?>
		</div>

		<?php if ( $note ) : ?><p class="product-note"><?php echo esc_html( $note ); ?></p><?php endif; ?>
	</div>
</section>
