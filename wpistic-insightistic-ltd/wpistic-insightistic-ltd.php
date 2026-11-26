<?php
/**
 * Plugin Name: WordPressistic · Insightistic LTD
 * Description: Displays the Insightistic lifetime offer on the public homepage of an ecosystem WordPress site.
 * Version: 1.0.0
 * Author: WordPressistic
 * Author URI: https://www.wordpressistic.com/
 * License: GPL-2.0-or-later
 * Text Domain: wpistic-insightistic-ltd
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Only show the campaign on first-party, production marketing homepages.
 *
 * The host allowlist prevents a cloned staging instance from promoting by default.
 */
function wpistic_insightistic_ltd_visible() {
	$host = wp_parse_url( home_url( '/' ), PHP_URL_HOST );
	$sites = array( 'wordpressistic.com', 'wpistic.com', 'chatbotistic.com', 'memberistic.com' );
	$host = is_string( $host ) ? preg_replace( '/^www\./i', '', strtolower( $host ) ) : '';

	return is_front_page() && ! is_feed() && ! is_preview() && in_array( $host, $sites, true );
}

function wpistic_insightistic_ltd_assets() {
	if ( ! wpistic_insightistic_ltd_visible() ) {
		return;
	}

	wp_enqueue_style( 'wpistic-insightistic-ltd', plugins_url( 'assets/banner.css', __FILE__ ), array(), '1.0.0' );
	wp_enqueue_script( 'wpistic-insightistic-ltd', plugins_url( 'assets/banner.js', __FILE__ ), array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'wpistic_insightistic_ltd_assets' );

function wpistic_insightistic_ltd_banner() {
	if ( ! wpistic_insightistic_ltd_visible() ) {
		return;
	}
	?>
	<aside class="wpistic-ins-ltd" aria-label="<?php esc_attr_e( 'Insightistic offer', 'wpistic-insightistic-ltd' ); ?>">
		<div class="wpistic-ins-ltd__inner">
			<div class="wpistic-ins-ltd__copy">
				<strong><?php esc_html_e( 'Insightistic lifetime deal', 'wpistic-insightistic-ltd' ); ?></strong>
				<span><?php esc_html_e( 'Track search, site health, and WooCommerce in one workspace.', 'wpistic-insightistic-ltd' ); ?></span>
			</div>
			<a class="wpistic-ins-ltd__cta" href="https://www.insightistic.com/ltd/"><?php esc_html_e( 'Compare lifetime tiers', 'wpistic-insightistic-ltd' ); ?> <span aria-hidden="true">&rarr;</span></a>
			<button class="wpistic-ins-ltd__dismiss" type="button" hidden aria-label="<?php esc_attr_e( 'Dismiss the Insightistic promotion', 'wpistic-insightistic-ltd' ); ?>"><span aria-hidden="true">&times;</span></button>
		</div>
	</aside>
	<?php
}
add_action( 'wp_body_open', 'wpistic_insightistic_ltd_banner', 25 );
