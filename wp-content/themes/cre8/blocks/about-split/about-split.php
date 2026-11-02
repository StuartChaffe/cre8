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
<section class="section about-split"<?php echo $anchor; ?>>
	<div class="about-split__inner container">
		<div class="about-split__content u-reveal">
			<?php if ( $eyebrow ) : ?><p class="eyebrow"><?php echo esc_html( $eyebrow ); ?></p><?php endif; ?>
			<?php if ( $heading ) : ?><h2 class="about-split__title"><?php echo esc_html( $heading ); ?></h2><?php endif; ?>
			<?php if ( $lead ) : ?><p class="about-split__lead lead"><?php echo esc_html( $lead ); ?></p><?php endif; ?>
			<?php if ( $text ) : ?><div class="about-split__text"><?php echo wp_kses_post( $text ); ?></div><?php endif; ?>
			<?php echo cre8_link( get_field( 'link' ), 'about-split__link text-link' ); ?>
		</div>
		<?php if ( $items ) : ?>
		<div class="about-split__list u-reveal" aria-label="Accreditations and memberships">
			<?php foreach ( $items as $item ) : ?>
			<div class="about-split__item">
				<div class="about-split__item-text">
					<?php if ( $item['label'] ) : ?><small class="about-split__label"><?php echo esc_html( $item['label'] ); ?></small><?php endif; ?>
					<strong class="about-split__name"><?php echo esc_html( $item['title'] ); ?></strong>
				</div>
				<?php echo ! empty( $item['logo'] ) ? cre8_image( $item['logo'], 'medium', array( 'class' => 'about-split__logo' ) ) : cre8_text_mark( $item['mark'], 'about-split__mark' ); ?>
			</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
	</div>
</section>
