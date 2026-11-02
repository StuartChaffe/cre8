<?php
/**
 * Page Header: inner page hero. Supplies the page's only <h1>.
 */
get_template_part( 'partials/page-header', null, array(
	'eyebrow'     => get_field( 'eyebrow' ),
	'heading'     => get_field( 'heading' ) ?: get_the_title(),
	'lede'        => get_field( 'lede' ),
	'image'       => get_field( 'image' ),
	'size'        => get_field( 'size' ),
	'breadcrumbs' => get_field( 'breadcrumbs' ) && ! $is_preview,
	'anchor'      => $block['anchor'] ?? '',
) );
