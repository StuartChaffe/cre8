<?php
/**
 * Template Name: Project enquiry
 *
 * Full-screen, step-by-step enquiry. The form itself is the Gravity Form set up in lib/gravity-forms.php.
 */
$form_id = function_exists( 'cre8_project_form_id' ) ? cre8_project_form_id() : 0;
$phone   = cre8_option( 'phone' );
$email   = cre8_option( 'email' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php wp_head(); ?>
</head>
<body <?php body_class( 'no-js' ); ?>>
<?php wp_body_open(); ?>
<main class="project-form" id="content">
	<header class="project-form__header">
		<a class="project-form__home" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="project-form__logo" src="<?php echo esc_url( get_theme_file_uri( 'assets/images/logo.png' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>" width="105" height="52"></a>
		<a class="project-form__close" href="<?php echo esc_url( wp_get_referer() ?: home_url( '/' ) ); ?>">Close <span aria-hidden="true">[X]</span></a>
	</header>

	<div class="project-form__body">
		<?php if ( $form_id && function_exists( 'gravity_form' ) ) : ?>
			<?php gravity_form( $form_id, false, false, false, null, true, 0, true ); ?>
		<?php else : ?>
			<span class="project-form__step-number">Contact us</span>
			<h1 class="project-form__title">Tell us about your project.</h1>
			<p class="project-form__intro">
				<?php if ( $email ) : ?>Email <a class="text-link" href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>"><?php echo esc_html( antispambot( $email ) ); ?></a><?php endif; ?>
				<?php if ( $phone ) : ?> or call <a class="text-link" href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo esc_html( cre8_option( 'phone_display', $phone ) ); ?></a><?php endif; ?>.
			</p>
			<?php if ( current_user_can( 'manage_options' ) ) : ?><p class="project-form__error">Admins only: activate Gravity Forms, then load any admin page and the form is created automatically.</p><?php endif; ?>
		<?php endif; ?>
	</div>
</main>
<?php wp_footer(); ?>
</body>
</html>
