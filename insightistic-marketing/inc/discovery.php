<?php
/**
 * Search- and agent-friendly discovery surfaces.
 *
 * Endpoints are generated from current WordPress content, so sitemap and
 * llms files stay current when an editor publishes or updates a page/post.
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'INSIGHTISTIC_DISCOVERY_REWRITE_VERSION', '3' );

function insightistic_register_discovery_routes() {
	add_rewrite_rule( '^sitemap\.xml$', 'index.php?insightistic_discovery=sitemap', 'top' );
	add_rewrite_rule( '^sitemap-(pages|posts|taxonomies|deal)\.xml$', 'index.php?insightistic_discovery=$matches[1]', 'top' );
	add_rewrite_rule( '^llms\.txt$', 'index.php?insightistic_discovery=llms', 'top' );
	add_rewrite_rule( '^llms-full\.txt$', 'index.php?insightistic_discovery=llms-full', 'top' );
}
add_action( 'init', 'insightistic_register_discovery_routes', 20 );

/**
 * Flush once after deployment as well as after a theme switch.
 * Theme files can be updated without activating the theme, so relying only on
 * after_switch_theme leaves new public routes returning a WordPress 404.
 */
function insightistic_maybe_flush_discovery_rewrites() {
	if ( INSIGHTISTIC_DISCOVERY_REWRITE_VERSION === get_option( 'insightistic_discovery_rewrite_version' ) ) {
		return;
	}

	flush_rewrite_rules( false );
	update_option( 'insightistic_discovery_rewrite_version', INSIGHTISTIC_DISCOVERY_REWRITE_VERSION, false );
}
add_action( 'init', 'insightistic_maybe_flush_discovery_rewrites', 99 );

add_filter(
	'query_vars',
	function ( $vars ) {
		$vars[] = 'insightistic_discovery';
		return $vars;
	}
);

add_action(
	'after_switch_theme',
	function () {
		insightistic_register_discovery_routes();
		flush_rewrite_rules( false );
		update_option( 'insightistic_discovery_rewrite_version', INSIGHTISTIC_DISCOVERY_REWRITE_VERSION, false );
	}
);

/** Safe XML text escaping across supported WordPress versions. */
function insightistic_xml_text( $value ) {
	$value = wp_strip_all_tags( (string) $value );
	return function_exists( 'esc_xml' ) ? esc_xml( $value ) : esc_html( $value );
}

function insightistic_discovery_url( $path = '' ) {
	return home_url( '/' . ltrim( $path, '/' ) );
}

function insightistic_discovery_public_pages() {
	return get_pages(
		array(
			'post_status' => 'publish',
			'sort_column' => 'menu_order,post_title',
			'exclude'     => get_option( 'page_for_posts' ),
		)
	);
}

/**
 * Campaign landing pages served from deal.insightistic.com (the ChatGPT-built
 * deal site behind the custom domain). They are external hosts, so they live
 * in their own sitemap child and are announced through robots.txt and the
 * HTML sitemap; both hosts must stay verified in Search Console.
 *
 * @return array<array{url:string, label:string, lastmod:string}>
 */
function insightistic_discovery_deal_urls() {
	$today = gmdate( 'Y-m-d' );
	$urls  = array(
		array(
			'url'     => 'https://deal.insightistic.com/',
			'label'   => 'Insightistic deal overview',
			'lastmod' => $today,
		),
		array(
			'url'     => 'https://deal.insightistic.com/explore-agent-jolley/',
			'label'   => 'Explore Agent JOLLEY',
			'lastmod' => $today,
		),
		array(
			'url'     => 'https://deal.insightistic.com/ltd/',
			'label'   => 'Insightistic lifetime deal tiers',
			'lastmod' => $today,
		),
	);
	return apply_filters( 'insightistic_deal_sitemap_urls', $urls );
}

