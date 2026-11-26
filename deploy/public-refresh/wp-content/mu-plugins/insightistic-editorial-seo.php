<?php
/**
 * Plugin Name: Insightistic Editorial SEO
 * Description: Exact legacy article routes, campaign metadata and guide navigation.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Source URLs present in the historical Markdown export. */
function insightistic_editorial_legacy_owners() {
	return array(
		'agency-woocommerce-reporting', 'ai-business-analytics', 'best-woocommerce-analytics-plugin',
		'customer-lifetime-value-woocommerce', 'ecommerce-analytics', 'metorik-alternative',
		'monsterinsights-alternative', 'white-label-analytics-dashboard', 'white-label-woocommerce-reports',
		'white-label-wordpress-analytics', 'woocommerce-analytics-dashboard', 'woocommerce-analytics-free',
		'woocommerce-analytics-guide', 'woocommerce-analytics-plugin', 'woocommerce-analytics-pricing',
		'woocommerce-profit-reports', 'woocommerce-reporting-plugin', 'woocommerce-reports',
		'woocommerce-reports-for-clients', 'woocommerce-sales-reports',
	);
}

/** The old WooCommerce Analytics filename belongs to the commercial hub. */
function insightistic_editorial_legacy_destination( $owner, $target ) {
	$owners = insightistic_editorial_legacy_owners();
	$targets = array_values( array_diff( $owners, array( 'woocommerce-analytics-guide' ) ) );
	$targets[] = 'woocommerce-analytics';
	$excluded = 'woocommerce-analytics-guide' === $owner ? 'woocommerce-analytics' : $owner;
	if ( $excluded === $target || ! in_array( $owner, $owners, true ) || ! in_array( $target, $targets, true ) ) {
		return '';
	}
	return home_url( '/' . $target . '/' );
}

/** Redirect only matched legacy routes. Return a real 404 for unknown aliases in this family. */
function insightistic_editorial_redirect_markdown() {
	if ( ! in_array( $_SERVER['REQUEST_METHOD'] ?? '', array( 'GET', 'HEAD' ), true ) ) {
		return;
	}
	$request = wp_parse_url( wp_unslash( $_SERVER['REQUEST_URI'] ?? '' ) );
	$path = $request['path'] ?? '';
	if ( ! preg_match( '~^/([a-z0-9-]+)/([a-z0-9-]+)\.md/?$~D', $path, $match ) || ! in_array( $match[1], insightistic_editorial_legacy_owners(), true ) ) {
		return;
	}
	$destination = insightistic_editorial_legacy_destination( $match[1], $match[2] );
	if ( $destination ) {
		if ( isset( $request['query'] ) && '' !== $request['query'] ) {
			$destination .= '?' . $request['query'];
		}
		wp_safe_redirect( $destination, 301, 'Insightistic legacy article' );
		exit;
	}

	$GLOBALS['wp_query']->set_404();
	status_header( 404 );
	nocache_headers();
	// Finish the response before any later canonical or edge template hooks can redirect it.
	$template = get_404_template();
	if ( $template ) {
		load_template( $template, false );
		exit;
	}
	wp_die( esc_html__( 'Page not found.', 'insightistic-marketing' ), '', array( 'response' => 404 ) );
}
add_action( 'template_redirect', 'insightistic_editorial_redirect_markdown', -30 );

/** Keep recovered editorial revisions from reintroducing relative Markdown links. */
function insightistic_editorial_rewrite_legacy_html( $content, $owner ) {
	if ( ! str_contains( $content, '.md' ) || ! in_array( $owner, insightistic_editorial_legacy_owners(), true ) ) {
		return $content;
	}
	$links = new WP_HTML_Tag_Processor( $content );
	while ( $links->next_tag( array( 'tag_name' => 'A' ) ) ) {
		$url = $links->get_attribute( 'href' );
		if ( ! is_string( $url ) || ! preg_match( '~^\./([a-z0-9-]+)\.md$~D', $url, $match ) ) {
			continue;
		}
		$destination = insightistic_editorial_legacy_destination( $owner, $match[1] );
		if ( $destination ) {
			$links->set_attribute( 'href', wp_make_link_relative( $destination ) );
		}
	}
	return $links->get_updated_html();
}
add_filter( 'the_content', static function ( $content ) {
	$post = get_post();
	return $post instanceof WP_Post ? insightistic_editorial_rewrite_legacy_html( $content, $post->post_name ) : $content;
}, 19 );

