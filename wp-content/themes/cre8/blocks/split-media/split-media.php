<?php
/**
 * Split Media: text beside an image.
 */
$eyebrow  = get_field( 'eyebrow' );
$heading  = get_field( 'heading' );
$text     = get_field( 'text' );
$image    = get_field( 'image' );
$position = 'left' === get_field( 'image_position' ) ? 'left' : 'right';
$anchor   = ! empty( $block['anchor'] ) ? ' id="' . esc_attr( $block['anchor'] ) . '"' : '';
?>
<section class="<?php echo esc_attr( 'section split-media' . ( 'left' === $position ? ' split-media--image-left' : '' ) . cre8_background_class( get_field( 'background' ) ) ); ?>"<?php echo $anchor; ?>>
	<div class="split-media__inner container">
		<div class="split-media__content">
			<?php if ( $eyebrow ) : ?><p class="eyebrow"><?php echo esc_html( $eyebrow ); ?></p><?php endif; ?>
			<?php if ( $heading ) : ?><h2 class="split-media__title"><?php echo esc_html( $heading ); ?></h2><?php endif; ?>
			<?php if ( $text ) : ?><div class="split-media__text"><?php echo wp_kses_post( $text ); ?></div><?php endif; ?>
		</div>
		<?php echo cre8_image( $image, 'large', array( 'class' => 'split-media__image', 'loading' => 'lazy' ) ); ?>
	</div>
</section>
