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
 * A top-level item with children becomes a <details> dropdown (.primary-nav__group). Its first link is the parent page
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
			$output .= '<details class="primary-nav__group"><summary class="primary-nav__toggle">' . esc_html( $title ) . '</summary><div class="primary-nav__panel">';
			if ( $item->url && '#' !== $item->url ) {
				$output .= '<a class="primary-nav__sub-link" href="' . esc_url( $item->url ) . '"' . $current . '>' . esc_html( sprintf( __( 'All %s', 'cre8' ), $title ) ) . '</a>';
			}
			return;
		}

		$class   = ' class="' . ( 0 === $depth ? 'primary-nav__link' : 'primary-nav__sub-link' ) . '"';
		$output .= '<a' . $class . ' href="' . esc_url( $item->url ) . '"' . $target . $current . '>' . esc_html( $title ) . '</a>';
	}

	public function end_el( &$output, $item, $depth = 0, $args = null ) {
		if ( 0 === $depth && in_array( 'menu-item-has-children', (array) $item->classes, true ) ) {
			$output .= '</div></details>';
		}
	}
}



/**
 * Footer menus: a flat list of links, each given the class passed in.
 */
class Cre8_Flat_Walker extends Walker_Nav_Menu {
	private string $link_class;

	public function __construct( string $link_class = '' ) {
		$this->link_class = $link_class;
	}

	public function start_lvl( &$output, $depth = 0, $args = null ) {}
	public function end_lvl( &$output, $depth = 0, $args = null ) {}
	public function end_el( &$output, $item, $depth = 0, $args = null ) {}

	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$target  = $item->target ? ' target="' . esc_attr( $item->target ) . '" rel="noopener"' : '';
		$class   = $this->link_class ? ' class="' . esc_attr( $this->link_class ) . '"' : '';
		$output .= '<a' . $class . ' href="' . esc_url( $item->url ) . '"' . $target . '>' . esc_html( apply_filters( 'the_title', $item->title, $item->ID ) ) . '</a>';
	}
}
