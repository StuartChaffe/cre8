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
	<div class="wrap cta-band__inner">
		<div>
			<?php if ( $eyebrow ) : ?><p class="eyebrow"><?php echo esc_html( $eyebrow ); ?></p><?php endif; ?>
			<?php if ( $heading ) : ?><h2><?php echo esc_html( $heading ); ?></h2><?php endif; ?>
			<?php if ( $text ) : ?><p><?php echo esc_html( $text ); ?></p><?php endif; ?>
		</div>
		<?php echo cre8_link( get_field( 'link' ), 'button', 'Discuss a project' ); ?>
	</div>
</section>