function insightistic_discovery_emit_xml_header() {
	status_header( 200 );
	header( 'Cache-Control: public, max-age=300, s-maxage=300' );
	header( 'Content-Type: application/xml; charset=' . get_bloginfo( 'charset' ) );
	echo '<?xml version="1.0" encoding="' . esc_attr( get_bloginfo( 'charset' ) ) . '"?>';
}

function insightistic_discovery_emit_url( $url, $modified = '' ) {
	if ( ! $url || is_wp_error( $url ) ) {
		return;
	}

	echo '<url><loc>' . insightistic_xml_text( $url ) . '</loc>';
	if ( $modified ) {
		$timestamp = is_numeric( $modified ) ? (int) $modified : strtotime( $modified );
		if ( $timestamp ) {
			echo '<lastmod>' . insightistic_xml_text( gmdate( 'c', $timestamp ) ) . '</lastmod>';
		}
	}
	echo '</url>';
}

function insightistic_emit_sitemap_index() {
	insightistic_discovery_emit_xml_header();
	echo '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
	foreach ( array( 'pages', 'posts', 'taxonomies', 'deal' ) as $type ) {
		echo '<sitemap><loc>' . insightistic_xml_text( insightistic_discovery_url( 'sitemap-' . $type . '.xml' ) ) . '</loc></sitemap>';
	}
	echo '</sitemapindex>';
}

function insightistic_emit_deal_sitemap() {
	insightistic_discovery_emit_xml_header();
	echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
	foreach ( insightistic_discovery_deal_urls() as $entry ) {
		insightistic_discovery_emit_url( $entry['url'], $entry['lastmod'] );
	}
	echo '</urlset>';
}

function insightistic_emit_pages_sitemap() {
	insightistic_discovery_emit_xml_header();
	echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
	insightistic_discovery_emit_url( home_url( '/' ) );
	foreach ( insightistic_discovery_public_pages() as $page ) {
		insightistic_discovery_emit_url( get_permalink( $page ), get_post_modified_time( 'c', true, $page ) );
	}
	echo '</urlset>';
}

