<?php
/**
 * Split Media: text beside an image.
 */
$eyebrow  = get_field( 'eyebrow' );
$heading  = get_field( 'heading' );
$text     = get_field( 'text' );
$image    = get_field( 'image' );
$position = get_field( 'image_position' ) ?: 'right';
$anchor   = ! empty( $block['anchor'] ) ? ' id="' . esc_attr( $block['anchor'] ) . '"' : '';
?>
<section class="section<?php echo esc_attr( cre8_background_class( get_field( 'background' ) ) ); ?>"<?php echo $anchor; ?>>
	<div class="wrap split-media<?php echo 'left' === $position ? ' split-media--image-left' : ''; ?>">
		<div class="split-media__copy">
			<?php if ( $eyebrow ) : ?><p class="eyebrow"><?php echo esc_html( $eyebrow ); ?></p><?php endif; ?>
			<?php if ( $heading ) : ?><h2><?php echo esc_html( $heading ); ?></h2><?php endif; ?>
			<?php if ( $text ) echo wp_kses_post( $text ); ?>
		</div>
		<?php echo cre8_image( $image, 'large', array( 'loading' => 'lazy' ) ); ?>
	</div>
</section>
