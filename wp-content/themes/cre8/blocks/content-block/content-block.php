<?php
/**
 * Content Block: rich text with an optional facts panel.
 */
$eyebrow = get_field( 'eyebrow' );
$heading = get_field( 'heading' );
$lede    = get_field( 'lede' );
$content = get_field( 'content' );
$facts   = array_filter( get_field( 'facts' ) ?: array(), function ( $fact ) { return ! empty( $fact['value'] ); } );
$anchor  = ! empty( $block['anchor'] ) ? ' id="' . esc_attr( $block['anchor'] ) . '"' : '';
$classes = 'section content-block' . ( $facts ? ' content-block--has-facts' : '' ) . cre8_background_class( get_field( 'background' ) );
?>
<section class="<?php echo esc_attr( $classes ); ?>"<?php echo $anchor; ?>>
	<div class="content-block__inner container">
		<div class="content-block__body rich-copy">
			<?php if ( $eyebrow ) : ?><p class="eyebrow"><?php echo esc_html( $eyebrow ); ?></p><?php endif; ?>
			<?php if ( $heading ) : ?><h2 class="content-block__title"><?php echo esc_html( $heading ); ?></h2><?php endif; ?>
			<?php if ( $lede ) : ?><p class="content-block__lede lede"><?php echo esc_html( $lede ); ?></p><?php endif; ?>
			<?php if ( $content ) echo wp_kses_post( $content ); ?>
		</div>
		<?php if ( $facts ) : ?>
		<aside class="content-block__facts facts">
			<?php foreach ( $facts as $fact ) : ?>
			<div class="facts__item">
				<small class="facts__label"><?php echo esc_html( $fact['label'] ); ?></small>
				<strong class="facts__value"><?php echo wp_kses( $fact['value'], array( 'a' => array( 'href' => array(), 'target' => array(), 'rel' => array() ), 'br' => array() ) ); ?></strong>
			</div>
			<?php endforeach; ?>
		</aside>
		<?php endif; ?>
	</div>
</section>
