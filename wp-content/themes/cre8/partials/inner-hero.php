<?php
/**
 * Inner page hero, used by the Page Header block and by the post, archive, search and 404 templates.
 * $args: eyebrow, heading, lede, image (ACF array or attachment ID), size (standard|tall), breadcrumbs, anchor.
 */
$args = wp_parse_args( $args, array(
	'eyebrow'     => '',
	'heading'     => get_the_title(),
	'lede'        => '',
	'image'       => null,
	'size'        => 'standard',
	'breadcrumbs' => true,
	'anchor'      => '',
) );
$image_id = is_array( $args['image'] ) ? ( $args['image']['ID'] ?? 0 ) : (int) $args['image'];
$classes  = 'inner-hero' . ( 'tall' === $args['size'] ? '' : ' inner-hero--standard' ) . ( $image_id ? '' : ' inner-hero--plain' );
?>
<section class="<?php echo esc_attr( $classes ); ?>"<?php echo $args['anchor'] ? ' id="' . esc_attr( $args['anchor'] ) . '"' : ''; ?>>
	<?php if ( $image_id ) echo wp_get_attachment_image( $image_id, 'full', false, array( 'class' => 'inner-hero__image', 'alt' => '' ) ); ?>
	<div class="wrap">
		<div class="inner-hero__copy">
			<?php if ( $args['breadcrumbs'] ) cre8_breadcrumbs(); ?>
			<?php if ( $args['eyebrow'] ) : ?><p class="eyebrow"><?php echo esc_html( $args['eyebrow'] ); ?></p><?php endif; ?>
			<h1><?php echo esc_html( $args['heading'] ); ?></h1>
			<?php if ( $args['lede'] ) : ?><p class="lede"><?php echo esc_html( $args['lede'] ); ?></p><?php endif; ?>
		</div>
	</div>
</section>
