<?php
/**
 * Idempotently provision the public directory and legal pages on activation.
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
		'knowledgebase'   => array( 'Knowledgebase', 'page-templates/template-knowledgebase.php' ),
		'ecosystem'       => array( 'Ecosystem', 'page-templates/template-ecosystem.php' ),
		'sitemap'         => array( 'Sitemap', 'page-templates/template-sitemap.php' ),
		'privacy-policy'  => array( 'Privacy Policy', 'page-templates/template-privacy.php' ),
		'terms'           => array( 'Terms of Service', 'page-templates/template-terms.php' ),
		'cookies'         => array( 'Cookie Policy', 'page-templates/template-cookies.php' ),
		'data-processing' => array( 'Data Processing Information', 'page-templates/template-data-processing.php' ),
		'accessibility'   => array( 'Accessibility Statement', 'page-templates/template-accessibility.php' ),
		'refunds'         => array( 'Refund & Cancellation Policy', 'page-templates/template-refunds.php' ),
		'acceptable-use'  => array( 'Acceptable Use Policy', 'page-templates/template-acceptable-use.php' ),
		'subprocessors'   => array( 'Subprocessors', 'page-templates/template-subprocessors.php' ),
		'legal-notices'   => array( 'Legal Notices', 'page-templates/template-legal-notices.php' ),
	);

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
			continue;
		}

		$current_template = get_page_template_slug( $page_id );
		if ( ! $current_template || 'default' === $current_template ) {
			update_post_meta( $page_id, '_wp_page_template', $page[1] );
		}
	}
}
add_action( 'after_switch_theme', 'insightistic_provision_public_pages', 5 );

