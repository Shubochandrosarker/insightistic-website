<?php
/**
 * First-party site data used by templates, schema and discovery files.
 *
 * Keep this file limited to facts that belong to the public marketing site.
 * Product limits, billing state and account data remain owned by the app/API.
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Public legal entity details supplied by the site owner. */
function insightistic_business_details() {
	return apply_filters(
		'insightistic_business_details',
		array(
			'brand'      => 'Insightistic',
			'legal_name' => 'WordPressistic LLC',
			'address'    => '1209 MOUNTAIN ROAD PL NE, STE N',
			'city'       => 'Albuquerque',
			'state'      => 'NM',
			'postal_code' => '87110',
			'country'     => 'US',
			'entity_id'   => '0008120099',
			'reference'   => '3277100',
			'email'       => 'hello@wordpressistic.com',
			'telephone'   => '+15055201914',
		)
	);
}

/** Editorial identity used on articles and in Article JSON-LD. */
function insightistic_editorial_author() {
	return apply_filters(
		'insightistic_editorial_author',
		array(
			'name'  => 'Shubo Chandra Sarker',
			'title' => 'Founder & Lead Developer',
			'url'   => home_url( '/about/' ),
		)
	);
}

/** The public date shown on legal documents; filterable for counsel review. */
function insightistic_legal_updated_date() {
	return apply_filters( 'insightistic_legal_updated_date', get_theme_mod( 'insightistic_legal_updated_date', 'September 13, 2026' ) );
}

/** Product and topic directory used by the Knowledgebase hub. */
function insightistic_knowledgebase_topics() {
	$topics = array(
		array( 'slug' => 'woocommerce-analytics', 'title' => 'WooCommerce analytics', 'description' => 'Revenue, orders, AOV, refunds, products and customer signals for store operators.', 'url' => home_url( '/woocommerce-analytics/' ) ),
		array( 'slug' => 'traffic-analytics', 'title' => 'Traffic analytics', 'description' => 'Connect acquisition and engagement signals to the store outcomes that matter.', 'url' => home_url( '/traffic-analytics/' ) ),
		array( 'slug' => 'seo-analytics', 'title' => 'SEO analytics', 'description' => 'Understand search visibility, landing pages and organic performance in context.', 'url' => home_url( '/seo-analytics/' ) ),
		array( 'slug' => 'performance-monitoring', 'title' => 'Performance monitoring', 'description' => 'Track WordPress and WooCommerce performance signals before they become revenue problems.', 'url' => home_url( '/performance-monitoring/' ) ),
		array( 'slug' => 'ai-insights', 'title' => 'AI business insights', 'description' => 'Learn how explainable AI turns changes in your data into practical next actions.', 'url' => home_url( '/ai-insights/' ) ),
		array( 'slug' => 'reports', 'title' => 'Reporting & agency operations', 'description' => 'Build repeatable weekly and monthly reporting workflows for teams and clients.', 'url' => home_url( '/reports/' ) ),
		array( 'slug' => 'integrations', 'title' => 'Integrations & data connections', 'description' => 'Understand the WordPress connector, GA4, Search Console and the data boundary.', 'url' => home_url( '/integrations/' ) ),
		array( 'slug' => 'security', 'title' => 'Security & privacy', 'description' => 'Read the platform’s data handling, account boundaries and practical security notes.', 'url' => home_url( '/security/' ) ),
	);

	return apply_filters( 'insightistic_knowledgebase_topics', $topics );
}

/** Evergreen guide cards; these become real articles as the editorial library grows. */
function insightistic_knowledgebase_guides() {
	$guides = array(
		array( 'title' => 'How to measure WooCommerce revenue without spreadsheet drift', 'description' => 'A practical framework for gross revenue, net revenue, refunds and average order value.', 'url' => home_url( '/woocommerce-analytics/' ), 'label' => 'WooCommerce guide' ),
		array( 'title' => 'GA4 and WooCommerce analytics: what each source is good at', 'description' => 'Use acquisition data and commerce data together without treating either as the whole story.', 'url' => home_url( '/traffic-analytics/' ), 'label' => 'Analytics guide' ),
		array( 'title' => 'SEO reporting for agencies: the metrics clients can act on', 'description' => 'Turn rankings, landing pages and conversions into a report that leads to a decision.', 'url' => home_url( '/reports/' ), 'label' => 'Agency guide' ),
		array( 'title' => 'Core Web Vitals monitoring for WordPress teams', 'description' => 'A simple operating rhythm for finding performance regressions and prioritising fixes.', 'url' => home_url( '/performance-monitoring/' ), 'label' => 'Performance guide' ),
		array( 'title' => 'What AI business analytics should explain before it recommends', 'description' => 'A buyer’s checklist for useful, reviewable AI insights instead of opaque scorecards.', 'url' => home_url( '/ai-insights/' ), 'label' => 'AI guide' ),
		array( 'title' => 'Privacy-safe analytics for WordPress and WooCommerce', 'description' => 'Map the data you need, the data you do not need, and the controls your team should review.', 'url' => home_url( '/security/' ), 'label' => 'Trust guide' ),
	);

	return apply_filters( 'insightistic_knowledgebase_guides', $guides );
}

/**
 * Ecosystem links. Only verified public roots are linked by default; product
 * destinations can be extended by a child theme or mu-plugin after checking
 * that the destination is live and genuinely relevant.
 */
function insightistic_ecosystem_links() {
	$links = array(
		array( 'slug' => 'wordpressistic', 'name' => 'WordPressistic', 'description' => 'The WordPress-first AI business automation ecosystem behind Insightistic.', 'url' => 'https://wordpressistic.com/', 'external' => true ),
		array( 'slug' => 'insightistic', 'name' => 'Insightistic', 'description' => 'AI business analytics for WordPress and WooCommerce.', 'url' => home_url( '/' ), 'external' => false ),
		array( 'slug' => 'tripistic', 'name' => 'Tripistic', 'description' => 'AI-native travel operations and booking workflows for tour businesses.', 'url' => 'https://tripistic.com/', 'external' => true ),
		array( 'slug' => 'chatbotistic', 'name' => 'Chatbotistic', 'description' => 'Conversational automation for customer support, lead capture and messaging.', 'url' => home_url( '/ecosystem/#chatbotistic' ), 'external' => false ),
		array( 'slug' => 'bookingistic', 'name' => 'Bookingistic', 'description' => 'Booking and scheduling workflows for service and travel businesses.', 'url' => home_url( '/ecosystem/#bookingistic' ), 'external' => false ),
		array( 'slug' => 'memberistic', 'name' => 'Memberistic', 'description' => 'Membership and access-control infrastructure for WordPress products.', 'url' => home_url( '/ecosystem/#memberistic' ), 'external' => false ),
		array( 'slug' => 'bridgistic', 'name' => 'Bridgistic', 'description' => 'Secure connections between WordPress sites and the WordPressistic ecosystem.', 'url' => home_url( '/ecosystem/#bridgistic' ), 'external' => false ),
	);

	return apply_filters( 'insightistic_ecosystem_links', $links );
}
