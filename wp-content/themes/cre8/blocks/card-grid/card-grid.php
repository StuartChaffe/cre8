<?php
/**
 * Card Grid: numbered cards in a lined (homepage) or boxed style.
 */
$style    = get_field( 'style' ) ?: 'boxed';
$numbered = get_field( 'numbered' );
$cards    = get_field( 'cards' ) ?: array();
$total    = count( $cards );
$anchor   = ! empty( $block['anchor'] ) ? ' id="' . esc_attr( $block['anchor'] ) . '"' : '';
$section  = 'lined' === $style ? 'section capabilities' : 'section';
?>
<section class="<?php echo esc_attr( $section . cre8_background_class( get_field( 'background' ) ) ); ?>"<?php echo $anchor; ?>>
	<div class="wrap">
		<?php cre8_section_head( get_field( 'eyebrow' ), get_field( 'heading' ), get_field( 'intro' ) ); ?>

		<div class="<?php echo 'lined' === $style ? 'cap-grid' : 'service-grid'; ?>">
		<?php foreach ( $cards as $i => $card ) :
			$no = sprintf( '%02d', $i + 1 );
			if ( $card['label'] ) {
				$label = $card['label'];
			} elseif ( $numbered ) {
				$label = 'lined' === $style ? $no . ' / ' . sprintf( '%02d', $total ) : $no;
			} else {
				$label = '';
			}
			$url = $card['link']['url'] ?? '';
			$tag = $url ? 'a' : 'article';
			$class = 'lined' === $style ? 'cap-card reveal' : 'service-card';
			?>
			<<?php echo $tag; ?> class="<?php echo esc_attr( $class ); ?>"<?php echo $url ? ' href="' . esc_url( $url ) . '"' : ''; ?><?php echo $url && ! empty( $card['link']['target'] ) ? ' target="_blank" rel="noopener"' : ''; ?>>
				<?php if ( $label ) : ?><span class="<?php echo 'lined' === $style ? 'cap-no' : 'service-card__no'; ?>"><?php echo esc_html( $label ); ?></span><?php endif; ?>
				<?php
				if ( ! empty( $card['logo'] ) ) {
					echo cre8_image( $card['logo'], 'medium', array( 'class' => 'accreditation-logo' ) );
				} elseif ( $card['mark'] ) {
					echo cre8_text_mark( $card['mark'], 'text-mark accreditation-mark' );
				}
				?>
				<?php if ( $card['title'] ) : ?><h3><?php echo esc_html( $card['title'] ); ?></h3><?php endif; ?>
				<?php if ( $card['text'] ) : ?><p><?php echo esc_html( $card['text'] ); ?></p><?php endif; ?>
				<?php if ( $url && 'boxed' === $style ) : ?><span class="text-link"><?php echo esc_html( $card['link']['title'] ?: 'Find out more' ); ?></span><?php endif; ?>
			</<?php echo $tag; ?>>
		<?php endforeach; ?>
		</div>
	</div>
</section>
