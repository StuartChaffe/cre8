<?php
/**
 * Product Cards: feature style (homepage) or list style (products page).
 */
$style  = 'list' === get_field( 'style' ) ? 'list' : 'feature';
$cards  = get_field( 'cards' ) ?: array();
$note   = get_field( 'note' );
$anchor = ! empty( $block['anchor'] ) ? ' id="' . esc_attr( $block['anchor'] ) . '"' : '';
$bg     = get_field( 'background' );
$tinted = 'feature' === $style && ( ! $bg || 'default' === $bg );
$class  = 'section product-cards product-cards--' . $style . ( $tinted ? ' product-cards--tinted' : cre8_background_class( $bg ) );
?>
<section class="<?php echo esc_attr( $class ); ?>"<?php echo $anchor; ?>>
	<div class="container">
		<?php cre8_section_head( get_field( 'eyebrow' ), get_field( 'heading' ), get_field( 'intro' ) ); ?>

		<div class="product-cards__grid">
		<?php foreach ( $cards as $card ) :
			$points = array_filter( array_map( 'trim', explode( "\n", (string) $card['points'] ) ) );
			$url    = $card['link']['url'] ?? '';
			$image  = ! empty( $card['image'] ) ? cre8_image( $card['image'], 'large', array( 'class' => 'product-cards__image' ) ) : '';
			?>
			<article class="product-cards__card<?php echo 'feature' === $style ? ' u-reveal' : ''; ?>">
				<?php if ( 'list' === $style && $image && $url ) : ?>
				<a class="product-cards__media" href="<?php echo esc_url( $url ); ?>" tabindex="-1" aria-hidden="true"><?php echo $image; ?></a>
				<?php elseif ( $image || 'feature' === $style ) : ?>
				<div class="product-cards__media"><?php echo $image ?: '<div class="product-cards__signal" aria-hidden="true"></div>'; ?></div>
				<?php endif; ?>
				<div class="product-cards__content">
					<?php if ( $card['label'] ) : ?><span class="product-cards__label"><?php echo esc_html( $card['label'] ); ?></span><?php endif; ?>
					<h3 class="product-cards__title"><?php echo esc_html( $card['title'] ); ?></h3>
					<?php if ( $card['text'] ) : ?><p class="product-cards__text"><?php echo esc_html( $card['text'] ); ?></p><?php endif; ?>
					<?php if ( $points ) : ?><ul class="product-cards__points"><?php foreach ( $points as $p ) echo '<li class="product-cards__point">' . esc_html( $p ) . '</li>'; ?></ul><?php endif; ?>
					<?php echo cre8_link( $card['link'], 'product-cards__link text-link', 'list' === $style ? 'View product' : 'Find out more' ); ?>
				</div>
			</article>
		<?php endforeach; ?>
		</div>

		<?php if ( $note ) : ?><p class="product-cards__note"><?php echo esc_html( $note ); ?></p><?php endif; ?>
	</div>
</section>
