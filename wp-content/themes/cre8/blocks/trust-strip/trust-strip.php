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
<aside class="trust" aria-label="Accreditations and memberships">
	<div class="wrap trust-grid">
		<?php foreach ( $items as $item ) : ?>
		<div class="trust-item">
			<?php if ( ! empty( $item['logo'] ) ) : ?>
				<?php echo cre8_image( $item['logo'], 'medium', array( 'class' => 'trust-logo' ) ); ?>
				<?php if ( $item['title'] ) : ?><strong><?php echo esc_html( $item['title'] ); ?></strong><?php endif; ?>
			<?php else : ?>
				<?php echo cre8_text_mark( $item['mark'], 'text-mark', $item['title'] ); ?>
			<?php endif; ?>
			<?php if ( $item['text'] ) : ?><span><?php echo esc_html( $item['text'] ); ?></span><?php endif; ?>
		</div>
		<?php endforeach; ?>
	</div>
</aside>
