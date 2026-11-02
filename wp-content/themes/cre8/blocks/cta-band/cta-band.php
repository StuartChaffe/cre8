<?php
/**
 * CTA Band: pink call to action.
 */
$eyebrow = get_field( 'eyebrow' );
$heading = get_field( 'heading' );
$text    = get_field( 'text' );
$anchor  = ! empty( $block['anchor'] ) ? ' id="' . esc_attr( $block['anchor'] ) . '"' : '';
?>
<section class="cta-band"<?php echo $anchor; ?>>
	<div class="cta-band__inner container">
		<div class="cta-band__content">
			<?php if ( $eyebrow ) : ?><p class="eyebrow"><?php echo esc_html( $eyebrow ); ?></p><?php endif; ?>
			<?php if ( $heading ) : ?><h2 class="cta-band__title"><?php echo esc_html( $heading ); ?></h2><?php endif; ?>
			<?php if ( $text ) : ?><p class="cta-band__text"><?php echo esc_html( $text ); ?></p><?php endif; ?>
		</div>
		<?php echo cre8_link( get_field( 'link' ), 'cta-band__btn btn', 'Discuss a project' ); ?>
	</div>
</section>
