<?php
/**
 * Trust Strip: accreditation and membership logos.
 */
$items = get_field( 'items' ) ?: array();
if ( ! $items ) {
	if ( $is_preview ) echo '<p class="block-placeholder">Trust Strip: add some items.</p>';
	return;
}
?>
<aside class="trust-strip" aria-label="Accreditations and memberships">
	<div class="trust-strip__grid container">
		<?php foreach ( $items as $item ) : ?>
		<div class="trust-strip__item">
			<?php if ( ! empty( $item['logo'] ) ) : ?>
				<?php echo cre8_image( $item['logo'], 'medium', array( 'class' => 'trust-strip__logo' ) ); ?>
				<?php if ( $item['title'] ) : ?><strong class="trust-strip__title"><?php echo esc_html( $item['title'] ); ?></strong><?php endif; ?>
			<?php else : ?>
				<?php echo cre8_text_mark( $item['mark'], 'trust-strip__mark', $item['title'] ); ?>
			<?php endif; ?>
			<?php if ( $item['text'] ) : ?><span class="trust-strip__text"><?php echo esc_html( $item['text'] ); ?></span><?php endif; ?>
		</div>
		<?php endforeach; ?>
	</div>
</aside>
