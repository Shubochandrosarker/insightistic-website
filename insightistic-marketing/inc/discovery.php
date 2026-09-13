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

function insightistic_register_discovery_routes() {
	add_rewrite_rule( '^sitemap\.xml$', 'index.php?insightistic_discovery=sitemap', 'top' );
	add_rewrite_rule( '^sitemap-(pages|posts|taxonomies)\.xml$', 'index.php?insightistic_discovery=$matches[1]', 'top' );
	add_rewrite_rule( '^llms\.txt$', 'index.php?insightistic_discovery=llms', 'top' );
	add_rewrite_rule( '^llms-full\.txt$', 'index.php?insightistic_discovery=llms-full', 'top' );
}
add_action( 'init', 'insightistic_register_discovery_routes', 20 );

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
		flush_rewrite_rules();
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

function insightistic_discovery_emit_xml_header() {
	nocache_headers();
	header( 'Content-Type: application/xml; charset=' . get_bloginfo( 'charset' ) );
	echo '<?xml version="1.0" encoding="' . esc_attr( get_bloginfo( 'charset' ) ) . '"?>';
}

function insightistic_discovery_emit_url( $url, $modified = '' ) {
	echo '<url><loc>' . esc_url( $url ) . '</loc>';
	if ( $modified ) {
		echo '<lastmod>' . esc_html( gmdate( 'c', is_numeric( $modified ) ? (int) $modified : strtotime( $modified ) ) ) . '</lastmod>';
	}
	echo '</url>';
}

function insightistic_emit_sitemap_index() {
	insightistic_discovery_emit_xml_header();
	echo '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
	foreach ( array( 'pages', 'posts', 'taxonomies' ) as $type ) {
		echo '<sitemap><loc>' . esc_url( insightistic_discovery_url( 'sitemap-' . $type . '.xml' ) ) . '</loc></sitemap>';
	}
	echo '</sitemapindex>';
}

function insightistic_emit_pages_sitemap() {
	insightistic_discovery_emit_xml_header();
	echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
	insightistic_discovery_emit_url( home_url( '/' ) );
	foreach ( insightistic_discovery_public_pages() as $page ) {
		insightistic_discovery_emit_url( get_permalink( $page ), get_post_modified_time( 'c', true, $page ) );
	}
	foreach ( array( 'knowledgebase', 'ecosystem', 'sitemap' ) as $slug ) {
		$url = get_page_by_path( $slug );
		if ( $url && 'publish' === $url->post_status ) {
			insightistic_discovery_emit_url( get_permalink( $url ), get_post_modified_time( 'c', true, $url ) );
		}
	}
	echo '</urlset>';
}

function insightistic_emit_posts_sitemap() {
	insightistic_discovery_emit_xml_header();
	echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
	$posts = get_posts( array( 'post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 500, 'orderby' => 'modified', 'order' => 'DESC' ) );
	foreach ( $posts as $post ) {
		insightistic_discovery_emit_url( get_permalink( $post ), get_post_modified_time( 'c', true, $post ) );
	}
	echo '</urlset>';
}

function insightistic_emit_taxonomies_sitemap() {
	insightistic_discovery_emit_xml_header();
	echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
	foreach ( array( 'category', 'post_tag' ) as $taxonomy ) {
		foreach ( get_terms( array( 'taxonomy' => $taxonomy, 'hide_empty' => true ) ) as $term ) {
			if ( ! is_wp_error( $term ) ) {
				insightistic_discovery_emit_url( get_term_link( $term ), '' );
			}
		}
	}
	echo '</urlset>';
}

function insightistic_discovery_site_summary() {
	return 'Insightistic is an AI business analytics platform for WordPress and WooCommerce businesses. It brings revenue, orders, products, customers, traffic, SEO, performance, reports and explainable AI insights into one workspace. Insightistic is a product of WordPressistic LLC.';
}

function insightistic_emit_llms( $full = false ) {
	nocache_headers();
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
	);
	foreach ( $routes as $label => $url ) {
		echo "- {$label}: {$url}\n";
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
			'Disallow: /wp-login.php',
			'Disallow: /?s=',
			'Disallow: /*?s=',
			'Sitemap: ' . insightistic_discovery_url( 'sitemap.xml' ),
		);
		return implode( "\n", $lines ) . "\n";
	},
	10,
	2
);
