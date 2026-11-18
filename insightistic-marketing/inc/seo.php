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
	$recognized = defined( 'WPSEO_VERSION' )
		|| defined( 'RANK_MATH_VERSION' )
		|| defined( 'AIOSEO_VERSION' )
		|| class_exists( 'All_in_One_SEO_Pack' )
		|| class_exists( 'SEOPress' )
		|| defined( 'SEOISTIC_VERSION' )
		|| class_exists( '\Wpistic\Seoistic\Plugin' );

	if ( $recognized ) {
		return true;
	}

	/*
	 * SEOISTIC can be loaded through a mu-plugin or a Composer bootstrap before
	 * its public version constant/class is available. Its public filters are a
	 * reliable runtime signal and prevent this theme from printing a second
	 * canonical, description, robots or schema set.
	 */
	foreach ( array( 'seoistic/open_graph', 'seoistic/twitter', 'seoistic/schema_nodes' ) as $seoistic_hook ) {
		if ( false !== has_filter( $seoistic_hook ) ) {
			return true;
		}
	}

	$active_plugins = array_merge(
		(array) get_option( 'active_plugins', array() ),
		array_keys( (array) get_site_option( 'active_sitewide_plugins', array() ) )
	);

	foreach ( $active_plugins as $plugin_file ) {
		if ( false !== stripos( (string) $plugin_file, 'seoistic' ) ) {
			return true;
		}
	}

	return false;
}

/** Categories intentionally kept indexable as useful editorial hubs. */
function insightistic_indexable_category_slugs() {
	return array( 'blog', 'woocommerce', 'analytics', 'ai-insights', 'product-updates', 'seo' );
}

/** Canonical descriptions used both in the archive UI and SEO metadata. */
function insightistic_category_descriptions() {
	return array(
		'blog'            => 'Practical Insightistic articles on WordPress analytics, WooCommerce reporting, SEO visibility, performance monitoring, AI insights and product updates.',
		'woocommerce'     => 'WooCommerce analytics guides for revenue, orders, AOV, refunds, products, customers, cohorts and store reporting decisions.',
		'analytics'       => 'Analytics guides for connecting traffic, engagement, revenue, customer behavior and business performance without losing the context behind the numbers.',
		'ai-insights'     => 'Evidence-led AI analytics guidance for turning changes in WordPress and WooCommerce data into clear explanations, reviews and practical next actions.',
		'product-updates' => 'Verified Insightistic product updates and release notes covering analytics, reporting, AI workflows, integrations, performance and connected-site improvements.',
		'seo'             => 'Technical SEO and search visibility playbooks for WordPress, WooCommerce, content teams and agencies, including audits, reporting and internal linking.',
	);
}

/** True only for curated category hubs that are intended to rank. */
function insightistic_taxonomy_is_indexable( $term ) {
	return $term instanceof WP_Term
		&& 'category' === $term->taxonomy
		&& in_array( $term->slug, insightistic_indexable_category_slugs(), true );
}

/** Replace empty/default category copy once, preserving editor-written copy. */
function insightistic_provision_category_descriptions() {
	$version = '2026-11-12-category-copy-1';
	if ( $version === get_option( 'insightistic_category_copy_version' ) ) {
		return;
	}

	$descriptions = insightistic_category_descriptions();
	foreach ( $descriptions as $slug => $description ) {
		$term = get_term_by( 'slug', $slug, 'category' );
		if ( ! $term || is_wp_error( $term ) ) {
			continue;
		}

		$current = trim( wp_strip_all_tags( (string) $term->description ) );
		if ( '' === $current || 'your blog category' === strtolower( $current ) ) {
			wp_update_term( $term->term_id, 'category', array( 'description' => $description ) );
		}
	}

	update_option( 'insightistic_category_copy_version', $version, false );
}
add_action( 'init', 'insightistic_provision_category_descriptions', 21 );