/** Retain thematic category pages. The all-posts category duplicates the blog. */
function insightistic_editorial_category_indexable( $term ) {
	return $term instanceof WP_Term && 'category' === $term->taxonomy && in_array(
		$term->slug, array( 'analytics', 'ai-insights', 'product-updates', 'seo', 'woocommerce' ), true
	);
}

/** Keep every browseable archive page on its own canonical URL. */
function insightistic_editorial_archive_canonical( $default ) {
	if ( is_home() ) {
		$blog_id = (int) get_option( 'page_for_posts' );
		$base = $blog_id ? get_permalink( $blog_id ) : home_url( '/blog/' );
	} elseif ( is_category() || is_tag() || is_tax() ) {
		$base = get_term_link( get_queried_object() );
	} else {
		return $default;
	}
	if ( ! is_string( $base ) || '' === $base ) {
		return $default;
	}
	$page = (int) get_query_var( 'paged' );
	return $page > 1 ? trailingslashit( $base ) . user_trailingslashit( $GLOBALS['wp_rewrite']->pagination_base . '/' . $page, 'paged' ) : $base;
}

function insightistic_editorial_robots( $default ) {
	if ( is_category() || is_tag() || is_tax() ) {
		return ! is_paged() && insightistic_editorial_category_indexable( get_queried_object() ) ? 'index, follow' : 'noindex, follow';
	}
	return $default;
}

