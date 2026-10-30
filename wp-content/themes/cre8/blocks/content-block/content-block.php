<?php
/**
 * Content Block: rich text with an optional facts panel.
 */
$eyebrow = get_field( 'eyebrow' );
$heading = get_field( 'heading' );
$lede    = get_field( 'lede' );
$content = get_field( 'content' );
$facts   = get_field( 'facts' ) ?: array();
$anchor  = ! empty( $block['anchor'] ) ? ' id="' . esc_attr( $block['anchor'] ) . '"' : '';
?>
<section class="section<?php echo esc_attr( cre8_background_class( get_field( 'background' ) ) ); ?>"<?php echo $anchor; ?>>
	<div class="wrap<?php echo $facts ? ' content-grid' : ''; ?>">
		<div class="rich-copy">
			<?php if ( $eyebrow ) : ?><p class="eyebrow"><?php echo esc_html( $eyebrow ); ?></p><?php endif; ?>
			<?php if ( $heading ) : ?><h2><?php echo esc_html( $heading ); ?></h2><?php endif; ?>
			<?php if ( $lede ) : ?><p class="lede"><?php echo esc_html( $lede ); ?></p><?php endif; ?>
			<?php if ( $content ) echo wp_kses_post( $content ); ?>
		</div>
		<?php if ( $facts ) : ?>
		<aside class="fact-panel">
			<?php foreach ( $facts as $fact ) : if ( ! $fact['value'] ) continue; ?>
			<div class="fact">
				<small><?php echo esc_html( $fact['label'] ); ?></small>
				<strong><?php echo wp_kses( $fact['value'], array( 'a' => array( 'href' => array(), 'target' => array(), 'rel' => array() ), 'br' => array() ) ); ?></strong>
			</div>
			<?php endforeach; ?>
		</aside>
		<?php endif; ?>
	</div>
</section>
