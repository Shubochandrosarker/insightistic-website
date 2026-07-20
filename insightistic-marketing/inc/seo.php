<?php
/**
 * Canonical URL + Open Graph / Twitter Card meta tags.
 *
 * The theme defers meta *titles and descriptions* to a dedicated SEO plugin
 * by design (see README) — but if no SEO plugin is active, nothing else was
 * emitting a canonical link or social-preview tags at all, so search engines
 * saw no canonical signal and shares to Slack/X/LinkedIn/etc. rendered with
 * no title, description or image. This fills that gap, and gets out of the
 * way entirely the moment a real SEO plugin (which does all of this more
 * thoroughly) is active.
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Is a full-featured SEO plugin already handling this? */
function insightistic_seo_plugin_active() {
	return defined( 'WPSEO_VERSION' )
		|| defined( 'RANK_MATH_VERSION' )
		|| class_exists( 'All_in_One_SEO_Pack' )
		|| class_exists( 'SEOPress' );
}

/**
 * Best-effort page description: explicit excerpt, otherwise the site
 * tagline. Never fabricated — an empty string is fine and simply omits
 * the tag.
 */
function insightistic_seo_description() {
	if ( is_singular() && has_excerpt() ) {
		return wp_strip_all_tags( get_the_excerpt() );
	}
	if ( is_front_page() || is_home() ) {
		return wp_strip_all_tags( get_bloginfo( 'description' ) );
	}
	return '';
}

function insightistic_seo_canonical_url() {
	if ( is_singular() ) {
		return get_permalink();
	}
	global $wp;
	return home_url( add_query_arg( array(), $wp->request ) );
}

/**
 * Emits <link rel="canonical"> and Open Graph / Twitter Card tags. No-ops
 * entirely when a recognized SEO plugin is active.
 */
function insightistic_output_seo_meta() {
	if ( insightistic_seo_plugin_active() ) {
		return;
	}

	$title = wp_get_document_title();
	$desc  = insightistic_seo_description();
	$url   = insightistic_seo_canonical_url();

	printf( '<link rel="canonical" href="%s">' . "\n", esc_url( $url ) );

	printf( '<meta property="og:type" content="%s">' . "\n", is_singular( 'post' ) ? 'article' : 'website' );
	printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( get_bloginfo( 'name' ) ) );
	printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $title ) );
	printf( '<meta property="og:url" content="%s">' . "\n", esc_url( $url ) );
	if ( $desc ) {
		printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $desc ) );
	}
	if ( is_singular() && has_post_thumbnail() ) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
		if ( $image ) {
			printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $image[0] ) );
		}
	}

	printf( '<meta name="twitter:card" content="%s">' . "\n", ( is_singular() && has_post_thumbnail() ) ? 'summary_large_image' : 'summary' );
	printf( '<meta name="twitter:title" content="%s">' . "\n", esc_attr( $title ) );
	if ( $desc ) {
		printf( '<meta name="twitter:description" content="%s">' . "\n", esc_attr( $desc ) );
	}
}
add_action( 'wp_head', 'insightistic_output_seo_meta', 1 );

/**
 * Preconnect to the app/API origins every page links out to or (on the
 * pricing page) fetches from — shaves the DNS+TLS round trip off the first
 * cross-origin request instead of paying it lazily on click/fetch.
 */
function insightistic_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' !== $relation_type ) {
		return $urls;
	}

	foreach ( array( insightistic_app_base(), insightistic_api_url() ) as $origin ) {
		$host = wp_parse_url( $origin, PHP_URL_HOST );
		if ( $host ) {
			$urls[] = array(
				'href'        => 'https://' . $host,
				'crossorigin' => '',
			);
		}
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'insightistic_resource_hints', 10, 2 );
