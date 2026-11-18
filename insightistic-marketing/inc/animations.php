<?php
/**
 * Public-safe product animation helpers.
 *
 * The supplied motion package was built from customer-connected screenshots.
 * The public theme only references the anonymized demo scenes and sanitized
 * media copied into assets/animations.
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Read the allowlisted animation catalog once per request.
 *
 * @return array<string,array<string,mixed>>
 */
function insightistic_animation_manifest() {
	static $catalog = null;

	if ( null !== $catalog ) {
		return $catalog;
	}

	$catalog = array();
	$file    = INSIGHTISTIC_DIR . '/assets/animations/manifest.json';
	$json    = is_readable( $file ) ? file_get_contents( $file ) : '';
	$data    = json_decode( (string) $json, true );

	if ( ! is_array( $data ) || empty( $data['scenes'] ) ) {
		return $catalog;
	}

	foreach ( (array) $data['scenes'] as $scene ) {
		$id   = isset( $scene['id'] ) ? sanitize_key( (string) $scene['id'] ) : '';
		$file = isset( $scene['file'] ) ? basename( (string) $scene['file'] ) : '';
		if ( '' === $id || '' === $file || ! preg_match( '/^\d{2}-[a-z0-9-]+\.html$/', $file ) ) {
			continue;
		}
		$scene['id']   = $id;
		$scene['file'] = $file;
		$catalog[ $id ] = $scene;
	}

	return $catalog;
}

/**
 * Return the public scene record for a stable, human-readable slug.
 *
 * @param string $slug Public scene slug.
 * @return array<string,mixed>
 */
function insightistic_animation_scene_by_slug( $slug ) {
	$slug    = sanitize_title( (string) $slug );
	$catalog = insightistic_animation_manifest();

	foreach ( $catalog as $scene ) {
		if ( $slug === sanitize_title( (string) ( $scene['slug'] ?? '' ) ) ) {
			return $scene;
		}
	}

	return array();
}

/**
 * Build the clean public URL used by embeds and marketing links.
 *
 * @param array<string,mixed> $scene Scene record from the manifest.
 * @return string
 */
function insightistic_animation_scene_url( $scene ) {
	$slug = sanitize_title( (string) ( $scene['slug'] ?? '' ) );

	if ( '' === $slug ) {
		return home_url( '/product-tour/' );
	}

	return home_url( user_trailingslashit( 'product-tour/' . $slug ) );
}

/** Register clean scene and supporting-asset routes. */
function insightistic_register_animation_routes() {
	add_rewrite_rule(
		'^product-tour/([a-z0-9-]+)/?$',
		'index.php?insightistic_animation=$matches[1]',
		'top'
	);
	add_rewrite_rule(
		'^product-tour/assets/(motion\.(?:css|js))$',
		'index.php?insightistic_animation_asset=$matches[1]',
		'top'
	);
	add_rewrite_rule(
		'^product-tour/assets/demo/(overview|seo|audit|runs|agents|performance|traffic)\.svg$',
		'index.php?insightistic_animation_asset=demo/$matches[1].svg',
		'top'
	);
}
add_action( 'init', 'insightistic_register_animation_routes', 20 );

add_filter(
	'query_vars',
	function ( $vars ) {
		$vars[] = 'insightistic_animation';
		$vars[] = 'insightistic_animation_asset';
		return $vars;
	}
);

/**
 * Send a packaged animation asset without exposing the theme directory.
 *
 * @param string $relative Relative path inside the allowlisted animation folder.
 * @return void
 */
function insightistic_send_animation_asset( $relative ) {
	$relative = ltrim( str_replace( '\\', '/', (string) $relative ), '/' );
	$allowed  = array(
		'motion.css' => array( 'file' => INSIGHTISTIC_DIR . '/assets/animations/motion.css', 'type' => 'text/css; charset=UTF-8' ),
		'motion.js'  => array( 'file' => INSIGHTISTIC_DIR . '/assets/animations/motion.js', 'type' => 'application/javascript; charset=UTF-8' ),
	);

	if ( preg_match( '/^demo\/(overview|seo|audit|runs|agents|performance|traffic)\.svg$/', $relative, $matches ) ) {
		$allowed[ $relative ] = array(
			'file' => INSIGHTISTIC_DIR . '/assets/animations/demo/' . $matches[1] . '.svg',
			'type' => 'image/svg+xml',
		);
	}

	if ( empty( $allowed[ $relative ]['file'] ) || ! is_readable( $allowed[ $relative ]['file'] ) ) {
		return;
	}

	status_header( 200 );
	header( 'Content-Type: ' . $allowed[ $relative ]['type'] );
	header( 'Cache-Control: public, max-age=31536000, immutable' );
	header( 'X-Content-Type-Options: nosniff' );
	readfile( $allowed[ $relative ]['file'] );
	exit;
}

