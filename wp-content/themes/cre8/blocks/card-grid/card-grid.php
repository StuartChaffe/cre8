<?php
/**
 * Card Grid: numbered cards in a lined (homepage) or boxed style.
 */
$style    = 'lined' === get_field( 'style' ) ? 'lined' : 'boxed';
$numbered = get_field( 'numbered' );
$cards    = get_field( 'cards' ) ?: array();
$total    = count( $cards );
$anchor   = ! empty( $block['anchor'] ) ? ' id="' . esc_attr( $block['anchor'] ) . '"' : '';
?>
<section class="<?php echo esc_attr( 'section card-grid card-grid--' . $style . cre8_background_class( get_field( 'background' ) ) ); ?>"<?php echo $anchor; ?>>
	<div class="container">
		<?php cre8_section_head( get_field( 'eyebrow' ), get_field( 'heading' ), get_field( 'intro' ) ); ?>

		<div class="card-grid__grid">
		<?php foreach ( $cards as $i => $card ) :
			$no = sprintf( '%02d', $i + 1 );
			if ( $card['label'] ) {
				$label = $card['label'];
			} elseif ( $numbered ) {
				$label = 'lined' === $style ? $no . ' / ' . sprintf( '%02d', $total ) : $no;
			} else {
				$label = '';
			}
			$url    = $card['link']['url'] ?? '';
			$tag    = $url ? 'a' : 'article';
			$target = $url && ! empty( $card['link']['target'] ) ? ' target="_blank" rel="noopener"' : '';
			?>
			<<?php echo $tag; ?> class="card-grid__card<?php echo 'lined' === $style ? ' u-reveal' : ''; ?>"<?php echo $url ? ' href="' . esc_url( $url ) . '"' : ''; ?><?php echo $target; ?>>
				<?php if ( $label ) : ?><span class="card-grid__label"><?php echo esc_html( $label ); ?></span><?php endif; ?>
				<?php
				if ( ! empty( $card['logo'] ) ) {
					echo cre8_image( $card['logo'], 'medium', array( 'class' => 'card-grid__logo' ) );
				} elseif ( $card['mark'] ) {
					echo cre8_text_mark( $card['mark'], 'card-grid__mark' );
				}
				?>
				<?php if ( $card['title'] ) : ?><h3 class="card-grid__title"><?php echo esc_html( $card['title'] ); ?></h3><?php endif; ?>
				<?php if ( $card['text'] ) : ?><p class="card-grid__text"><?php echo esc_html( $card['text'] ); ?></p><?php endif; ?>
				<?php if ( $url && 'boxed' === $style ) : ?><span class="card-grid__link text-link"><?php echo esc_html( $card['link']['title'] ?: 'Find out more' ); ?></span><?php endif; ?>
			</<?php echo $tag; ?>>
		<?php endforeach; ?>
		</div>
	</div>
</section>
