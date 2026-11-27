<?php
/**
 * Plugin Name: Insightistic Commercial SEO
 * Description: Metadata for commercial templates and AppSumo campaign tracking.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Keep WordPress asset and integration hooks on known SEOistic problem routes. */
function insightistic_commercial_prepare_head() {
	$hook = $GLOBALS['wp_filter']['wp_head'] ?? null;
	if ( $hook instanceof WP_Hook ) {
		$directory = trailingslashit( wp_normalize_path( WP_PLUGIN_DIR . '/seoistic' ) );
		foreach ( $hook->callbacks as $priority => $callbacks ) {
			foreach ( $callbacks as $entry ) {
				$callback = $entry['function'];
				try {
					$reflection = is_array( $callback )
						? new ReflectionMethod( $callback[0], $callback[1] )
						: ( is_string( $callback ) && str_contains( $callback, '::' )
							? new ReflectionMethod( $callback )
							: new ReflectionFunction( Closure::fromCallable( $callback ) ) );
				} catch ( Throwable $exception ) {
					continue;
				}
				$source = wp_normalize_path( (string) $reflection->getFileName() );
				$owner = $reflection instanceof ReflectionMethod ? $reflection->getDeclaringClass()->getName() : '';
				if ( str_starts_with( $source, $directory ) || str_starts_with( $owner, 'Wpistic\\Seoistic\\' ) ) {
					remove_action( 'wp_head', $callback, $priority );
				}
			}
		}
	}

	remove_action( 'wp_head', '_wp_render_title_tag', 1 );
	remove_action( 'wp_head', 'wp_robots', 1 );
	remove_action( 'wp_head', 'rel_canonical', 10 );
	add_action( 'wp_head', 'insightistic_commercial_output_head', 1 );
}

/** Commercial metadata stays specific to the queried page. */
function insightistic_commercial_metadata() {
	$slug = is_front_page() ? 'home' : ( is_home() ? 'blog' : ( get_queried_object()->post_name ?? '' ) );
	$values = array(
		'home' => array( 'WordPress & WooCommerce Analytics | Insightistic', 'Track WordPress search visibility, site health, and WooCommerce performance. Agent JOLLEY shows what changed, the evidence, and what to check next.' ),
		'ltd' => array( 'Insightistic AppSumo Lifetime Deal | Compare Tiers', 'Compare five Insightistic AppSumo lifetime tiers, including website projects, reports, team access and Agent JOLLEY. See the latest offer on AppSumo.' ),
		'agency' => array( 'White-Label WooCommerce Analytics for Agencies | Insightistic', 'Manage client sites, review WooCommerce performance and share branded reports from one Insightistic agency workspace. Compare plans and reporting options.' ),
		'pricing' => array( 'Insightistic Pricing | Compare Subscription Plans', 'Compare Free Connected, Starter, Growth, Agency and Agency Pro. Eligible paid subscriptions include a 7-day trial. View current terms in the app.' ),
		'blog' => array( 'Insightistic Blog | WooCommerce & WordPress Analytics', 'Read practical guides to WooCommerce reporting, WordPress performance and SEO, alongside product updates from the Insightistic team.' ),
		'woocommerce-analytics' => array( 'WooCommerce Analytics for Stores | Insightistic', 'Review WooCommerce sales, orders, refunds, products and customer trends. Connect store analytics with your site performance and search data.' ),
		'reports' => array( 'White-Label Analytics Reports | Insightistic', 'Review Insightistic reporting for WooCommerce and WordPress. Build, schedule and share reports, with white-label options on eligible plans.' ),
		'metorik-alternative' => array( 'Metorik Alternative for WooCommerce | Insightistic', 'Compare WooCommerce reporting workflows, including sales, customers and client reporting. See how Insightistic fits stores and agencies.' ),
		'giveaway' => array( 'Insightistic Giveaway | Official Entry Details', 'Find the Insightistic giveaway entry page and check the official KingSumo rules for eligibility, timing and prize details before you enter.' ),
	);
	return $values[ $slug ] ?? array();
}

