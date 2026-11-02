<?php
/**
 * Product Detail: image gallery beside the product description, key points and datasheet.
 * Thumbnails swap the large image (src/js/components/product-gallery.js).
 */
$images   = get_field( 'gallery' ) ?: array();
$eyebrow  = get_field( 'eyebrow' );
$heading  = get_field( 'heading' );
$content  = get_field( 'content' );
$file     = get_field( 'datasheet' );
$label    = get_field( 'datasheet_label' ) ?: 'Download datasheet';
$link     = get_field( 'link' );
$note     = get_field( 'note' );
$anchor   = ! empty( $block['anchor'] ) ? ' id="' . esc_attr( $block['anchor'] ) . '"' : '';
$first    = $images[0] ?? null;
?>
<section class="section product-detail"<?php echo $anchor; ?>>
	<div class="product-detail__inner container">
		<?php if ( $first ) : ?>
		<div class="product-detail__gallery product-gallery" data-product-gallery>
			<div class="product-gallery__stage">
				<?php echo wp_get_attachment_image( $first['ID'], 'large', false, array( 'class' => 'product-gallery__image', 'data-gallery-stage' => '', 'sizes' => '(min-width: 900px) 55vw, 100vw' ) ); ?>
			</div>
			<?php if ( count( $images ) > 1 ) : ?>
			<div class="product-gallery__thumbs" role="group" aria-label="Product images">
				<?php foreach ( $images as $i => $image ) :
					$large = wp_get_attachment_image_src( $image['ID'], 'large' );
					?>
				<button class="product-gallery__thumb<?php echo 0 === $i ? ' is-active' : ''; ?>" type="button" aria-pressed="<?php echo 0 === $i ? 'true' : 'false'; ?>"
					data-gallery-image="<?php echo esc_url( $large[0] ?? '' ); ?>"
					data-gallery-srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( $image['ID'], 'large' ) ?: '' ); ?>"
					data-gallery-alt="<?php echo esc_attr( $image['alt'] ); ?>"
					aria-label="<?php echo esc_attr( sprintf( 'Show image %d of %d', $i + 1, count( $images ) ) ); ?>">
					<?php echo wp_get_attachment_image( $image['ID'], 'medium', false, array( 'class' => 'product-gallery__thumb-image', 'alt' => '', 'loading' => 'lazy' ) ); ?>
				</button>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>

		<article class="product-detail__content rich-copy">
			<?php if ( $eyebrow ) : ?><p class="eyebrow"><?php echo esc_html( $eyebrow ); ?></p><?php endif; ?>
			<?php if ( $heading ) : ?><h2 class="product-detail__title"><?php echo esc_html( $heading ); ?></h2><?php endif; ?>
			<?php if ( $content ) echo wp_kses_post( $content ); ?>

			<?php if ( ! empty( $file['url'] ) || ! empty( $link['url'] ) ) : ?>
			<div class="product-detail__actions">
				<?php if ( ! empty( $file['url'] ) ) : ?>
				<a class="product-detail__download btn" href="<?php echo esc_url( $file['url'] ); ?>" download>
					<?php echo esc_html( $label ); ?>
					<span class="sr-only">(PDF, <?php echo esc_html( size_format( $file['filesize'] ?? 0 ) ); ?>)</span>
				</a>
				<?php endif; ?>
				<?php echo cre8_link( $link, 'product-detail__link text-link' ); ?>
			</div>
			<?php endif; ?>

			<?php if ( $note ) : ?><p class="product-detail__note"><?php echo esc_html( $note ); ?></p><?php endif; ?>
		</article>
	</div>
</section>
