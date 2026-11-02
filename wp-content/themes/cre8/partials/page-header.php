<?php
/**
 * Page header (inner page hero), used by the Page Header block and by the post, blog, search and 404 templates.
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
$classes  = 'page-header' . ( 'tall' === $args['size'] ? '' : ' page-header--standard' ) . ( $image_id ? '' : ' page-header--plain' );
?>
<section class="<?php echo esc_attr( $classes ); ?>"<?php echo $args['anchor'] ? ' id="' . esc_attr( $args['anchor'] ) . '"' : ''; ?>>
	<?php if ( $image_id ) echo wp_get_attachment_image( $image_id, 'full', false, array( 'class' => 'page-header__image', 'alt' => '' ) ); ?>
	<div class="container">
		<div class="page-header__content">
			<?php if ( $args['breadcrumbs'] ) cre8_breadcrumbs(); ?>
			<?php if ( $args['eyebrow'] ) : ?><p class="eyebrow"><?php echo esc_html( $args['eyebrow'] ); ?></p><?php endif; ?>
			<h1 class="page-header__title"><?php echo esc_html( $args['heading'] ); ?></h1>
			<?php if ( $args['lede'] ) : ?><p class="page-header__lede lede"><?php echo esc_html( $args['lede'] ); ?></p><?php endif; ?>
		</div>
	</div>
</section>