function insightistic_commercial_output_head() {
	$meta = insightistic_commercial_metadata();
	if ( ! $meta ) {
		return;
	}
	list( $title, $description ) = $meta;
	$url = insightistic_seo_canonical_url();
	$image = insightistic_live_seo_image();
	$org_id = home_url( '/#organization' );
	$site_id = home_url( '/#website' );
	$page_id = $url . '#webpage';
	$graph = array(
		'@context' => 'https://schema.org',
		'@graph'   => array(
			array(
				'@type' => 'Organization',
				'@id'   => $org_id,
				'name'  => 'Insightistic',
				'url'   => home_url( '/' ),
				'parentOrganization' => array( '@type' => 'Organization', 'name' => 'WordPressistic LLC', 'url' => 'https://wordpressistic.com/' ),
			),
			array( '@type' => 'WebSite', '@id' => $site_id, 'name' => 'Insightistic', 'url' => home_url( '/' ), 'publisher' => array( '@id' => $org_id ) ),
			array( '@type' => 'WebPage', '@id' => $page_id, 'name' => $title, 'description' => $description, 'url' => $url, 'isPartOf' => array( '@id' => $site_id ), 'inLanguage' => get_bloginfo( 'language' ) ),
		),
	);
	printf( "<title>%s</title>\n", esc_html( $title ) );
	$tags = array(
		'og:title' => $title, 'og:url' => $url, 'og:type' => 'website', 'og:site_name' => 'Insightistic',
		'og:image' => $image, 'og:image:alt' => 'Insightistic',
		'twitter:card' => 'summary_large_image', 'twitter:title' => $title, 'twitter:image' => $image,
	);
	foreach ( $tags as $key => $value ) {
		printf( "<meta %s=\"%s\" content=\"%s\">\n", str_starts_with( $key, 'og:' ) ? 'property' : 'name', esc_attr( $key ), esc_attr( $value ) );
	}
	$json = wp_json_encode( $graph, JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP );
	if ( $json ) {
		echo '<script type="application/ld+json">' . $json . "</script>\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Encoded above.
	}
}

/** Normalize known route variants and carry tracking parameters to the landing page. */
function insightistic_commercial_redirect() {
	if ( ! in_array( $_SERVER['REQUEST_METHOD'] ?? '', array( 'GET', 'HEAD' ), true ) ) {
		return;
	}
	$request = wp_parse_url( wp_unslash( $_SERVER['REQUEST_URI'] ?? '' ) );
	$path    = $request['path'] ?? '';
	if ( ! preg_match( '~^/(ltd|agency|pricing|sitemap)/?$~iD', $path, $matches ) ) {
		return;
	}
	$canonical = '/' . strtolower( $matches[1] ) . '/';
	if ( $canonical === $path ) {
		return;
	}
	$destination = home_url( $canonical );
	if ( ! empty( $request['query'] ) ) {
		$destination .= '?' . $request['query'];
	}
	if ( wp_safe_redirect( $destination, 301, 'Insightistic' ) ) {
		exit;
	}
}
add_action( 'template_redirect', 'insightistic_commercial_redirect', -20 );

/**
 * robots.txt policy: AI answer engines and model training are welcome.
 *
 * Mirrors the WordPressistic policy. The Content-Signal line (Cloudflare's
 * Content Signals and Preferences vocabulary) states the site-wide preference;
 * the explicit per-agent Allow blocks document intent and keep the site
 * crawlable by name even if a blanket rule is added later. Any Content-Signal
 * line already present in the output (including edge-injected ones) is
 * replaced with the canonical signal so crawlers never see conflicting values.
 */
function insightistic_commercial_robots_policy() {
	return array(
		'Content-Signal: search=yes, ai-train=yes, ai-input=yes',
		'GPTBot', 'OAI-SearchBot', 'ChatGPT-User', 'ClaudeBot', 'Claude-Web',
		'Claude-SearchBot', 'anthropic-ai', 'PerplexityBot', 'Perplexity-User',
		'Google-Extended', 'Applebot', 'Applebot-Extended', 'Amazonbot',
		'meta-externalagent', 'meta-webindexer', 'Bytespider', 'Diffbot',
		'YouBot', 'cohere-ai', 'CCBot', 'AhrefsBot', 'SemrushBot',
	);
}