function insightistic_seo_page_defaults() {
	return array(
		''                       => array( 'Insightistic | AI business intelligence for WordPress & WooCommerce', 'Connect WordPress and WooCommerce analytics, SEO, performance and explainable AI insights in one workspace built for clearer business decisions.' ),
		'features'               => array( 'Insightistic features | WordPress & WooCommerce analytics', 'Explore revenue, WooCommerce, SEO, performance, reports and explainable AI insights for WordPress teams that need a clearer operating view.' ),
		'pricing'                => array( 'Insightistic pricing | WordPress & WooCommerce business intelligence', 'Compare Insightistic plans for WordPress and WooCommerce analytics, SEO intelligence, AI insights, reports, connected sites and agency workflows.' ),
		'woocommerce-analytics'  => array( 'WooCommerce analytics that explains the numbers | Insightistic', 'Track WooCommerce revenue, orders, AOV, refunds, products and customers in one analytics workspace built for practical store decisions.' ),
		'traffic-analytics'      => array( 'Traffic analytics for WordPress & WooCommerce | Insightistic', 'Connect WordPress traffic, channels, landing pages and engagement signals with store outcomes so your team can act on the changes that matter.' ),
		'seo-analytics'          => array( 'SEO analytics for WordPress & WooCommerce | Insightistic', 'Connect Search Console, landing pages and commerce context to understand what drives organic traffic and which SEO opportunities deserve action.' ),
		'performance-monitoring' => array( 'WordPress performance monitoring | Insightistic', 'Monitor WordPress and WooCommerce performance, Core Web Vitals, uptime and sync health with a repeatable workflow for investigating regressions.' ),
		'ai-insights'            => array( 'Explainable AI business insights | Insightistic', 'Turn WordPress and WooCommerce changes into plain-language explanations, evidence-backed recommendations and reviewable next actions.' ),
		'reports'                => array( 'Branded analytics reports for agencies | Insightistic', 'Create branded weekly and monthly analytics reports for clients with the right WordPress, WooCommerce, traffic, SEO and AI business insights.' ),
		'integrations'           => array( 'WordPress & WooCommerce integrations | Insightistic', 'Connect WordPress, WooCommerce, Search Console, GA4 and billing through an authenticated analytics workflow with clear data boundaries.' ),
		'knowledgebase'          => array( 'Insightistic Knowledgebase | WordPress analytics guides', 'Read practical guides for WooCommerce analytics, traffic, SEO, performance, AI insights, reporting and privacy-safe business connections.' ),
		'about'                  => array( 'About Insightistic | Built by WordPressistic', 'Learn how Insightistic helps WordPress and WooCommerce operators replace scattered reporting with a clearer operating view and reviewable decisions.' ),
		'contact'                => array( 'Contact Insightistic | Product and support questions', 'Contact the Insightistic team about analytics, agency workflows, integrations, security, data boundaries and product access.' ),
		'ecosystem'              => array( 'WordPressistic ecosystem | Insightistic', 'See how Insightistic fits into the WordPressistic ecosystem of WordPress-first business automation products for modern digital businesses.' ),
		'sitemap'                => array( 'Insightistic sitemap | Product, guides and legal pages', 'Browse the canonical Insightistic product, learning, company, ecosystem and legal pages from one structured sitemap.' ),
		'security'               => array( 'Insightistic Security & Trust Center', 'Read Insightistic’s public security, privacy and data-boundary overview for WordPress and WooCommerce connections, accounts and reports.' ),
		'privacy-policy'         => array( 'Privacy Policy | Insightistic', 'Read how WordPressistic LLC handles information across the Insightistic website, app and connected WordPress services, including rights and retention.' ),
		'terms'                  => array( 'Terms of Service | Insightistic', 'Read the terms that govern use of the Insightistic website, application, API, connected sites, billing and related services.' ),
		'cookies'                => array( 'Cookie Policy | Insightistic', 'Learn how Insightistic uses cookies and similar technologies across the public website, app and connected analytics experience.' ),
		'data-processing'        => array( 'Data Processing Information | Insightistic', 'Review roles, instructions, data-subject requests, subprocessors and deletion information for Insightistic customers and connected sites.' ),
		'accessibility'          => array( 'Accessibility Statement | Insightistic', 'Read Insightistic’s accessibility commitment, known limitations, supported feedback route and approach to improving the product experience.' ),
		'refunds'                => array( 'Refund & Cancellation Policy | Insightistic', 'Review current Insightistic guidance for cancellation, refund requests, billing issues, plan changes and eligibility for account credits.' ),
		'acceptable-use'         => array( 'Acceptable Use Policy | Insightistic', 'Review allowed and prohibited uses for the Insightistic website, app, API, AI features and connected WordPress or WooCommerce data.' ),
		'subprocessors'          => array( 'Subprocessors | Insightistic', 'Review the current service categories that may process information to operate Insightistic and support connected analytics workflows.' ),
		'legal-notices'          => array( 'Legal Notices | Insightistic', 'Find the public legal operator, entity details, address, contact information and notices for the Insightistic service.' ),
		'why-insightistic'       => array( 'Why Insightistic | Clearer WordPress business intelligence', 'See why WordPress and WooCommerce teams use Insightistic to connect commerce, traffic, SEO, performance and explainable AI decisions.' ),
		'changelog'              => array( 'Insightistic changelog | Product updates', 'Follow verified Insightistic product updates, release notes and changes across analytics, reporting, AI, integrations and the connected plugin.' ),
		'product-tour'           => array( 'Insightistic product tour | Analytics, SEO and AI workflows', 'Explore the Insightistic product tour for revenue analytics, search visibility, performance monitoring, reports and explainable AI workflows.' ),
		'lifetime-deal'          => array( 'Insightistic AppSumo lifetime tiers', 'Compare the current Insightistic AppSumo Tier 1–5 lifetime entitlements, published allowances and redemption guidance.' ),
	);
}

