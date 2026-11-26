<?php
/**
 * Assets — styles and scripts.
 *
 * Performance rules: no jQuery dependency, no remote fonts, a small amount of
 * vanilla JS loaded with `defer`. The pricing toggle only loads where a pricing
 * table is present.
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action(
	'wp_enqueue_scripts',
	function () {
		// Keep asset URLs fresh even if a host retains an older functions.php in
		// opcode cache for a short period after a file-manager deployment.
		$ver = defined( 'INSIGHTISTIC_MARKETING_VERSION' ) ? INSIGHTISTIC_MARKETING_VERSION : '1.6.0';
		$css = INSIGHTISTIC_URI . '/assets/css';
		$js  = INSIGHTISTIC_URI . '/assets/js';

		// Base + blocks + responsive (responsive depends on base so it cascades last).
		wp_enqueue_style( 'insightistic-theme', $css . '/theme.css', array(), $ver );
		wp_enqueue_style( 'insightistic-blocks', $css . '/blocks.css', array( 'insightistic-theme' ), $ver );
		wp_enqueue_style( 'insightistic-responsive', $css . '/responsive.css', array( 'insightistic-theme' ), $ver );
		wp_enqueue_style( 'insightistic-marketing-design', $css . '/marketing-design.css', array( 'insightistic-responsive' ), $ver );

		// Core theme JS (mobile menu, FAQ accordion, header on scroll).
		wp_enqueue_script( 'insightistic-theme', $js . '/theme.js', array(), $ver, true );

		// AppSumo announcement bar: one small CSS + JS pair on every page. The bar
		// is the primary promo surface, so it is never conditional.
		wp_enqueue_style( 'insightistic-promo-bar', $css . '/promo-bar.css', array( 'insightistic-theme' ), $ver );
		wp_enqueue_script( 'insightistic-promo-bar', $js . '/promo-bar.js', array(), $ver, true );
		if ( is_front_page() ) {
			wp_enqueue_style( 'insightistic-public-overview', $css . '/public-overview.css', array( 'insightistic-marketing-design' ), $ver );
			wp_enqueue_script( 'insightistic-public-overview', $js . '/public-overview.js', array(), $ver, true );
		}
		// Pricing comparison assets belong to the dedicated pricing page.
		if ( is_page_template( 'page-templates/template-pricing.php' ) || is_page( 'pricing' ) ) {
			wp_enqueue_script( 'insightistic-pricing-toggle', $js . '/pricing-toggle.js', array(), $ver, true );
			wp_enqueue_style( 'insightistic-pricing-layout', $css . '/pricing-layout.css', array( 'insightistic-responsive' ), $ver );
		}

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
);

/**
 * Add `defer` to our front-end scripts (they don't block first paint).
 */
add_filter(
	'script_loader_tag',
	function ( $tag, $handle ) {
		if ( in_array( $handle, array( 'insightistic-theme', 'insightistic-pricing-toggle', 'insightistic-promo-bar', 'insightistic-public-overview' ), true ) ) {
			// The navigation and pricing controls must be interactive on the first
			// tap. Airlift's delayed-JS loader and Cloudflare Rocket Loader can
			// otherwise process the same tag in sequence and leave it with a
			// non-executable script type. Exclude these small interaction bundles
			// from both optimizers while keeping native deferred execution.
			$optimizer_attributes = '';
			if ( false === strpos( $tag, ' data-cfasync=' ) ) {
				$optimizer_attributes .= ' data-cfasync="false"';
			}
			if ( false === strpos( $tag, ' bv-exclude=' ) ) {
				$optimizer_attributes .= ' bv-exclude="true"';
			}
			if ( '' !== $optimizer_attributes ) {
				$tag = str_replace( '<script ', '<script' . $optimizer_attributes . ' ', $tag );
			}
			if ( false === strpos( $tag, ' defer' ) ) {
				$tag = str_replace( ' src', ' defer src', $tag );
			}
		}
		return $tag;
	},
	10,
	2
);

/**
 * Flip the `no-js` body/html class to `js` as early as possible so CSS can
 * progressively enhance (mobile menu, accordions) without layout shift.
 */
add_action(
	'wp_head',
	function () {
		echo "<script data-cfasync=\"false\" bv-exclude=\"true\">document.documentElement.classList.remove('no-js');document.documentElement.classList.add('js');</script>\n";
	},
	0
);