function insightistic_emit_posts_sitemap() {
	insightistic_discovery_emit_xml_header();
	echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
	$posts = get_posts( array( 'post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 500, 'orderby' => 'modified', 'order' => 'DESC', 'no_found_rows' => true ) );
	foreach ( $posts as $post ) {
		insightistic_discovery_emit_url( get_permalink( $post ), get_post_modified_time( 'c', true, $post ) );
	}
	echo '</urlset>';
}

function insightistic_emit_taxonomies_sitemap() {
	insightistic_discovery_emit_xml_header();
	echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
	$taxonomies = get_taxonomies( array( 'public' => true ), 'objects' );
	foreach ( $taxonomies as $taxonomy ) {
		if ( empty( $taxonomy->rewrite ) ) {
			continue;
		}
		$terms = get_terms( array( 'taxonomy' => $taxonomy->name, 'hide_empty' => true ) );
		if ( is_wp_error( $terms ) ) {
			continue;
		}
		foreach ( $terms as $term ) {
			if ( ! is_wp_error( $term ) ) {
				insightistic_discovery_emit_url( get_term_link( $term ), '' );
			}
		}
	}
	echo '</urlset>';
}

function insightistic_discovery_site_summary() {
	return 'Insightistic is an AI business intelligence platform for WordPress and WooCommerce businesses. It brings commerce analytics, traffic, SEO, performance, reports, agency workflows and explainable AI insights into one workspace. Insightistic is a product of WordPressistic LLC.';
}

function insightistic_emit_llms( $full = false ) {
	status_header( 200 );
	header( 'Cache-Control: public, max-age=300, s-maxage=300' );
	header( 'X-Robots-Tag: noindex, nofollow' );
	header( 'Content-Type: text/plain; charset=' . get_bloginfo( 'charset' ) );
	$details = insightistic_business_details();
	$author  = insightistic_editorial_author();

	echo "# Insightistic\n\n";
	echo insightistic_discovery_site_summary() . "\n\n";
	echo "## Canonical information\n\n";
	echo "- Canonical website: " . home_url( '/' ) . "\n";
	echo "- Product app: " . insightistic_app_base() . "\n";
	echo "- Public API origin: " . insightistic_api_url() . "\n";
	echo "- Operator: {$details['legal_name']}\n";
	echo "- Editorial contact: {$details['email']}\n";
	echo "- Editorial owner: {$author['name']}, {$author['title']}\n\n";

	echo "## Product areas\n\n";
	foreach ( insightistic_knowledgebase_topics() as $topic ) {
		echo '- [' . $topic['title'] . '](' . $topic['url'] . '): ' . $topic['description'] . "\n";
	}

	$catalog = insightistic_public_catalog();
	echo "\n## Current commercial reference\n\n";
	echo '- Free Connected: $0, one connected site, 10 basic AI insights per month and 1,000 monthly AI credits.' . "\n";
	foreach ( (array) ( $catalog['plans'] ?? array() ) as $plan ) {
		echo '- ' . $plan['name'] . ': ' . $plan['monthly'] . '/month or ' . $plan['yearly'] . ' billed annually; ' . (int) $plan['limits']['sites'] . ' site(s), ' . (int) $plan['limits']['team_seats'] . ' team seat(s), and ' . number_format_i18n( (int) $plan['limits']['ai_credits'] ) . ' monthly AI credits.' . "\n";
	}
	echo '- Insight Credit packs: 5,000 for $15, 20,000 for $49, and 50,000 for $99.' . "\n";
	echo '- Founding Angel: three one-time tiers are documented on the lifetime page; availability is confirmed by the application campaign state, not by this file.' . "\n";

	echo "\n## Primary routes\n\n";
	$routes = array(
		'Features'      => home_url( '/features/' ),
		'Pricing'       => home_url( '/pricing/' ),
		'Integrations'  => home_url( '/integrations/' ),
		'Knowledgebase' => home_url( '/knowledgebase/' ),
		'Blog'          => home_url( '/blog/' ),
		'About'         => home_url( '/about/' ),
		'Security'      => home_url( '/security/' ),
		'Contact'       => home_url( '/contact/' ),
		'Sitemap'       => insightistic_discovery_url( 'sitemap.xml' ),
		'Pages sitemap' => insightistic_discovery_url( 'sitemap-pages.xml' ),
		'Posts sitemap' => insightistic_discovery_url( 'sitemap-posts.xml' ),
		'Taxonomy sitemap' => insightistic_discovery_url( 'sitemap-taxonomies.xml' ),
		'Deal sitemap' => insightistic_discovery_url( 'sitemap-deal.xml' ),
		'Full machine-readable overview' => insightistic_discovery_url( 'llms-full.txt' ),
	);
	foreach ( $routes as $label => $url ) {
		echo "- {$label}: {$url}\n";
	}

	echo "\n## Deal campaign pages\n\n";
	foreach ( insightistic_discovery_deal_urls() as $entry ) {
		echo '- ' . $entry['label'] . ': ' . $entry['url'] . "\n";
	}

	if ( $full ) {
		echo "\n## Current public pages\n\n";
		foreach ( insightistic_discovery_public_pages() as $page ) {
			echo '- ' . get_the_title( $page ) . ': ' . get_permalink( $page ) . "\n";
			$excerpt = has_excerpt( $page ) ? get_the_excerpt( $page ) : wp_trim_words( $page->post_content, 55 );
			if ( $excerpt ) {
				echo '  Summary: ' . wp_strip_all_tags( $excerpt ) . "\n";
			}
		}

		echo "\n## Recent editorial content\n\n";
		foreach ( get_posts( array( 'post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 50, 'orderby' => 'modified', 'order' => 'DESC' ) ) as $post ) {
			echo '- ' . get_the_title( $post ) . ': ' . get_permalink( $post ) . "\n";
			echo '  Updated: ' . get_post_modified_time( 'Y-m-d', true, $post ) . "\n";
		}

		echo "\n## Legal and trust\n\n";
		echo '- Privacy: ' . home_url( '/privacy-policy/' ) . "\n";
		echo '- Terms: ' . home_url( '/terms/' ) . "\n";
		echo '- Data processing: ' . home_url( '/data-processing/' ) . "\n";
		echo '- Security: ' . home_url( '/security/' ) . "\n";
		echo '- Acceptable use: ' . home_url( '/acceptable-use/' ) . "\n";
		echo '- Subprocessors: ' . home_url( '/subprocessors/' ) . "\n";
		echo '- Cookie Policy: ' . home_url( '/cookies/' ) . "\n";
		echo '- Accessibility: ' . home_url( '/accessibility/' ) . "\n";
		echo '- Refunds and cancellation: ' . home_url( '/refunds/' ) . "\n";
		echo '- Legal notices: ' . home_url( '/legal-notices/' ) . "\n";
	}
}

function insightistic_discovery_template_redirect() {
	$endpoint = get_query_var( 'insightistic_discovery' );
	if ( ! $endpoint ) {
		$path      = trim( (string) wp_parse_url( wp_unslash( $_SERVER['REQUEST_URI'] ?? '' ), PHP_URL_PATH ), '/' );
		$home_path = trim( (string) wp_parse_url( home_url( '/' ), PHP_URL_PATH ), '/' );
		if ( $home_path && 0 === strpos( $path, $home_path . '/' ) ) {
			$path = substr( $path, strlen( $home_path ) + 1 );
		}
		$direct_routes = array(
			'sitemap.xml'             => 'sitemap',
			'sitemap-pages.xml'       => 'pages',
			'sitemap-posts.xml'       => 'posts',
			'sitemap-taxonomies.xml' => 'taxonomies',
			'sitemap-deal.xml'       => 'deal',
			'llms.txt'                => 'llms',
			'llms-full.txt'           => 'llms-full',
		);
		if ( isset( $direct_routes[ $path ] ) ) {
			$endpoint = $direct_routes[ $path ];
		}
	}
	if ( ! $endpoint ) {
		return;
	}

	switch ( $endpoint ) {
		case 'sitemap':
			insightistic_emit_sitemap_index();
			break;
		case 'pages':
			insightistic_emit_pages_sitemap();
			break;
		case 'posts':
			insightistic_emit_posts_sitemap();
			break;
		case 'taxonomies':
			insightistic_emit_taxonomies_sitemap();
			break;
		case 'deal':
			insightistic_emit_deal_sitemap();
			break;
		case 'llms':
			insightistic_emit_llms( false );
			break;
		case 'llms-full':
			insightistic_emit_llms( true );
			break;
		default:
			return;
	}
	exit;
}
add_action( 'template_redirect', 'insightistic_discovery_template_redirect', 0 );

/** Keep the standard /robots.txt endpoint aligned with the custom sitemap. */
add_filter(
	'robots_txt',
	function ( $output, $public ) {
		if ( ! $public ) {
			return $output;
		}
		$lines = array(
			'User-agent: *',
			'Allow: /',
			'Disallow: /wp-admin/',
			'Allow: /wp-admin/admin-ajax.php',
			'Disallow: /wp-login.php',
			'Disallow: /wp-json/',
			'Disallow: /xmlrpc.php',
			'Disallow: /wp-content/cache/',
			'Disallow: /?s=',
			'Disallow: /*?s=',
			'Sitemap: ' . insightistic_discovery_url( 'sitemap.xml' ),
			'Sitemap: ' . insightistic_discovery_url( 'sitemap-pages.xml' ),
			'Sitemap: ' . insightistic_discovery_url( 'sitemap-posts.xml' ),
			'Sitemap: ' . insightistic_discovery_url( 'sitemap-taxonomies.xml' ),
			'Sitemap: ' . insightistic_discovery_url( 'sitemap-deal.xml' ),
		);
		return implode( "\n", $lines ) . "\n";
	},
	10,
	2
);
