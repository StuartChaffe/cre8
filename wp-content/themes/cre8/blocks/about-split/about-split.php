<?php
/**
 * About Split: intro copy beside a list of accreditations.
 */
$eyebrow = get_field( 'eyebrow' );
$heading = get_field( 'heading' );
$lead    = get_field( 'lead' );
$text    = get_field( 'text' );
$items   = get_field( 'items' ) ?: array();
$anchor  = ! empty( $block['anchor'] ) ? ' id="' . esc_attr( $block['anchor'] ) . '"' : '';
?>
<section class="section"<?php echo $anchor; ?>>
	<div class="wrap about-grid">
		<div class="about-copy reveal">
			<?php if ( $eyebrow ) : ?><p class="eyebrow"><?php echo esc_html( $eyebrow ); ?></p><?php endif; ?>
			<?php if ( $heading ) : ?><h2><?php echo esc_html( $heading ); ?></h2><?php endif; ?>
			<?php if ( $lead ) : ?><p class="lead"><?php echo esc_html( $lead ); ?></p><?php endif; ?>
			<?php if ( $text ) echo wp_kses_post( $text ); ?>
			<?php echo cre8_link( get_field( 'link' ), 'text-link' ); ?>
		</div>
		<?php if ( $items ) : ?>
		<div class="accreditations reveal" aria-label="Accreditations and memberships">
			<?php foreach ( $items as $item ) : ?>
			<div class="accreditation">
				<div>
					<?php if ( $item['label'] ) : ?><small><?php echo esc_html( $item['label'] ); ?></small><?php endif; ?>
					<strong><?php echo esc_html( $item['title'] ); ?></strong>
				</div>
				<?php echo ! empty( $item['logo'] ) ? cre8_image( $item['logo'], 'medium' ) : cre8_text_mark( $item['mark'] ); ?>
			</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
	</div>
</section>
