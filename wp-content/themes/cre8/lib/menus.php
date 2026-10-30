<?php

/**
 * Register menus
 */
add_action( 'after_setup_theme', function() {
	register_nav_menus( array(
		'primary'        => __( 'Main navigation', 'cre8' ),
		'footer'         => __( 'Footer: Explore', 'cre8' ),
		'footer-connect' => __( 'Footer: Connect', 'cre8' ),
		'legal'          => __( 'Footer: Legal', 'cre8' ),
	) );
} );



/**
 * Main navigation.
 * A top-level item with children becomes a <details> dropdown. Its first link is the parent page
 * ("All About"), unless the parent's URL is "#". Items without children are plain links.
 */
class Cre8_Nav_Walker extends Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = null ) {}
	public function end_lvl( &$output, $depth = 0, $args = null ) {}

	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$title   = apply_filters( 'the_title', $item->title, $item->ID );
		$target  = $item->target ? ' target="' . esc_attr( $item->target ) . '" rel="noopener"' : '';
		$current = $item->current ? ' aria-current="page"' : '';

		if ( 0 === $depth && in_array( 'menu-item-has-children', (array) $item->classes, true ) ) {
			$output .= '<details class="nav-group"><summary>' . esc_html( $title ) . '</summary><div class="nav-panel">';
			if ( $item->url && '#' !== $item->url ) {
				$output .= '<a href="' . esc_url( $item->url ) . '"' . $current . '>' . esc_html( sprintf( __( 'All %s', 'cre8' ), $title ) ) . '</a>';
			}
			return;
		}

		$class   = 0 === $depth ? ' class="nav-direct"' : '';
		$output .= '<a' . $class . ' href="' . esc_url( $item->url ) . '"' . $target . $current . '>' . esc_html( $title ) . '</a>';
	}

	public function end_el( &$output, $item, $depth = 0, $args = null ) {
		if ( 0 === $depth && in_array( 'menu-item-has-children', (array) $item->classes, true ) ) {
			$output .= '</div></details>';
		}
	}
}



/**
 * Footer menus: a flat list of links.
 */
class Cre8_Flat_Walker extends Walker_Nav_Menu {
	public function start_lvl( &$output, $depth = 0, $args = null ) {}
	public function end_lvl( &$output, $depth = 0, $args = null ) {}
	public function end_el( &$output, $item, $depth = 0, $args = null ) {}

	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$target  = $item->target ? ' target="' . esc_attr( $item->target ) . '" rel="noopener"' : '';
		$output .= '<a href="' . esc_url( $item->url ) . '"' . $target . '>' . esc_html( apply_filters( 'the_title', $item->title, $item->ID ) ) . '</a>';
	}
}