add_filter(
	'robots_txt',
	static function ( $output, $public ) {
		if ( ! $public ) {
			return $output;
		}
		$policy = insightistic_commercial_robots_policy();
		$signal = array_shift( $policy );

		// Drop every existing Content-Signal line (any variant) so exactly one
		// authoritative signal remains.
		$lines = array_values(
			array_filter(
				explode( "\n", $output ),
				static function ( $line ) {
					return 0 !== stripos( trim( $line ), 'Content-Signal:' );
				}
			)
		);

		// Insert the per-agent Allow blocks before the first Sitemap line so
		// the sitemap announcements stay last.
		$agent_lines = array();
		foreach ( $policy as $agent ) {
			$agent_lines[] = "User-agent: {$agent}";
			$agent_lines[] = 'Allow: /';
		}
		$insert_at = count( $lines );
		foreach ( $lines as $index => $line ) {
			if ( 0 === stripos( trim( $line ), 'Sitemap:' ) ) {
				$insert_at = $index;
				break;
			}
		}
		array_splice( $lines, $insert_at, 0, $agent_lines );
		$lines[] = $signal;

		return implode( "\n", $lines );
	},
	PHP_INT_MAX,
	2
);

/** The template supplies the H1 on these two pages. Preserve headings in the editor. */
add_filter(
	'the_content',
	static function ( $content ) {
		if ( is_admin() || (int) get_the_ID() !== get_queried_object_id() ) {
			return $content;
		}
		if ( is_page( 'insightistic-ai-business-intelligence' ) || ( is_single() && 'insightistic-4-4-2-ga4-that-survives-change-and-the-tests-to-prove-it' === ( get_queried_object()->post_name ?? '' ) ) ) {
			$content = preg_replace( '~<(\/?)h1(?=[\s>])~i', '<$1h2', $content );
		}
		if ( is_page( 'insightistic-ai-business-intelligence' ) ) {
			$content .= '<p><a class="ins-btn ins-btn--brand" data-appsumo-placement="product_overview" href="https://appsumo.com/pl/insightistic-ai-business-intelligence-w/">'
				. esc_html__( 'View the Insightistic lifetime deal on AppSumo', 'insightistic-marketing' ) . '</a></p>';
		}
		if ( is_page( 'pricing' ) ) {
			$content = preg_replace( '~\bPro(?=(?:</(?:strong|b|em)>)*\s*(?:–|&ndash;|&#8211;|-)\s*Deeper insights)~u', 'Growth', $content );
		}
		return $content;
	},
	30
);

/** Attach click tracking directly to the approved campaign buttons. */
function insightistic_commercial_track_purchase_links( $html ) {
	$deal = 'https://appsumo.com/pl/insightistic-ai-business-intelligence-w/';
	if ( ! str_contains( $html, $deal ) || ! class_exists( 'WP_HTML_Tag_Processor' ) ) {
		return $html;
	}
	$handler = "window.dataLayer=window.dataLayer||[];window.dataLayer.push({event:'appsumo_deal_click',page_path:location.pathname,placement:this.dataset.appsumoPlacement||'tier_card',tier:this.closest('[data-appsumo-tier]')?.dataset.appsumoTier||'',device_category:matchMedia('(max-width: 767px)').matches?'mobile':'desktop'});";
	$tags = new WP_HTML_Tag_Processor( $html );
	while ( $tags->next_tag( array( 'tag_name' => 'A' ) ) ) {
		if ( $deal === $tags->get_attribute( 'href' ) && ( 'ins-btn ins-btn--brand ins-btn--block' === $tags->get_attribute( 'class' ) || $tags->get_attribute( 'data-appsumo-placement' ) ) ) {
			$tags->set_attribute( 'onclick', $handler );
		}
	}
	return $tags->get_updated_html();
}
add_action(
	'template_redirect',
	static function () {
		if ( is_front_page() || is_page( array( 'ltd', 'insightistic-ai-business-intelligence' ) ) ) {
			ob_start( 'insightistic_commercial_track_purchase_links' );
		}
	},
	-10
);

/** Tell caches that the root has both HTML and Markdown representations. */
add_filter(
	'wp_headers',
	static function ( $headers ) {
		if ( is_front_page() ) {
			$vary = array_filter( array_map( 'trim', explode( ',', $headers['Vary'] ?? '' ) ) );
			if ( ! in_array( 'accept', array_map( 'strtolower', $vary ), true ) ) {
				$vary[] = 'Accept';
			}
			$headers['Vary'] = implode( ', ', $vary );
		}
		return $headers;
	},
	20
);