function insightistic_seo_description() {
	if ( is_singular() ) {
		$custom_description = get_post_meta( get_queried_object_id(), 'insightistic_seo_description', true );
		if ( $custom_description ) {
			return wp_trim_words( wp_strip_all_tags( $custom_description ), 30, '…' );
		}
	}
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
	if ( is_category() ) {
		$term = get_queried_object();
		$descriptions = insightistic_category_descriptions();
		if ( $term && isset( $descriptions[ $term->slug ] ) ) {
			return $descriptions[ $term->slug ];
		}
	}
	if ( is_category() || is_tag() || is_archive() ) {
		return wp_trim_words( wp_strip_all_tags( get_the_archive_description() ), 30, '…' ) ?: 'Practical WordPress, WooCommerce and AI analytics guidance from Insightistic.';
	}
	return 'Insightistic product information, WordPress analytics guides and trust documentation.';
}

function insightistic_seo_title() {
	$defaults = insightistic_seo_page_defaults();
	if ( is_singular() ) {
		$custom_title = get_post_meta( get_queried_object_id(), 'insightistic_seo_title', true );
		if ( $custom_title ) {
			return wp_strip_all_tags( $custom_title );
		}
		$slug = get_post_field( 'post_name', get_queried_object_id() );
		if ( isset( $defaults[ $slug ] ) ) {
			return $defaults[ $slug ][0];
		}
		if ( is_singular( 'post' ) ) {
			return get_the_title() . ' | Insightistic';
		}
	}
	return wp_get_document_title();
}

/** Return a stable, first-party image for schema and social previews. */
function insightistic_seo_default_image() {
	return insightistic_asset_url( 'assets/images/insightistic-brand-logo.png' );
}

