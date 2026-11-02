<?php
/**
 * Hero Slider: homepage hero with rotating background images.
 * Slide titles, summaries and links are read by src/js/components/hero-slider.js.
 */
$eyebrow = get_field( 'eyebrow' );
$heading = get_field( 'heading' ) ?: get_the_title();
$text    = get_field( 'text' );
$slides  = get_field( 'slides' ) ?: array();
$first   = $slides[0] ?? null;
$anchor  = ! empty( $block['anchor'] ) ? ' id="' . esc_attr( $block['anchor'] ) . '"' : '';
?>
<section class="hero-slider"<?php echo $anchor; ?> data-hero-slider>
	<?php if ( $slides ) : ?>
	<div class="hero-slider__slides" aria-hidden="true">
		<?php foreach ( $slides as $i => $slide ) : ?>
		<div class="hero-slider__slide<?php echo 0 === $i ? ' is-active' : ''; ?>"
			data-title="<?php echo esc_attr( $slide['title'] ); ?>"
			data-summary="<?php echo esc_attr( $slide['summary'] ); ?>"
			data-label="<?php echo esc_attr( $slide['link']['title'] ?? '' ); ?>"
			data-href="<?php echo esc_url( $slide['link']['url'] ?? '' ); ?>">
			<?php echo cre8_image( $slide['image'], 'full', array( 'class' => 'hero-slider__image', 'alt' => '', 'loading' => 0 === $i ? 'eager' : 'lazy' ) ); ?>
		</div>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>
	<div class="hero-slider__grid" aria-hidden="true"></div>
	<div class="hero-slider__content container">
		<div class="hero-slider__panel">
			<?php if ( $eyebrow ) : ?><p class="eyebrow"><?php echo esc_html( $eyebrow ); ?></p><?php endif; ?>
			<h1 class="hero-slider__title"><?php echo cre8_highlight( $heading, 'hero-slider__highlight' ); ?></h1>
			<?php if ( $text ) : ?><p class="hero-slider__text"><?php echo esc_html( $text ); ?></p><?php endif; ?>

			<?php if ( $first ) : ?>
			<div class="hero-slider__meta" aria-live="polite">
				<span class="hero-slider__caption"><strong class="hero-slider__caption-title" data-slide-title><?php echo esc_html( $first['title'] ); ?></strong> <span aria-hidden="true">/</span> <span data-slide-summary><?php echo esc_html( $first['summary'] ); ?></span></span>
				<?php if ( ! empty( $first['link']['url'] ) ) : ?>
				<a class="hero-slider__link" data-slide-link href="<?php echo esc_url( $first['link']['url'] ); ?>"><?php echo esc_html( $first['link']['title'] ); ?></a>
				<?php endif; ?>
			</div>
			<?php endif; ?>

			<?php if ( count( $slides ) > 1 ) : ?>
			<div class="hero-slider__controls" role="group" aria-label="Hero slides">
				<?php foreach ( $slides as $i => $slide ) : ?>
				<button class="hero-slider__dot<?php echo 0 === $i ? ' is-active' : ''; ?>" type="button" aria-label="<?php echo esc_attr( 'Show ' . $slide['title'] ); ?>"<?php echo 0 === $i ? ' aria-current="true"' : ''; ?>></button>
				<?php endforeach; ?>
				<button class="hero-slider__toggle" type="button" aria-label="Pause slideshow"><span class="hero-slider__icon hero-slider__icon--pause" aria-hidden="true"></span></button>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>
