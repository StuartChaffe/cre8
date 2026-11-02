<?php
$phone         = cre8_option( 'phone' );
$phone_display = cre8_option( 'phone_display', $phone );
$cta           = cre8_option( 'header_cta' );
?>
<header class="site-header">
	<div class="site-header__inner container">
		<a class="site-header__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) . ' home' ); ?>">
			<img class="site-header__logo-image" src="<?php echo esc_url( get_theme_file_uri( 'assets/images/logo.png' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>" width="116" height="57">
		</a>

		<div class="site-header__mobile">
			<?php if ( $phone ) : ?>
			<a class="site-header__call" href="tel:<?php echo esc_attr( $phone ); ?>" aria-label="<?php echo esc_attr( 'Call us on ' . $phone_display ); ?>"><?php get_template_part( 'partials/icon-phone' ); ?></a>
			<?php endif; ?>
			<?php echo cre8_link( $cta, 'site-header__mobile-cta' ); ?>
		</div>

		<button class="site-header__menu-btn" type="button" aria-expanded="false" aria-controls="site-menu" aria-label="Open menu"><span class="site-header__menu-icon"></span></button>

		<nav class="site-header__nav" id="site-menu" aria-label="Main navigation">
			<div class="primary-nav">
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
			</div>
			<form class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" role="search">
				<label class="search-form__label sr-only" for="site-search">Search</label>
				<input class="search-form__input" id="site-search" name="s" type="search" placeholder="Search" value="<?php echo esc_attr( get_search_query() ); ?>" required>
				<button class="search-form__button" type="submit" aria-label="Search"><svg class="search-form__icon" viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg></button>
			</form>
			<?php if ( $phone ) : ?>
			<a class="site-header__phone" href="tel:<?php echo esc_attr( $phone ); ?>" aria-label="<?php echo esc_attr( 'Call us on ' . $phone_display ); ?>"><?php get_template_part( 'partials/icon-phone' ); ?><span class="site-header__phone-number"><?php echo esc_html( $phone_display ); ?></span></a>
			<?php endif; ?>
			<?php echo cre8_link( $cta, 'btn site-header__cta' ); ?>
		</nav>
	</div>
</header>