/** Let WordPress use the same controlled title as the head metadata. */
function insightistic_filter_document_title( $title ) {
	if ( is_singular() ) {
		return insightistic_seo_title();
	}
	return $title;
}
add_filter( 'pre_get_document_title', 'insightistic_filter_document_title' );

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
	$image = insightistic_seo_default_image();
	if ( is_singular() && has_post_thumbnail() ) {
		$src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
		$image = $src ? $src[0] : $image;
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

/** Prevent WordPress core from printing a second canonical beside the fallback set. */
function insightistic_remove_core_canonical() {
	if ( ! insightistic_seo_plugin_active() ) {
		remove_action( 'wp_head', 'rel_canonical' );
	}
}
add_action( 'wp', 'insightistic_remove_core_canonical', 1 );

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

/**
 * Tag archives are thin, duplicative navigation states on this site. Send
 * them to the canonical editorial hub instead of allowing them to compete in
 * search or remain as redirecting internal links.
 */
function insightistic_redirect_tag_archives() {
	if ( ! is_tag() ) {
		return;
	}

	wp_safe_redirect( home_url( '/blog/' ), 301 );
	exit;
}
add_action( 'template_redirect', 'insightistic_redirect_tag_archives', 1 );

function insightistic_schema_graph() {
	$details = insightistic_business_details();
	$author  = insightistic_editorial_author();
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
	$product_image = insightistic_seo_default_image();
	$organization_logo = array(
		'@type' => 'ImageObject',
		'@id'   => $product_image . '#logo',
		'url'   => $product_image,
	);
	$nodes   = array(
		array( '@type' => 'Organization', '@id' => $brand, 'name' => 'WordPressistic LLC', 'legalName' => 'WordPressistic LLC', 'url' => 'https://wordpressistic.com/', 'email' => $details['email'], 'telephone' => $details['telephone'], 'logo' => $organization_logo, 'image' => $product_image, 'address' => array( '@type' => 'PostalAddress', 'streetAddress' => $details['address'], 'addressLocality' => $details['city'], 'addressRegion' => $details['state'], 'postalCode' => $details['postal_code'], 'addressCountry' => $details['country'] ), 'contactPoint' => array( '@type' => 'ContactPoint', 'contactType' => 'customer support', 'telephone' => $details['telephone'], 'email' => $details['email'], 'url' => home_url( '/contact/' ), 'availableLanguage' => 'English' ), 'identifier' => array( '@type' => 'PropertyValue', 'propertyID' => 'Entity ID', 'value' => $details['entity_id'] ), 'sameAs' => $same_as, 'brand' => array( '@type' => 'Brand', 'name' => 'Insightistic', 'url' => home_url( '/' ) ) ),
		array( '@type' => 'WebSite', '@id' => home_url( '/#website' ), 'url' => home_url( '/' ), 'name' => 'Insightistic', 'description' => insightistic_seo_page_defaults()[''][1], 'publisher' => array( '@id' => $brand ), 'inLanguage' => get_bloginfo( 'language' ) ),
	);

	/*
	 * Insightistic is a web application, not a physical merchant product.
	 * Keep the application entity descriptive only. Pricing is visible in the
	 * page content; emitting Offer/Product data here creates Merchant listing
	 * requirements (shipping, returns, identifiers and reviews) that do not
	 * apply to this SaaS marketing site.
	 */
	if ( is_front_page() || is_page( array( 'pricing', 'lifetime-deal', 'ltd' ) ) ) {
		$nodes[] = array( '@type' => 'SoftwareApplication', '@id' => home_url( '/#product' ), 'name' => 'Insightistic', 'description' => insightistic_seo_page_defaults()[''][1], 'url' => home_url( '/' ), 'image' => $product_image, 'applicationCategory' => 'BusinessApplication', 'operatingSystem' => 'Web', 'publisher' => array( '@id' => $brand ), 'isPartOf' => array( '@id' => home_url( '/#website' ) ), 'brand' => array( '@type' => 'Brand', 'name' => 'Insightistic', 'url' => home_url( '/' ) ) );
	}

	if ( is_singular( 'post' ) ) {
		$article_image = $product_image;
		if ( has_post_thumbnail() ) {
			$src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
			$article_image = $src ? $src[0] : $article_image;
		}
		$article_text = wp_strip_all_tags( get_the_content() );
		$article_tags = wp_get_post_tags( get_the_ID(), array( 'fields' => 'names' ) );
		$article_node = array( '@type' => 'BlogPosting', '@id' => get_permalink() . '#article', 'headline' => get_the_title(), 'description' => insightistic_seo_description(), 'url' => get_permalink(), 'image' => $article_image, 'datePublished' => get_the_date( DATE_W3C ), 'dateModified' => get_the_modified_date( DATE_W3C ), 'author' => array( '@type' => 'Person', 'name' => $author['name'], 'jobTitle' => $author['title'], 'url' => $author['url'] ), 'publisher' => array( '@id' => $brand ), 'mainEntityOfPage' => array( '@id' => get_permalink() ), 'isPartOf' => array( '@id' => home_url( '/#website' ) ), 'inLanguage' => get_bloginfo( 'language' ) );
		if ( $article_text ) {
			$article_node['wordCount'] = str_word_count( $article_text );
		}
		if ( $article_tags ) {
			$article_node['keywords'] = implode( ', ', $article_tags );
		}
		$nodes[] = $article_node;
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

/**
 * Redirect legacy content routes and repair old internal .md links at render
 * time while the old content hierarchy is being retired.
 */
function insightistic_legacy_seo_target_url( $path ) {
	$path = trim( (string) $path, '/' );
	if ( 'ltd' === $path ) {
		return home_url( '/lifetime-deal/' );
	}

	if ( ! preg_match( '#^(?:woocommerce-analytics-plugin|woocommerce-analytics-guide|woocommerce-analytics-pricing|woocommerce-analytics-free|woocommerce-analytics-dashboard)/([^/]+)\.md$#i', $path, $matches ) ) {
		return '';
	}

	$map = array(
		'woocommerce-analytics-free'          => '/woocommerce-analytics/',
		'woocommerce-analytics-dashboard'     => '/woocommerce-analytics/',
		'white-label-wordpress-analytics'     => '/agency/',
		'white-label-woocommerce-reports'     => '/reports/',
		'white-label-analytics-dashboard'     => '/agency/',
		'monsterinsights-alternative'         => '/woocommerce-analytics/',
		'metorik-alternative'                 => '/woocommerce-analytics/',
		'ecommerce-analytics'                => '/woocommerce-analytics/',
		'customer-lifetime-value-woocommerce' => '/customer-lifetime-value-woocommerce/',
		'best-woocommerce-analytics-plugin'   => '/woocommerce-analytics/',
		'ai-business-analytics'               => '/ai-insights/',
		'agency-woocommerce-reporting'        => '/agency-analytics-reporting-workflow/',
		'woocommerce-sales-reports'           => '/woocommerce-analytics-kpis/',
		'woocommerce-reports'                 => '/woocommerce-analytics-kpis/',
		'woocommerce-reports-for-clients'     => '/agency-analytics-reporting-workflow/',
		'woocommerce-profit-reports'          => '/woocommerce-analytics-kpis/',
		'woocommerce-reporting-plugin'        => '/woocommerce-analytics/',
		'woocommerce-analytics-pricing'       => '/pricing/',
		'woocommerce-analytics'               => '/woocommerce-analytics/',
	);

	$slug = sanitize_title( $matches[1] );
	return home_url( $map[ $slug ] ?? '/woocommerce-analytics/' );
}

function insightistic_legacy_seo_redirects() {
	if ( ! is_404() ) {
		return;
	}

	$path   = wp_parse_url( (string) ( $_SERVER['REQUEST_URI'] ?? '' ), PHP_URL_PATH );
	$target = insightistic_legacy_seo_target_url( $path );
	if ( ! $target ) {
		return;
	}

	wp_safe_redirect( $target, 301 );
	exit;
}
add_action( 'template_redirect', 'insightistic_legacy_seo_redirects', 1 );

function insightistic_rewrite_legacy_seo_links( $content ) {
	if ( ! is_string( $content ) || false === stripos( $content, '.md' ) ) {
		return $content;
	}

	return preg_replace_callback(
		'/(<a\b[^>]*\bhref\s*=\s*)(["\'])([^"\']+)\2/i',
		function ( $matches ) {
			$url  = html_entity_decode( $matches[3], ENT_QUOTES, 'UTF-8' );
			$host = wp_parse_url( $url, PHP_URL_HOST );
			$home = wp_parse_url( home_url( '/' ), PHP_URL_HOST );
			if ( $host && $home && strtolower( $host ) !== strtolower( $home ) ) {
				return $matches[0];
			}

			$path   = wp_parse_url( $url, PHP_URL_PATH );
			$target = insightistic_legacy_seo_target_url( $path );
			if ( ! $target ) {
				return $matches[0];
			}

			return $matches[1] . $matches[2] . esc_url( $target ) . $matches[2];
		},
		$content
	);
}
add_filter( 'the_content', 'insightistic_rewrite_legacy_seo_links', 20 );

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
