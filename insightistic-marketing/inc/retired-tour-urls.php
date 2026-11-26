<?php
/**
 * Retired static demo URLs replaced by the public product tour.
 *
 * @package Insightistic_Marketing
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action(
	'template_redirect',
	function () {
		$method = sanitize_key( wp_unslash( $_SERVER['REQUEST_METHOD'] ?? '' ) );
		if ( ! is_404() || ! in_array( $method, array( 'get', 'head' ), true ) ) {
			return;
		}

		$requested = wp_parse_url( wp_unslash( $_SERVER['REQUEST_URI'] ?? '' ), PHP_URL_PATH );
		$directory = '/wp-content/themes/insightistic-marketing-live-20261015-animated/assets/animations/scenes/';
		$retired   = array(
			'04-seo-trend.html',
			'05-crawl-status.html',
			'07-broken-link-priorities.html',
			'10-ai-copilot.html',
			'14-sessions-trend.html',
		);

		if ( is_string( $requested ) && $directory === dirname( $requested ) . '/' && in_array( basename( $requested ), $retired, true ) ) {
			wp_safe_redirect( home_url( '/product-tour/' ), 301, 'Insightistic' );
			exit;
		}
	},
	1
);
