<?php
/**
 * Plugin Name: Insightistic Optimizer Compatibility
 * Description: Keeps critical navigation and pricing scripts executable when host-level JavaScript optimizers are enabled.
 * Version: 1.0.0
 * Author: Insightistic
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Exclude small interaction bundles from Airlift and Cloudflare rewriting.
 *
 * These scripts already use the browser's native `defer` behavior. Reprocessing
 * them can leave a non-standard script type in the final HTML, preventing the
 * mobile-menu handler from attaching before a visitor's first tap.
 *
 * @param string $tag    Complete script tag.
 * @param string $handle Registered WordPress script handle.
 * @return string
 */
function insightistic_optimizer_compatibility_tag( $tag, $handle ) {
	$critical_handles = array(
		'insightistic-theme',
		'insightistic-pricing-toggle',
		'insightistic-animations',
	);

	if ( ! in_array( $handle, $critical_handles, true ) ) {
		return $tag;
	}

	$attributes = '';
	if ( false === strpos( $tag, ' data-cfasync=' ) ) {
		$attributes .= ' data-cfasync="false"';
	}
	if ( false === strpos( $tag, ' bv-exclude=' ) ) {
		$attributes .= ' bv-exclude="true"';
	}

	if ( '' !== $attributes ) {
		$tag = str_replace( '<script ', '<script' . $attributes . ' ', $tag );
	}

	return $tag;
}
add_filter( 'script_loader_tag', 'insightistic_optimizer_compatibility_tag', PHP_INT_MAX, 2 );
