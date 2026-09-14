<?php
/**
 * Insightistic Marketing — theme bootstrap.
 *
 * The theme is intentionally thin: each concern lives in its own file under
 * /inc so the codebase stays modular, readable and secure. No plugin logic
 * lives in the theme; the SaaS app, accounts and dashboard are external
 * (app.insightistic.com / api.insightistic.com).
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Keep the marketing theme's cache-busting version separate from the
// Insightistic Connector plugin's global version constant.
define( 'INSIGHTISTIC_MARKETING_VERSION', '1.4.3' );
define( 'INSIGHTISTIC_DIR', get_template_directory() );
define( 'INSIGHTISTIC_URI', get_template_directory_uri() );

$insightistic_modules = array(
	'/inc/setup.php',          // theme supports, menus, image sizes
	'/inc/security.php',       // hardening + safe output helpers
	'/inc/helpers.php',        // app URL, Formistic, pricing data, brand links
	'/inc/site-data.php',      // legal entity, knowledgebase and ecosystem data
	'/inc/legal.php',          // reusable legal document renderer
	'/inc/discovery.php',      // XML/text discovery endpoints and robots policy
	'/inc/page-provisioning.php', // idempotent public page/template setup
	'/inc/formistic-provisioning.php', // auto-creates the 4 builder forms (spec §16.3)
	'/inc/seo.php',            // canonical + Open Graph/Twitter meta, resource hints
	'/inc/template-tags.php',  // reusable output (breadcrumbs, meta, pagination)
	'/inc/cpt.php',            // optional testimonial CPT
	'/inc/customizer.php',     // site-owner editable options
	'/inc/enqueue.php',        // styles + scripts (no jQuery, deferred JS)
	'/inc/admin.php',          // marketing-site settings page (App/API URLs etc.)
	'/inc/blocks.php',         // block patterns
);

foreach ( $insightistic_modules as $insightistic_module ) {
	$insightistic_path = INSIGHTISTIC_DIR . $insightistic_module;
	if ( is_readable( $insightistic_path ) ) {
		require_once $insightistic_path;
	}
}

// Register widget areas (footer columns + blog sidebar).
add_action(
	'widgets_init',
	function () {
		$areas = array(
			'footer-1'    => __( 'Footer Column 1', 'insightistic-marketing' ),
			'footer-2'    => __( 'Footer Column 2', 'insightistic-marketing' ),
			'footer-3'    => __( 'Footer Column 3', 'insightistic-marketing' ),
			'blog-sidebar' => __( 'Blog Sidebar', 'insightistic-marketing' ),
		);
		foreach ( $areas as $id => $name ) {
			register_sidebar(
				array(
					'name'          => $name,
					'id'            => $id,
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
				)
			);
		}
	}
);


/**
 * Use the dedicated integrations template even when an older install still
 * has the page assigned to WordPress's default page template.
 */
add_filter(
	'template_include',
	function ( $template ) {
		if ( is_page( 'integrations' ) ) {
			$integrations_template = INSIGHTISTIC_DIR . '/page-templates/template-integrations.php';
			if ( is_readable( $integrations_template ) ) {
				return $integrations_template;
			}
		}
		return $template;
	},
	99
);
