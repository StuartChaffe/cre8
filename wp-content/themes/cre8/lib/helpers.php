<?php

/**
 * Handy function for seeing if a page is parent of child
 * Usage: if ( is_tree(2) ) { ... }
 */
function is_tree( $pid ) {
	global $post;
	$ancestors = get_post_ancestors( $pid );
	return is_page() && ( is_page( $pid ) || $post->post_parent == $pid || in_array( $pid, $ancestors ) );
}



/**
 * SVG helper icon
 * Usage:
 */

function get_icon( $icon ) {
	return '<svg class="icon icon-' . $icon . '"><use href="#' . $icon . '"></use></svg>';
}



/**
 * Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
 * https://gist.github.com/accentinteractive/3838495
 */
if (!function_exists('dump')) {
    function dump ($var, $label = 'Dump', $echo = TRUE)
    {
        // Store dump in variable
        ob_start();
        var_dump($var);
        $output = ob_get_clean();

        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';

        // Output
        if ($echo == TRUE) {
            echo $output;
        }
        else {
            return $output;
        }
    }
}


if (!function_exists('dump_exit')) {
    function dump_exit($var, $label = 'Dump', $echo = TRUE) {
        dump ($var, $label, $echo);
        exit;
    }
}



function my_login_logo() { ?>
	<style type="text/css">
		#login h1 a, .login h1 a {
			background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/src/images/logo.svg');
			height: 63px;
			width: 198px;
			background-size: 198px 63px;
			background-repeat: no-repeat;
		}
		.wp-core-ui .button-primary {
			/* background: #FFDA42 !important;
			background-color: #FFDA42!important;
			color: #292545 !important;
			border: 0 !important; */
			border-radius: 6px !important;
			/* padding: 0.5rem 1rem; */
		}
		body.login {
			background: #F2F1EC;
			background-color: #F2F1EC;
		}
		.login form {
			/* padding: 0px !important;
			background: transparent !important; */
			padding: 30px !important;
			border-radius: 30px;
			border: 0 !important;
			box-shadow: none !important;
		}

		/* .wp-core-ui .button.button-large {
			padding: 5px 40px !important;
			border-radius: 0px;
			font-size: 16px !important;
		}
		a {
			color: #000 !important;
		}
		.privacy-policy-page-link {
			display: none;
		}
		.login-action-login {
			display: flex;
    		flex-direction: column;
			background-color: #F3F3F3 !important;
		}
		.login label {
			font-size: 16px !important;
		}
		.login form {
			padding: 0px !important;
			background: transparent !important;
			border: 0 !important;
			box-shadow: none !important;
		}
		#login {
			padding: 0 !important;
		}
		.login #nav,
		.login #backtoblog {
			padding: 0 !important;
		}
		#login input[type=text],
		#login input[type=password] {
			border-radius: 0 !important;
			border: 0 !important;
			padding: 10px 10px !important;
			box-shadow: none !important;
		}
		.login .button.wp-hide-pw .dashicons {
			top: 10px !important;
		} */
	</style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );



/**
 * Theme Options value, or a default when ACF is missing or the field is empty.
 */
function cre8_option( $name, $default = '' ) {
	if ( ! function_exists( 'get_field' ) ) {
		return $default;
	}
	$value = get_field( $name, 'option' );
	return $value ? $value : $default;
}



/**
 * Render an ACF link array as an <a>. Returns '' when the link is empty.
 */
function cre8_link( $link, $class = '', $fallback_text = '' ) {
	if ( empty( $link['url'] ) ) {
		return '';
	}
	$text   = ! empty( $link['title'] ) ? $link['title'] : $fallback_text;
	$target = ! empty( $link['target'] ) ? ' target="' . esc_attr( $link['target'] ) . '" rel="noopener"' : '';
	$class  = $class ? ' class="' . esc_attr( $class ) . '"' : '';
	return '<a' . $class . ' href="' . esc_url( $link['url'] ) . '"' . $target . '>' . esc_html( $text ) . '</a>';
}



