<?php
/**
 * First-party metadata, robots and JSON-LD graph.
 *
 * A recognised SEO plugin remains the owner of meta/schema output. When no
 * SEO plugin is active, this module provides complete sensible fallbacks.
 * It deliberately avoids ratings, awards, customer counts and performance
 * claims that the site cannot substantiate.
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function insightistic_seo_plugin_active() {
	return defined( 'WPSEO_VERSION' )
		|| defined( 'RANK_MATH_VERSION' )
		|| defined( 'AIOSEO_VERSION' )
		|| class_exists( 'All_in_One_SEO_Pack' )
		|| class_exists( 'SEOPress' );
}

function insightistic_seo_page_defaults() {
	return array(
		''                       => array( 'Insightistic | AI business intelligence for WordPress & WooCommerce', 'Connect WordPress and WooCommerce analytics, SEO, performance and explainable AI insights in one workspace built for clearer business decisions.' ),
		'features'               => array( 'Insightistic features | WordPress & WooCommerce analytics', 'Explore revenue analytics, WooCommerce intelligence, AI business insights, reports, site health monitoring and agency workflows.' ),
		'pricing'                => array( 'Insightistic pricing | WordPress & WooCommerce business intelligence', 'Compare Free Connected, paid subscriptions, monthly resources and Insight Credit packs for WordPress and WooCommerce teams.' ),
		'woocommerce-analytics'  => array( 'WooCommerce analytics that explains the numbers | Insightistic', 'Track revenue, orders, AOV, refunds, products and customers in a focused WooCommerce analytics workspace.' ),
		'traffic-analytics'      => array( 'Traffic analytics for WordPress & WooCommerce | Insightistic', 'Connect traffic and engagement signals with store outcomes so WordPress teams can see which channels deserve attention.' ),
		'seo-analytics'          => array( 'SEO analytics for WordPress & WooCommerce | Insightistic', 'Bring search visibility, landing-page and commerce context together for clearer SEO reporting and decisions.' ),
		'performance-monitoring' => array( 'WordPress performance monitoring | Insightistic', 'Monitor performance signals across WordPress and WooCommerce and give your team a repeatable way to investigate changes.' ),
		'ai-insights'            => array( 'Explainable AI business insights | Insightistic', 'Turn changes in WordPress and WooCommerce data into plain-language explanations and reviewable next actions.' ),
		'reports'                => array( 'Branded analytics reports for agencies | Insightistic', 'Create scheduled, client-ready analytics reports with your brand, the right metrics and practical recommendations.' ),
		'integrations'           => array( 'WordPress & WooCommerce integrations | Insightistic', 'Connect WordPress, WooCommerce, billing, reports and AI context through a clear, authenticated analytics workflow.' ),
		'knowledgebase'          => array( 'Insightistic Knowledgebase | WordPress analytics guides', 'Practical guides for WooCommerce analytics, traffic, SEO, performance, AI insights, reporting and privacy-safe connections.' ),
		'about'                  => array( 'About Insightistic | Built by WordPressistic', 'Learn how Insightistic helps WordPress and WooCommerce operators replace scattered reporting with a clearer operating view.' ),
		'contact'                => array( 'Contact Insightistic | Product and support questions', 'Contact the Insightistic team about analytics, agency workflows, integrations, security and product access.' ),
		'ecosystem'              => array( 'WordPressistic ecosystem | Insightistic', 'See how Insightistic fits into the WordPressistic ecosystem of WordPress-first business automation products.' ),
		'sitemap'                => array( 'Insightistic sitemap | Product, guides and legal pages', 'Browse the canonical Insightistic product, learning, company, ecosystem and legal pages.' ),
		'security'               => array( 'Insightistic Security & Trust Center', 'Read Insightistic’s public security, privacy and data-boundary overview for WordPress and WooCommerce connections.' ),
		'privacy-policy'         => array( 'Privacy Policy | Insightistic', 'Read how WordPressistic LLC handles information across the Insightistic website, app and connected WordPress services.' ),
		'terms'                  => array( 'Terms of Service | Insightistic', 'The terms that govern use of the Insightistic website and application.' ),
		'cookies'                => array( 'Cookie Policy | Insightistic', 'How Insightistic uses cookies and similar technologies across the public website.' ),
		'data-processing'        => array( 'Data Processing Information | Insightistic', 'Roles, instructions, data-subject requests, subprocessors and deletion information for Insightistic customers.' ),
		'accessibility'          => array( 'Accessibility Statement | Insightistic', 'Insightistic’s accessibility commitment, known limitations and feedback channel.' ),
		'refunds'                => array( 'Refund & Cancellation Policy | Insightistic', 'Current guidance for Insightistic cancellation, refund requests, billing issues and plan guarantees.' ),
		'acceptable-use'         => array( 'Acceptable Use Policy | Insightistic', 'Allowed and prohibited uses for the Insightistic website, app, API and connected data.' ),
		'subprocessors'          => array( 'Subprocessors | Insightistic', 'Current service categories that may process information to operate Insightistic.' ),
		'legal-notices'          => array( 'Legal Notices | Insightistic', 'Public legal operator, address, entity and contact information for Insightistic.' ),
	);
}

function insightistic_seo_description() {
	if ( is_singular( 'post' ) && has_excerpt() ) {
		return wp_trim_words( wp_strip_all_tags( get_the_excerpt() ), 30, '…' );
	}
	if ( is_singular() ) {
		$slug     = get_post_field( 'post_name', get_queried_object_id() );
		$defaults = insightistic_seo_page_defaults();
		if ( isset( $defaults[ $slug ] ) ) {
			return $defaults[ $slug ][1];
		}
		if ( has_excerpt() ) {
			return wp_trim_words( wp_strip_all_tags( get_the_excerpt() ), 30, '…' );
		}
	}
	$defaults = insightistic_seo_page_defaults();
	if ( is_front_page() || is_home() ) {
		return $defaults[''][1];
	}
	if ( is_category() || is_tag() || is_archive() ) {
		return wp_trim_words( wp_strip_all_tags( get_the_archive_description() ), 30, '…' ) ?: 'Practical WordPress, WooCommerce and AI analytics guidance from Insightistic.';
	}
	return 'Insightistic product information, WordPress analytics guides and trust documentation.';
}

function insightistic_seo_title() {
	$defaults = insightistic_seo_page_defaults();
	if ( is_singular() ) {
		$slug = get_post_field( 'post_name', get_queried_object_id() );
		if ( isset( $defaults[ $slug ] ) ) {
			return $defaults[ $slug ][0];
		}
	}
	return wp_get_document_title();
}

function insightistic_seo_canonical_url() {
	if ( is_singular() ) {
		return get_permalink();
	}
	if ( is_front_page() ) {
		return home_url( '/' );
	}
	if ( is_home() ) {
		$page = get_option( 'page_for_posts' );
		return $page ? get_permalink( $page ) : home_url( '/blog/' );
	}
	if ( is_category() || is_tag() || is_tax() ) {
		$link = get_term_link( get_queried_object() );
		return is_wp_error( $link ) ? home_url( '/' ) : $link;
	}
	return home_url( '/' );
}

function insightistic_output_seo_meta() {
	if ( insightistic_seo_plugin_active() ) {
		return;
	}

	$title = insightistic_seo_title();
	$desc  = insightistic_seo_description();
	$url   = insightistic_seo_canonical_url();
	$image = '';
	if ( is_singular() && has_post_thumbnail() ) {
		$src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
		$image = $src ? $src[0] : '';
	}

	printf( "<link rel=\"canonical\" href=\"%s\">\n", esc_url( $url ) );
	printf( "<meta name=\"description\" content=\"%s\">\n", esc_attr( $desc ) );
	printf( "<meta property=\"og:type\" content=\"%s\">\n", is_singular( 'post' ) ? 'article' : 'website' );
	echo '<meta property="og:site_name" content="Insightistic">' . "\n";
	printf( "<meta property=\"og:title\" content=\"%s\">\n", esc_attr( $title ) );
	printf( "<meta property=\"og:description\" content=\"%s\">\n", esc_attr( $desc ) );
	printf( "<meta property=\"og:url\" content=\"%s\">\n", esc_url( $url ) );
	if ( $image ) {
		printf( "<meta property=\"og:image\" content=\"%s\">\n", esc_url( $image ) );
	}
	printf( "<meta name=\"twitter:card\" content=\"%s\">\n", $image ? 'summary_large_image' : 'summary' );
	printf( "<meta name=\"twitter:title\" content=\"%s\">\n", esc_attr( $title ) );
	printf( "<meta name=\"twitter:description\" content=\"%s\">\n", esc_attr( $desc ) );
	if ( $image ) {
		printf( "<meta name=\"twitter:image\" content=\"%s\">\n", esc_url( $image ) );
	}
}
add_action( 'wp_head', 'insightistic_output_seo_meta', 1 );

/** Advertise the stable machine-readable discovery surfaces in document head. */
function insightistic_output_discovery_links() {
	echo '<link rel="sitemap" type="application/xml" href="' . esc_url( home_url( '/sitemap.xml' ) ) . '">' . "\n";
	echo '<link rel="alternate" type="text/plain" href="' . esc_url( home_url( '/llms.txt' ) ) . '" title="Insightistic machine-readable overview">' . "\n";
	echo '<link rel="alternate" type="text/plain" href="' . esc_url( home_url( '/llms-full.txt' ) ) . '" title="Insightistic full machine-readable overview">' . "\n";
}
add_action( 'wp_head', 'insightistic_output_discovery_links', 2 );

