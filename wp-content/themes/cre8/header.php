<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php wp_head(); ?>
<?php get_template_part( 'partials/global-analytics' ); ?>
</head>
<body <?php body_class( 'no-js' ); ?>>
<?php wp_body_open(); ?>
<?php get_template_part( 'partials/global-browser-notice' ); ?>
<a class="skip-nav" href="#content">Skip to main content</a>
<?php get_template_part( 'partials/global-alert' ); ?>
<?php get_template_part( 'partials/site-header' ); ?>
