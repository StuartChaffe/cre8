<?php
$phone         = cre8_option( 'phone' );
$phone_display = cre8_option( 'phone_display', $phone );
$email         = cre8_option( 'email' );
$address       = cre8_option( 'address' );
$social        = cre8_option( 'social_links', array() );
?>
<footer class="site-footer">
	<div class="wrap footer-grid">
		<div class="footer-brand">
			<img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/logo.png' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>" width="140" height="63" loading="lazy">
			<?php if ( $text = cre8_option( 'footer_text' ) ) : ?><p><?php echo esc_html( $text ); ?></p><?php endif; ?>
		</div>

		<div class="footer-col">
			<strong>Explore</strong>
			<?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false, 'items_wrap' => '%3$s', 'depth' => 1, 'fallback_cb' => false, 'walker' => new Cre8_Flat_Walker() ) ); ?>
		</div>

		<div class="footer-col">
			<strong>Connect</strong>
			<?php wp_nav_menu( array( 'theme_location' => 'footer-connect', 'container' => false, 'items_wrap' => '%3$s', 'depth' => 1, 'fallback_cb' => false, 'walker' => new Cre8_Flat_Walker() ) ); ?>
			<?php if ( $email ) : ?><a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>"><?php echo esc_html( antispambot( $email ) ); ?></a><?php endif; ?>
			<?php if ( $phone ) : ?><a href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo esc_html( $phone_display ); ?></a><?php endif; ?>
			<?php if ( ! empty( $social['linkedin_url'] ) ) : ?>
			<a class="footer-social-link" href="<?php echo esc_url( $social['linkedin_url'] ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) . ' on LinkedIn' ); ?>">
				<svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M20.4 20.5h-3.5v-5.6c0-1.3 0-3-1.9-3s-2.1 1.4-2.1 2.9v5.7H9.4V9h3.4v1.6c.5-.9 1.6-1.9 3.4-1.9 3.6 0 4.3 2.4 4.3 5.5v6.3zM5.3 7.4a2.1 2.1 0 1 1 0-4.1 2.1 2.1 0 0 1 0 4.1zm1.8 13.1H3.6V9h3.5v11.5zM22.2 0H1.8C.8 0 0 .8 0 1.7v20.5c0 1 .8 1.8 1.8 1.8h20.4c1 0 1.8-.8 1.8-1.8V1.7C24 .8 23.2 0 22.2 0z"/></svg>
			</a>
			<?php endif; ?>
			<?php if ( $address ) : ?><address><?php echo wp_kses( $address, array( 'br' => array() ) ); ?></address><?php endif; ?>
		</div>
	</div>
	<div class="wrap footer-bottom">
		<span>&copy; <?php echo esc_html( gmdate( 'Y' ) . ' ' . get_bloginfo( 'name' ) ); ?>. All rights reserved.</span>
		<span class="footer-legal">
			<?php wp_nav_menu( array( 'theme_location' => 'legal', 'container' => false, 'items_wrap' => '%3$s', 'depth' => 1, 'fallback_cb' => false, 'walker' => new Cre8_Flat_Walker() ) ); ?>
		</span>
	</div>
</footer>