/** Commercial intent and campaign article metadata use the same head owner. */
function insightistic_editorial_metadata() {
	if ( is_404() || is_search() || is_preview() ) {
		return array();
	}
	if ( is_home() && is_paged() ) {
		$page = (int) get_query_var( 'paged' );
		return array(
			sprintf( 'Insightistic Blog | Page %d', $page ),
			sprintf( 'Page %d of Insightistic articles about WooCommerce reports, WordPress analytics, search, site health and product updates.', $page ),
		);
	}
	$slug = is_front_page() ? 'home' : ( is_home() && ! is_paged() ? 'blog' : ( get_queried_object()->post_name ?? '' ) );
	$metadata = array(
		'home' => array( 'WordPress & WooCommerce Analytics | Insightistic', 'Track WordPress search visibility, site health, and WooCommerce performance. Agent JOLLEY shows what changed, the evidence, and what to check next.' ),
		'pricing' => array( 'Insightistic Pricing | Compare WordPress Analytics Plans', 'Compare Insightistic’s Free Connected plan and paid subscriptions by site count, Insight Credits, reporting and team access. Find the plan for your workspace.' ),
		'ltd' => array( 'Insightistic Lifetime Deal on AppSumo | Compare Tiers', 'Compare all five Insightistic AppSumo lifetime tiers by website projects, Insight Credits, reporting and team limits. Check current availability on AppSumo.' ),
		'agency' => array( 'Agency Analytics & Client Reporting | Insightistic', 'Manage WooCommerce and WordPress client sites from one Insightistic workspace. Review store and search data, check site health and compare branded reporting plans.' ),
		'insightistic-ai-business-intelligence' => array( 'Insightistic on AppSumo | AI Business Analytics', 'Explore how Insightistic connects WooCommerce analytics, SEO, site audits and Agent JOLLEY. Compare the five lifetime tiers and check today’s offer on AppSumo.' ),
		'insightistic-appsumo-lifetime-deal' => array( 'Insightistic Launches on AppSumo | Lifetime Deal', 'Read why Insightistic launched on AppSumo, what the software connects and how to compare the current lifetime tiers for WooCommerce stores and agency teams.' ),
		'giveaway' => array( 'Insightistic Giveaway | Entry & Official Rules', 'Find the official KingSumo entry and rules for the Insightistic giveaway. Check the entry deadline, eligibility requirements and prize details before entering.' ),
		'features' => array( 'WordPress & WooCommerce Analytics Features | Insightistic', 'Explore Insightistic features for WooCommerce sales, traffic, search visibility, audits, uptime, AI insights and client reports. See the workflows and plans.' ),
		'woocommerce-analytics' => array( 'WooCommerce Revenue & Order Analytics | Insightistic', 'Track WooCommerce net sales, orders, average order value, returns, products and returning customers. See an example scorecard and compare Insightistic plans.' ),
		'seo-analytics' => array( 'Search Console Analytics for WordPress | Insightistic', 'Review Google Search Console clicks, impressions and landing pages alongside store outcomes. Follow a practical WooCommerce search analysis workflow.' ),
		'traffic-analytics' => array( 'WordPress Traffic Analytics & GA4 | Insightistic', 'Compare traffic channels, landing pages and visitor engagement for WordPress. See how to read GA4 measurements alongside WooCommerce order and revenue data.' ),
		'ai-insights' => array( 'AI Analytics for WordPress with Agent JOLLEY | Insightistic', 'Ask Agent JOLLEY to explain changes in your connected WordPress and WooCommerce data. See a practical example and learn how to check the evidence behind it.' ),
		'integrations' => array( 'WordPress, WooCommerce & GA4 Integrations | Insightistic', 'Find the sources Insightistic can connect, what each connection syncs and the setup steps for WordPress, WooCommerce, GA4 and Google Search Console.' ),
		'reports' => array( 'White-Label Analytics Reports for Agencies | Insightistic', 'See a client-ready WooCommerce report and compare Insightistic’s scheduled delivery, PDF and HTML options, and report branding across eligible plans.' ),
		'performance-monitoring' => array( 'WordPress Core Web Vitals Monitoring | Insightistic', 'Review PageSpeed, Core Web Vitals and uptime for WordPress and WooCommerce. Use the performance checklist to diagnose slow product pages, cart and checkout.' ),
		'woocommerce-analytics-dashboard' => array( 'WooCommerce Analytics Dashboard | 7 Monday Metrics', 'Use a seven-metric WooCommerce dashboard to review sales, orders, basket size, returns, products, repeat orders and checkout. Copy the illustrative scorecard.' ),
		'ga4-vs-woocommerce-analytics' => array( 'WooCommerce vs GA4 and Stripe | Reconcile Revenue', 'Compare WooCommerce sales, GA4 purchases and Stripe payouts with a five-order example. Diagnose missing purchases and match refunds, fees and settlement dates.' ),
		'metorik-alternative' => array( 'Metorik Alternative for WooCommerce | Reporting Tests', 'Compare native WooCommerce, Metorik and Insightistic across reports, customer segments and client delivery. Run three workflow tests before switching.' ),
		'agency-analytics-reporting-workflow' => array( 'WooCommerce Agency Reporting | Client Report Workflow', 'Build a client-ready WooCommerce report with one page of findings, source evidence, owners and due dates. Copy the sample and test Agent JOLLEY’s explanation.' ),
	);
	return $metadata[ $slug ] ?? array();
}

function insightistic_editorial_campaign_credit() {
	return is_single() && in_array( get_queried_object()->post_name ?? '', array(
		'woocommerce-analytics-dashboard', 'ga4-vs-woocommerce-analytics',
		'metorik-alternative', 'agency-analytics-reporting-workflow',
	), true );
}

add_filter( 'seoistic/schema_nodes', static function ( $nodes ) {
	if ( ! insightistic_editorial_campaign_credit() ) {
		return $nodes;
	}
	foreach ( $nodes as &$node ) {
		if ( array_intersect( array( 'BlogPosting', 'Article' ), (array) ( $node['@type'] ?? array() ) ) ) {
			$node['author'] = array( '@type' => 'Organization', 'name' => 'Insightistic Editorial Team', 'url' => home_url( '/about/' ) );
		}
	}
	unset( $node );
	return $nodes;
}, 50 );