/** Serve clean scene documents and supporting assets. */
function insightistic_animation_template_redirect() {
	$asset = get_query_var( 'insightistic_animation_asset' );
	if ( $asset ) {
		insightistic_send_animation_asset( $asset );
	}

	$slug = get_query_var( 'insightistic_animation' );
	if ( ! $slug ) {
		return;
	}

	$scene = insightistic_animation_scene_by_slug( $slug );
	if ( empty( $scene['file'] ) ) {
		status_header( 404 );
		return;
	}

	$file = INSIGHTISTIC_DIR . '/assets/animations/scenes/' . basename( (string) $scene['file'] );
	$html = is_readable( $file ) ? file_get_contents( $file ) : false;
	if ( false === $html ) {
		status_header( 404 );
		return;
	}

	$asset_base = trailingslashit( home_url( '/product-tour/assets' ) );
	$html       = str_replace(
		array( '../motion.css', '../motion.js', '../demo/' ),
		array( $asset_base . 'motion.css', $asset_base . 'motion.js', $asset_base . 'demo/' ),
		$html
	);

	// Scenes are illustrative embeds, not standalone ranking pages. Keep their
	// content crawlable through the parent product-tour page without creating
	// duplicate thin URLs in the index.
	$robots    = '<meta name="robots" content="noindex,follow">';
	$canonical = '<link rel="canonical" href="' . esc_url( home_url( '/product-tour/' ) ) . '">';
	$html      = preg_replace( '/<head>/i', '<head>' . $robots . $canonical, $html, 1 );

	status_header( 200 );
	header( 'Content-Type: text/html; charset=' . get_bloginfo( 'charset' ) );
	header( 'X-Robots-Tag: noindex, follow' );
	header( 'Cache-Control: public, max-age=86400, s-maxage=86400' );
	header( 'X-Content-Type-Options: nosniff' );
	echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- allowlisted packaged HTML scene.
	exit;
}
add_action( 'template_redirect', 'insightistic_animation_template_redirect', 1 );

/**
 * Render one product animation using the safe interactive HTML scene.
 *
 * @param string               $id   Two-digit manifest ID.
 * @param array<string,mixed>  $args Rendering overrides.
 * @return string
 */
function insightistic_animation_visual( $id, $args = array() ) {
	$catalog = insightistic_animation_manifest();
	$key     = str_pad( (string) absint( $id ), 2, '0', STR_PAD_LEFT );

	if ( empty( $catalog[ $key ] ) ) {
		return '';
	}

	$scene      = $catalog[ $key ];
	$screen     = isset( $scene['screen'] ) ? sanitize_key( (string) $scene['screen'] ) : 'overview';
	$screen_map = array( 'overview', 'seo', 'audit', 'runs', 'agents', 'performance', 'traffic' );
	if ( ! in_array( $screen, $screen_map, true ) ) {
		$screen = 'overview';
	}

	$title       = isset( $args['title'] ) ? (string) $args['title'] : (string) ( $scene['title'] ?? '' );
	$description = isset( $args['description'] ) ? (string) $args['description'] : (string) ( $scene['subtitle'] ?? '' );
	$classes     = isset( $args['class'] ) ? (string) $args['class'] : '';
	$video       = ! empty( $args['video'] );
	$scene_url   = insightistic_animation_scene_url( $scene );
	$poster_url  = INSIGHTISTIC_URI . '/assets/animations/demo/' . $screen . '.svg';
	$video_url   = INSIGHTISTIC_URI . '/assets/animations/videos/' . sanitize_file_name( $scene['file'] ) . '.mp4';
	$video_url   = str_replace( '.html.mp4', '.mp4', $video_url );

	$figure_classes = 'ins-animation ins-animation--' . ( $video ? 'video' : 'scene' );
	if ( $classes ) {
		$figure_classes .= ' ' . $classes;
	}

	$output  = '<figure class="' . esc_attr( $figure_classes ) . '" data-animation-id="' . esc_attr( $key ) . '">';
	$output .= '<div class="ins-animation__frame">';

	if ( $video ) {
		$output .= '<video class="ins-animation__video" muted playsinline loop preload="none" poster="' . esc_url( $poster_url ) . '" data-motion-video aria-label="' . esc_attr( $title ) . '">';
		$output .= '<source data-src="' . esc_url( $video_url ) . '" type="video/mp4">';
		$output .= '</video>';
		$output .= '<noscript><img src="' . esc_url( $poster_url ) . '" alt="' . esc_attr( $title ) . ' — illustrative demo" loading="lazy" decoding="async"></noscript>';
	} else {
		$output .= '<iframe src="' . esc_url( $scene_url ) . '" title="' . esc_attr( $title ) . ' — interactive illustrative demo" loading="lazy" allow="autoplay" referrerpolicy="no-referrer"></iframe>';
	}

	$output .= '</div>';
	$output .= '<figcaption class="ins-animation__caption">';
	$output .= '<span><strong>' . esc_html( $title ) . '</strong><span>' . esc_html( $description ) . '</span></span>';
	$output .= '<a href="' . esc_url( $scene_url ) . '" target="_blank" rel="noopener">' . esc_html__( 'Open interactive view', 'insightistic-marketing' ) . ' <span aria-hidden="true">↗</span></a>';
	$output .= '</figcaption>';
	$output .= '</figure>';

	return $output;
}