/**
 * Render an ACF image array. Extra attributes are passed as an array.
 */
function cre8_image( $image, $size = 'large', $attr = array() ) {
	if ( empty( $image['ID'] ) ) {
		return '';
	}
	return wp_get_attachment_image( $image['ID'], $size, false, $attr );
}



/**
 * Eyebrow, heading and intro used at the top of most sections.
 */
function cre8_section_head( $eyebrow, $heading, $intro = '' ) {
	if ( ! $eyebrow && ! $heading && ! $intro ) {
		return;
	}
	?>
	<div class="section-head u-reveal">
		<div class="section-head__text">
			<?php if ( $eyebrow ) : ?><p class="eyebrow"><?php echo esc_html( $eyebrow ); ?></p><?php endif; ?>
			<?php if ( $heading ) : ?><h2 class="section-head__title"><?php echo esc_html( $heading ); ?></h2><?php endif; ?>
		</div>
		<?php if ( $intro ) : ?><p class="section-head__intro lede"><?php echo esc_html( $intro ); ?></p><?php endif; ?>
	</div>
	<?php
}



/**
 * Section background modifier from the block's Background field.
 */
function cre8_background_class( $background ) {
	return in_array( $background, array( 'panel', 'light' ), true ) ? ' section--' . $background : '';
}



/**
 * Text logo such as PRINCE2, with the trailing number picked out in pink.
 */
function cre8_text_mark( $mark, $class = '', $caption = '' ) {
	if ( ! $mark ) {
		return '';
	}
	$html = '<span class="text-mark__name">' . preg_replace( '/(\d+)$/', '<b class="text-mark__number">$1</b>', esc_html( $mark ) ) . '</span>';
	if ( $caption ) {
		$html .= '<small class="text-mark__caption">' . esc_html( $caption ) . '</small>';
	}
	return '<div class="' . esc_attr( trim( 'text-mark ' . $class ) ) . '" aria-label="' . esc_attr( $mark ) . '">' . $html . '</div>';
}



/**
 * Heading text where *word* is shown highlighted.
 */
function cre8_highlight( $text, $class = 'u-highlight' ) {
	return preg_replace( '/\*([^*]+)\*/', '<em class="' . esc_attr( $class ) . '">$1</em>', esc_html( $text ) );
}



/**
 * Breadcrumbs: Home / ancestors / current page.
 */
function cre8_breadcrumbs() {
	if ( is_front_page() ) {
		return;
	}
	$items = array( '<a class="breadcrumbs__link" href="' . esc_url( home_url( '/' ) ) . '">Home</a>' );

	if ( is_singular( 'post' ) || is_home() || is_archive() ) {
		$blog = (int) get_option( 'page_for_posts' );
		if ( $blog && ! is_home() ) {
			$items[] = '<a class="breadcrumbs__link" href="' . esc_url( get_permalink( $blog ) ) . '">' . esc_html( get_the_title( $blog ) ) . '</a>';
		}
	}

	if ( is_page() ) {
		foreach ( array_reverse( get_post_ancestors( get_the_ID() ) ) as $ancestor ) {
			$items[] = '<a class="breadcrumbs__link" href="' . esc_url( get_permalink( $ancestor ) ) . '">' . esc_html( get_the_title( $ancestor ) ) . '</a>';
		}
	}

	if ( is_home() ) {
		$items[] = esc_html( single_post_title( '', false ) );
	} elseif ( is_archive() ) {
		$items[] = esc_html( wp_strip_all_tags( get_the_archive_title() ) );
	} elseif ( is_search() ) {
		$items[] = 'Search';
	} elseif ( is_404() ) {
		$items[] = 'Page not found';
	} else {
		$items[] = esc_html( get_the_title() );
	}

	$current = array_pop( $items );
	$items[] = '<span class="breadcrumbs__current" aria-current="page">' . $current . '</span>';

	echo '<nav class="breadcrumbs" aria-label="Breadcrumb">' . implode( '<span class="breadcrumbs__sep" aria-hidden="true">/</span>', $items ) . '</nav>';
}