/** Replace the guide destinations through the directory’s existing data filter. */
add_filter( 'insightistic_knowledgebase_guides', static function () {
	$cards = array(
		array( 'WooCommerce weekly scorecard', 'Check net sales, orders, returns and checkout against a comparable week.', 'WooCommerce', '/woocommerce-analytics-dashboard/' ),
		array( 'Reconcile WooCommerce, GA4 and Stripe', 'Trace a missing purchase, refund or payout with a five-order example.', 'GA4', '/ga4-vs-woocommerce-analytics/' ),
		array( 'Build a client-ready WooCommerce report', 'Use a sample agency report with findings, evidence and owners.', 'Agency workflow', '/agency-analytics-reporting-workflow/' ),
		array( 'Diagnose WooCommerce performance', 'Separate field data, tests and checkout request delays.', 'Core Web Vitals', '/core-web-vitals-woocommerce/' ),
		array( 'Review AI-generated analytics', 'Set guardrails for AI insights and verify findings against source reports.', 'AI governance', '/ai-analytics-governance-wordpress/' ),
		array( 'Use WooCommerce analytics safely', 'Match consent, roles and data boundaries to the reporting workflow.', 'Data privacy', '/woocommerce-data-privacy-analytics/' ),
	);
	return array_map( static function ( $card ) {
		return array( 'title' => $card[0], 'description' => $card[1], 'label' => $card[2], 'url' => home_url( $card[3] ) );
	}, $cards );
} );

/** These shared template anchors need different destinations on their own landing pages. */
function insightistic_editorial_feature_cta( $html ) {
	$slug = is_front_page() ? 'home' : ( is_page() ? ( get_queried_object()->post_name ?? '' ) : '' );
	$links = array(
		'home' => array( '/pricing', 'Explore features', '/features/', 'Explore features' ),
		'woocommerce-analytics' => array( '/woocommerce-analytics', 'Explore WooCommerce analytics', '/woocommerce-analytics-dashboard/#weekly-scorecard', 'See the weekly WooCommerce scorecard' ),
		'seo-analytics' => array( '/seo-analytics', 'Explore SEO analytics', '/google-search-console-woocommerce-seo-reporting/', 'Read the WooCommerce Search Console guide' ),
		'traffic-analytics' => array( '/traffic-analytics', 'Explore traffic analytics', '/ga4-vs-woocommerce-analytics/', 'Reconcile GA4 with WooCommerce orders' ),
		'ai-insights' => array( '/ai-insights', 'See how AI insights work', '/agency-analytics-reporting-workflow/#agent-jolly', 'See Agent JOLLEY’s reporting prompt' ),
		'reports' => array( '/reports', 'See report examples', '/agency-analytics-reporting-workflow/#example-report', 'See a sample client report' ),
		'performance-monitoring' => array( '/performance-monitoring', 'Explore performance monitoring', '/core-web-vitals-woocommerce/#slow-woocommerce-checkout', 'Diagnose a slow WooCommerce checkout' ),
		'pricing' => array( '/pricing', 'See full plan details and FAQ', '/ltd/', 'Compare the separate AppSumo lifetime offer' ),
	);
	if ( ! isset( $links[ $slug ] ) ) {
		return $html;
	}
	list( $old, $label, $new, $replacement ) = $links[ $slug ];
	$label_regex = preg_quote( $label, '~' );
	$url_regex = preg_quote( untrailingslashit( home_url( $old ) ), '~' );
	$pattern = '~(<a\b[^>]*\bhref=")' . $url_regex . '/?("[^>]*>\s*)' . $label_regex . '(?=\s|<)~u';
	return preg_replace_callback(
		$pattern,
		static function ( $match ) use ( $new, $replacement ) {
			return $match[1] . esc_url( home_url( $new ) ) . $match[2] . esc_html( $replacement );
		},
		$html,
		1
	) ?? $html;
}
