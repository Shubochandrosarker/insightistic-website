<?php
/**
 * Idempotently provision public product, directory and legal pages.
 * Existing pages are never overwritten; only a default template is attached
 * when the matching page still uses the default template.
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function insightistic_provision_public_pages() {
	$pages = array(
		'features'              => array( 'Features', 'page-templates/template-features.php' ),
		'integrations'          => array( 'Integrations', 'page-templates/template-integrations.php' ),
		'traffic-analytics'    => array( 'Traffic Analytics', 'page-templates/template-traffic-analytics.php' ),
		'seo-analytics'        => array( 'SEO Analytics', 'page-templates/template-seo-analytics.php' ),
		'performance-monitoring' => array( 'Performance Monitoring', 'page-templates/template-performance-monitoring.php' ),
		'changelog'             => array( 'Changelog', 'page-templates/template-changelog.php' ),
		'knowledgebase'         => array( 'Knowledgebase', 'page-templates/template-knowledgebase.php' ),
		'ecosystem'             => array( 'Ecosystem', 'page-templates/template-ecosystem.php' ),
		'sitemap'               => array( 'Sitemap', 'page-templates/template-sitemap.php' ),
		'privacy-policy'        => array( 'Privacy Policy', 'page-templates/template-privacy.php' ),
		'terms'                 => array( 'Terms of Service', 'page-templates/template-terms.php' ),
		'cookies'               => array( 'Cookie Policy', 'page-templates/template-cookies.php' ),
		'data-processing'       => array( 'Data Processing Information', 'page-templates/template-data-processing.php' ),
		'accessibility'         => array( 'Accessibility Statement', 'page-templates/template-accessibility.php' ),
		'refunds'               => array( 'Refund & Cancellation Policy', 'page-templates/template-refunds.php' ),
		'acceptable-use'        => array( 'Acceptable Use Policy', 'page-templates/template-acceptable-use.php' ),
		'subprocessors'         => array( 'Subprocessors', 'page-templates/template-subprocessors.php' ),
		'legal-notices'         => array( 'Legal Notices', 'page-templates/template-legal-notices.php' ),
	);

	$success = true;

	foreach ( $pages as $slug => $page ) {
		$existing = get_page_by_path( $slug, OBJECT, 'page' );
		$page_id  = $existing ? (int) $existing->ID : wp_insert_post(
			array(
				'post_title'  => $page[0],
				'post_name'   => $slug,
				'post_status' => 'publish',
				'post_type'   => 'page',
			),
			true
		);

		if ( is_wp_error( $page_id ) || ! $page_id ) {
			$success = false;
			continue;
		}

		$current_template = get_page_template_slug( $page_id );
		if ( ! $current_template || 'default' === $current_template ) {
			update_post_meta( $page_id, '_wp_page_template', $page[1] );
		}
	}

	return $success;
}

add_action(
	'after_switch_theme',
	function () {
		insightistic_provision_public_pages();
	},
	5
);

/**
 * Themes can be deployed without being re-activated. Run this once for the
 * current theme version so existing installs receive missing public routes and
 * template assignments without overwriting page content.
 */
function insightistic_maybe_provision_public_pages() {
	$version = '2026-09-14-integrations-footer';

	if ( $version === get_option( 'insightistic_public_pages_version' ) ) {
		return;
	}

	if ( insightistic_provision_public_pages() ) {
		update_option( 'insightistic_public_pages_version', $version, false );
	}
}
add_action( 'init', 'insightistic_maybe_provision_public_pages', 99 );
