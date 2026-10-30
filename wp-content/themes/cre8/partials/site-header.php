<?php
$phone         = cre8_option( 'phone' );
$phone_display = cre8_option( 'phone_display', $phone );
$cta           = cre8_option( 'header_cta' );
$logo          = get_theme_file_uri( 'assets/images/logo.png' );
?>
<header class="site-header">
	<div class="wrap nav-shell">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) . ' home' ); ?>">
			<img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" width="116" height="52">
		</a>

		<div class="mobile-actions">
			<?php if ( $phone ) : ?>
			<a class="mobile-phone" href="tel:<?php echo esc_attr( $phone ); ?>" aria-label="<?php echo esc_attr( 'Call us on ' . $phone_display ); ?>"><?php get_template_part( 'partials/icon-phone' ); ?></a>
			<?php endif; ?>
			<?php echo cre8_link( $cta, 'mobile-cta' ); ?>
		</div>

		<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="site-menu" aria-label="Open menu"><span></span></button>

		<nav class="nav-links" id="site-menu" aria-label="Main navigation">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'items_wrap'     => '%3$s',
				'depth'          => 2,
				'fallback_cb'    => false,
				'walker'         => new Cre8_Nav_Walker(),
			) );
			?>
			<form class="site-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" role="search">
				<label class="sr-only" for="site-search">Search</label>
				<input id="site-search" name="s" type="search" placeholder="Search" value="<?php echo esc_attr( get_search_query() ); ?>" required>
				<button type="submit" aria-label="Search"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg></button>
			</form>
			<?php if ( $phone ) : ?>
			<a class="header-phone" href="tel:<?php echo esc_attr( $phone ); ?>" aria-label="<?php echo esc_attr( 'Call us on ' . $phone_display ); ?>"><?php get_template_part( 'partials/icon-phone' ); ?><span><?php echo esc_html( $phone_display ); ?></span></a>
			<?php endif; ?>
			<?php echo cre8_link( $cta, 'button header-project-cta' ); ?>
		</nav>
	</div>
</header>