/** Noindex utility/search/duplicate states that should not compete in SERPs. */
add_filter(
	'wp_robots',
	function ( $robots ) {
		if ( is_search() || is_404() || is_author() || is_date() || is_feed() || is_paged() ) {
			$robots['noindex'] = true;
			$robots['follow']  = true;
		}
		return $robots;
	}
);

function insightistic_schema_graph() {
	$details = insightistic_business_details();
	$author  = insightistic_editorial_author();
	$catalog = insightistic_public_catalog();
	$brand   = home_url( '/#organization' );
	$same_as = array();
	foreach ( insightistic_ecosystem_links() as $ecosystem_link ) {
		if ( ! empty( $ecosystem_link['external'] ) && ! empty( $ecosystem_link['url'] ) ) {
			$same_as[] = esc_url_raw( $ecosystem_link['url'] );
		}
	}
	foreach ( array( 'twitter', 'linkedin', 'youtube', 'github' ) as $social_slug ) {
		$social_url = insightistic_option( 'insightistic_social_' . $social_slug, '' );
		if ( $social_url ) {
			$same_as[] = esc_url_raw( $social_url );
		}
	}
	$same_as = array_values( array_unique( $same_as ) );
	$offers = array();
	foreach ( (array) ( $catalog['plans'] ?? array() ) as $plan ) {
		$price = preg_replace( '/[^0-9.]/', '', (string) ( $plan['monthly'] ?? '' ) );
		if ( '' !== $price ) {
			$offers[] = array( '@type' => 'Offer', 'name' => $plan['name'], 'price' => $price, 'priceCurrency' => 'USD', 'url' => home_url( '/pricing/' ), 'availability' => 'https://schema.org/InStock' );
		}
	}
	$nodes   = array(
		array( '@type' => 'Organization', '@id' => $brand, 'name' => 'WordPressistic LLC', 'legalName' => 'WordPressistic LLC', 'url' => 'https://wordpressistic.com/', 'email' => $details['email'], 'address' => array( '@type' => 'PostalAddress', 'streetAddress' => $details['address'], 'addressLocality' => $details['city'], 'addressRegion' => $details['state'], 'postalCode' => $details['postal_code'], 'addressCountry' => $details['country'] ), 'identifier' => array( '@type' => 'PropertyValue', 'propertyID' => 'Entity ID', 'value' => $details['entity_id'] ), 'sameAs' => $same_as, 'brand' => array( '@type' => 'Brand', 'name' => 'Insightistic', 'url' => home_url( '/' ) ) ),
		array( '@type' => 'WebSite', '@id' => home_url( '/#website' ), 'url' => home_url( '/' ), 'name' => 'Insightistic', 'description' => insightistic_seo_page_defaults()[''][1], 'publisher' => array( '@id' => $brand ), 'inLanguage' => get_bloginfo( 'language' ) ),
		array( '@type' => array( 'SoftwareApplication', 'Product' ), '@id' => home_url( '/#product' ), 'name' => 'Insightistic', 'description' => insightistic_seo_page_defaults()[''][1], 'url' => home_url( '/' ), 'applicationCategory' => 'BusinessApplication', 'operatingSystem' => 'Web', 'publisher' => array( '@id' => $brand ), 'isPartOf' => array( '@id' => home_url( '/#website' ) ), 'offers' => $offers ),
	);

	if ( is_singular( 'post' ) ) {
		$nodes[] = array( '@type' => 'BlogPosting', '@id' => get_permalink() . '#article', 'headline' => get_the_title(), 'description' => insightistic_seo_description(), 'url' => get_permalink(), 'datePublished' => get_the_date( DATE_W3C ), 'dateModified' => get_the_modified_date( DATE_W3C ), 'author' => array( '@type' => 'Person', 'name' => $author['name'], 'jobTitle' => $author['title'], 'url' => $author['url'] ), 'publisher' => array( '@id' => $brand ), 'mainEntityOfPage' => array( '@id' => get_permalink() ), 'isPartOf' => array( '@id' => home_url( '/#website' ) ), 'inLanguage' => get_bloginfo( 'language' ) );
	} elseif ( ! is_404() && ! is_search() && ! is_feed() ) {
		$nodes[] = array( '@type' => is_archive() || is_home() ? 'CollectionPage' : 'WebPage', '@id' => insightistic_seo_canonical_url() . '#webpage', 'url' => insightistic_seo_canonical_url(), 'name' => insightistic_seo_title(), 'description' => insightistic_seo_description(), 'isPartOf' => array( '@id' => home_url( '/#website' ) ), 'about' => array( '@id' => home_url( '/#product' ) ), 'inLanguage' => get_bloginfo( 'language' ) );
	}

	if ( ! is_front_page() && ! is_404() && ! is_search() ) {
		$items = array( array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ) );
		if ( is_singular() ) {
			$items[] = array( '@type' => 'ListItem', 'position' => 2, 'name' => get_the_title(), 'item' => get_permalink() );
		} elseif ( is_archive() || is_home() ) {
			$items[] = array( '@type' => 'ListItem', 'position' => 2, 'name' => wp_strip_all_tags( get_the_archive_title() ), 'item' => insightistic_seo_canonical_url() );
		}
		$nodes[] = array( '@type' => 'BreadcrumbList', '@id' => insightistic_seo_canonical_url() . '#breadcrumb', 'itemListElement' => $items );
	}

	if ( is_front_page() ) {
		$questions = array();
		foreach ( insightistic_faqs() as $faq ) {
			$questions[] = array( '@type' => 'Question', 'name' => wp_strip_all_tags( $faq['q'] ), 'acceptedAnswer' => array( '@type' => 'Answer', 'text' => wp_strip_all_tags( $faq['a'] ) ) );
		}
		if ( $questions ) {
			$nodes[] = array( '@type' => 'FAQPage', '@id' => home_url( '/#faq' ), 'mainEntity' => $questions );
		}
	}

	return array( '@context' => 'https://schema.org', '@graph' => $nodes );
}

function insightistic_output_schema_graph() {
	if ( insightistic_seo_plugin_active() || is_404() || is_search() || is_feed() ) {
		return;
	}
	echo '<script type="application/ld+json">' . wp_json_encode( insightistic_schema_graph(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- JSON-LD is encoded by wp_json_encode().
}
add_action( 'wp_head', 'insightistic_output_schema_graph', 20 );

function insightistic_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' !== $relation_type ) {
		return $urls;
	}
	foreach ( array( insightistic_app_base(), insightistic_api_url() ) as $origin ) {
		$host = wp_parse_url( $origin, PHP_URL_HOST );
		if ( $host ) {
			$urls[] = array( 'href' => 'https://' . $host, 'crossorigin' => '' );
		}
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'insightistic_resource_hints', 10, 2 );
