<?php
/**
 * Helpers — app routing, Formistic integration, and editable content data.
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Read a theme option (Customizer / settings page) with a default.
 */
function insightistic_option( $key, $default = '' ) {
	$value = get_theme_mod( $key, null );
	if ( null === $value || '' === $value ) {
		return $default;
	}
	return $value;
}

/** Base URL of the SaaS app. */
function insightistic_app_base() {
	return untrailingslashit( insightistic_option( 'insightistic_app_url', 'https://app.insightistic.com' ) );
}

/** Base URL of the marketing site (self), used in schema/canonical fallbacks. */
function insightistic_marketing_base() {
	return untrailingslashit( insightistic_option( 'insightistic_marketing_url', home_url( '/' ) ) );
}

/** Base URL of the Laravel API (informational; never embeds secrets). */
function insightistic_api_url() {
	return untrailingslashit( insightistic_option( 'insightistic_api_url', 'https://api.insightistic.com' ) );
}

/**
 * Theme asset URL with a file-based cache buster.
 *
 * @param string $relative_path Path relative to the theme root.
 * @return string
 */
function insightistic_asset_url( $relative_path ) {
	$relative_path = ltrim( (string) $relative_path, '/' );
	$url           = INSIGHTISTIC_URI . '/' . $relative_path;
	$file          = INSIGHTISTIC_DIR . '/' . $relative_path;
	$version       = defined( 'INSIGHTISTIC_MARKETING_VERSION' ) ? INSIGHTISTIC_MARKETING_VERSION : '1';

	if ( is_readable( $file ) ) {
		$mtime = filemtime( $file );
		if ( $mtime ) {
			$version = (string) $mtime;
		}
	}

	return add_query_arg( 'v', $version, $url );
}

/**
 * Safely join the app base with a path. Always run through esc_url() on output.
 *
 * @param string $path e.g. '/login' or '/register?plan=growth'.
 */
function insightistic_get_app_url( $path = '' ) {
	$path = (string) $path;
	if ( '' === $path ) {
		return insightistic_app_base();
	}
	return insightistic_app_base() . '/' . ltrim( $path, '/' );
}

function insightistic_login_url() {
	return insightistic_get_app_url( '/login' );
}

function insightistic_register_url( $plan = '' ) {
	$path = '/register';
	if ( $plan ) {
		$path .= '?plan=' . rawurlencode( $plan );
	}
	return insightistic_get_app_url( $path );
}

function insightistic_dashboard_url() {
	return insightistic_get_app_url( '/dashboard' );
}

/* -------------------------------------------------------------------------
 * Formistic integration (contact / newsletter / lead forms)
 *
 * Formistic v2.0.5 registers three real shortcodes — not the
 * `[formistic_form]` this theme used to call, which has never existed:
 *   - wpistic_contact_form        ready-made contact form, no id needed
 *   - wpistic_formistic_newsletter  email capture, no id needed
 *   - wpistic_form id="N"         a custom builder form (formistic_form CPT)
 * 'contact' and 'newsletter' always use the two fixed shortcodes above.
 * Every other logical slug is a custom builder form, configured in the
 * Customizer as a dropdown of real Formistic forms (not free-text) that
 * resolves to a validated numeric post ID.
 * ---------------------------------------------------------------------- */

/** Is the Formistic plugin active at all? */
function insightistic_formistic_active() {
	return class_exists( 'Wpistic_Formistic' ) || shortcode_exists( 'wpistic_contact_form' );
}

/**
 * Resolve a Customizer-configured builder-form slug to a real, safe post ID.
 * Returns null unless the post exists, is published, and is a formistic_form.
 *
 * @param string $slug Logical form slug (e.g. 'agency', 'ltd').
 */
function insightistic_formistic_builder_form_id( $slug ) {
	$form_id = (int) insightistic_option( 'insightistic_form_' . $slug, 0 );

	if ( $form_id <= 0 ) {
		return null;
	}
	if ( 'formistic_form' !== get_post_type( $form_id ) ) {
		return null;
	}
	if ( 'publish' !== get_post_status( $form_id ) ) {
		return null;
	}

	return $form_id;
}

/**
 * Render a Formistic form by logical slug, with safe, honest fallbacks.
 * Never shows visitors a technical error — only current_user_can()
 * admins see the setup instructions; everyone else sees nothing or a
 * neutral message, never raw shortcode/plugin diagnostics.
 *
 * @param string $slug  Logical form slug: 'contact', 'newsletter', or a
 *                       Customizer-configured builder-form slug.
 * @param string $title Optional heading rendered above the form.
 */
function insightistic_formistic_form( $slug, $title = '' ) {
	echo '<div class="ins-form ins-form--' . esc_attr( $slug ) . '">';

	if ( $title ) {
		echo '<h3 class="ins-form__title">' . esc_html( $title ) . '</h3>';
	}

	if ( ! insightistic_formistic_active() ) {
		insightistic_formistic_missing_notice(
			__( 'Formistic is required to display this form. Install and activate the Formistic plugin.', 'insightistic-marketing' )
		);
		echo '</div>';
		return;
	}

	if ( 'contact' === $slug && shortcode_exists( 'wpistic_contact_form' ) ) {
		echo do_shortcode( '[wpistic_contact_form]' );
	} elseif ( 'newsletter' === $slug && shortcode_exists( 'wpistic_formistic_newsletter' ) ) {
		echo do_shortcode( '[wpistic_formistic_newsletter]' );
	} elseif ( shortcode_exists( 'wpistic_form' ) ) {
		$form_id = insightistic_formistic_builder_form_id( $slug );
		if ( $form_id ) {
			echo do_shortcode( '[wpistic_form id="' . absint( $form_id ) . '"]' );
		} else {
			/* translators: %s: form slug shown only to logged-in admins. */
			insightistic_formistic_missing_notice(
				sprintf( __( 'No published Formistic form is set for "%s". Choose one in Appearance → Customize → Forms.', 'insightistic-marketing' ), $slug )
			);
		}
	} else {
		insightistic_formistic_missing_notice(
			__( 'Formistic is active, but the required shortcode is unavailable. Update the Formistic plugin.', 'insightistic-marketing' )
		);
	}

	echo '</div>';
}

/**
 * Show the technical reason to admins only; visitors get nothing rendered
 * (the surrounding page copy/CTA still stands, so no dead-looking gap).
 */
function insightistic_formistic_missing_notice( $admin_message ) {
	if ( current_user_can( 'edit_theme_options' ) ) {
		echo '<p class="ins-form__fallback">' . esc_html( $admin_message ) . '</p>';
	}
}

/**
 * Formistic forms available for the Customizer's builder-form dropdowns.
 * Cached for the request; invalidated implicitly since Customizer preview
 * always runs uncached and the admin list only needs to be fresh there.
 *
 * @return array<int,string> post ID => title.
 */
function insightistic_formistic_available_forms() {
	if ( ! post_type_exists( 'formistic_form' ) ) {
		return array();
	}

	$posts = get_posts( array(
		'post_type'      => 'formistic_form',
		'post_status'    => 'publish',
		'posts_per_page' => 100,
		'orderby'        => 'title',
		'order'          => 'ASC',
	) );

	$choices = array();
	foreach ( $posts as $post ) {
		$choices[ $post->ID ] = $post->post_title ? $post->post_title : ( '#' . $post->ID );
	}

	return $choices;
}

/* -------------------------------------------------------------------------
 * Editable content data (filterable so a child theme / snippet can override)
 * ---------------------------------------------------------------------- */

/**
 * The public catalog is read-only from the application. The website accepts
 * only the complete published contract and fails closed to an audited
 * application snapshot when the API is unavailable or incomplete.
 */
function insightistic_public_catalog() {
	$cache_key = 'insightistic_public_catalog_v4';
	$cached    = get_transient( $cache_key );
	if ( is_array( $cached ) && ! empty( $cached['plans'] ) ) {
		return apply_filters( 'insightistic_public_catalog', $cached );
	}

	$catalog = insightistic_fetch_public_catalog_from_api();
	if ( empty( $catalog ) ) {
		$catalog = insightistic_public_catalog_fallback();
	}

	set_transient( $cache_key, $catalog, 5 * MINUTE_IN_SECONDS );
	return apply_filters( 'insightistic_public_catalog', $catalog );
}

/** Keep the legacy helper available to existing child themes and plugins. */
function insightistic_pricing_plans() {
	$catalog = insightistic_public_catalog();
	return apply_filters( 'insightistic_pricing_plans', (array) $catalog['plans'] );
}

/**
 * Fetch the complete public catalog. A 200 response is not enough: incomplete
 * payloads fail closed so an older API deployment cannot publish wrong limits.
 *
 * @return array|null
 */
function insightistic_fetch_public_catalog_from_api() {
	$response = wp_remote_get(
		insightistic_api_url() . '/api/public/plans',
		array(
			'timeout' => 3,
			'headers' => array( 'Accept' => 'application/json' ),
		)
	);
	if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
		return null;
	}

	$body = json_decode( wp_remote_retrieve_body( $response ), true );
	foreach ( array( 'catalog_version', 'trial_days', 'plans', 'ltd', 'credit_packs', 'ai_action_costs' ) as $key ) {
		if ( ! is_array( $body ) || ! array_key_exists( $key, $body ) ) {
			return null;
		}
	}
	if ( ! is_array( $body['plans'] ) || ! is_array( $body['ltd'] ) ) {
		return null;
	}
	if ( ! is_array( $body['ltd']['campaign'] ?? null ) || ! array_key_exists( 'state', $body['ltd']['campaign'] ) || ! array_key_exists( 'maximum_sales', $body['ltd']['campaign'] ) || ! array_key_exists( 'sold_out', $body['ltd']['campaign'] ) ) {
		return null;
	}

	$paid    = array();
	$free    = null;
	$expected = array( 'starter', 'growth', 'agency', 'agency_pro' );
	foreach ( (array) $body['plans'] as $api_plan ) {
		if ( ! insightistic_public_plan_payload_is_complete( $api_plan ) ) {
			return null;
		}
		$mapped = insightistic_map_api_plan( $api_plan );
		if ( 'free' === $mapped['slug'] ) {
			$free = $mapped;
		} elseif ( in_array( $mapped['slug'], $expected, true ) ) {
			if ( empty( $api_plan['is_purchasable'] ) ) {
				return null;
			}
			$paid[ $mapped['slug'] ] = $mapped;
		}
	}
	if ( null === $free || count( $paid ) !== count( $expected ) ) {
		return null;
	}

	$ltd_plans = array();
	foreach ( (array) ( $body['ltd']['plans'] ?? array() ) as $api_ltd ) {
		if ( empty( $api_ltd['slug'] ) || empty( $api_ltd['name'] ) || ! isset( $api_ltd['price'], $api_ltd['sites'], $api_ltd['team_seats'], $api_ltd['monthly_ai_credits'], $api_ltd['features'], $api_ltd['limits'] ) ) {
			return null;
		}
		foreach ( array( 'crawl_pages_monthly', 'browser_rendering_minutes_monthly', 'tracked_keywords', 'standard_ai_requests_monthly', 'client_ready_reports_monthly' ) as $key ) {
			if ( ! array_key_exists( $key, (array) $api_ltd['limits'] ) ) {
				return null;
			}
		}
		$ltd_plans[] = insightistic_map_api_ltd_plan( $api_ltd );
	}
	if ( 3 !== count( $ltd_plans ) ) {
		return null;
	}

	if ( ! insightistic_public_credit_packs_are_complete( $body['credit_packs'] ) || ! insightistic_public_ai_costs_are_complete( $body['ai_action_costs'] ) ) {
		return null;
	}

	$ordered_paid = array();
	foreach ( $expected as $slug ) {
		if ( isset( $paid[ $slug ] ) ) {
			$ordered_paid[] = $paid[ $slug ];
		}
	}
	return array(
		'version' => sanitize_text_field( (string) $body['catalog_version'] ),
		'trial_days' => absint( $body['trial_days'] ),
		'plans' => $ordered_paid,
		'free' => $free,
		'ltd' => array( 'campaign' => is_array( $body['ltd']['campaign'] ?? null ) ? $body['ltd']['campaign'] : array(), 'plans' => $ltd_plans ),
		'credit_packs' => (array) $body['credit_packs'],
		'ai_action_costs' => (array) $body['ai_action_costs'],
		'source' => 'api',
	);
}

/** @param mixed $packs */
function insightistic_public_credit_packs_are_complete( $packs ) {
	if ( ! is_array( $packs ) || count( $packs ) < 3 ) {
		return false;
	}

	foreach ( $packs as $pack ) {
		if ( ! is_array( $pack ) || empty( $pack['slug'] ) || ! isset( $pack['credits'], $pack['price_minor'] ) || ! is_numeric( $pack['credits'] ) || ! is_numeric( $pack['price_minor'] ) || (int) $pack['credits'] <= 0 || (int) $pack['price_minor'] < 0 ) {
			return false;
		}
	}

	return true;
}

/** @param mixed $costs */
function insightistic_public_ai_costs_are_complete( $costs ) {
	$required = array( 'basic_wordpress_dashboard_insight', 'seo_opportunity_analysis', 'woocommerce_business_analysis', 'advanced_multi_source_ai_report', 'comprehensive_ai_business_audit' );
	if ( ! is_array( $costs ) ) {
		return false;
	}

	foreach ( $required as $key ) {
		if ( ! array_key_exists( $key, $costs ) || ! is_numeric( $costs[ $key ] ) || (int) $costs[ $key ] < 0 ) {
			return false;
		}
	}

	return true;
}

/** @param mixed $api_plan */
function insightistic_public_plan_payload_is_complete( $api_plan ) {
	foreach ( array( 'slug', 'name', 'price_monthly', 'price_yearly', 'site_limit', 'user_limit', 'features', 'limits', 'is_featured', 'is_purchasable' ) as $key ) {
		if ( ! is_array( $api_plan ) || ! array_key_exists( $key, $api_plan ) ) {
			return false;
		}
	}
	foreach ( array( 'http_crawl_pages_monthly', 'browser_rendering_minutes_monthly', 'tracked_keywords', 'standard_ai_requests_monthly', 'monthly_ai_credits', 'client_ready_reports_monthly' ) as $key ) {
		if ( ! array_key_exists( $key, (array) $api_plan['limits'] ) ) {
			return false;
		}
	}
	return true;
}

/** Map one public API plan into the shape the theme renders. */
function insightistic_map_api_plan( $api_plan ) {
	$slug     = isset( $api_plan['slug'] ) ? sanitize_key( (string) $api_plan['slug'] ) : '';
	$features = array_map( 'insightistic_plan_feature_label', (array) ( $api_plan['features'] ?? array() ) );
	$limits   = (array) ( $api_plan['limits'] ?? array() );
	return array(
		'slug' => $slug,
		'name' => isset( $api_plan['name'] ) ? (string) $api_plan['name'] : ucfirst( $slug ),
		'tagline' => insightistic_plan_tagline( $slug ),
		'monthly' => insightistic_format_plan_price( $api_plan['price_monthly'] ?? 0 ),
		'yearly' => insightistic_format_plan_price( $api_plan['price_yearly'] ?? 0 ),
		'features' => array_values( array_unique( $features ) ),
		'featured' => ! empty( $api_plan['is_featured'] ),
		'limits' => array(
			'sites' => absint( $api_plan['site_limit'] ?? 0 ),
			'team_seats' => absint( $api_plan['user_limit'] ?? 0 ),
			'crawl_pages' => absint( $limits['http_crawl_pages_monthly'] ?? 0 ),
			'browser_minutes' => absint( $limits['browser_rendering_minutes_monthly'] ?? 0 ),
			'keywords' => absint( $limits['tracked_keywords'] ?? 0 ),
			'ai_requests' => absint( $limits['standard_ai_requests_monthly'] ?? 0 ),
			'ai_credits' => absint( $limits['monthly_ai_credits'] ?? 0 ),
			'reports' => absint( $limits['client_ready_reports_monthly'] ?? 0 ),
		),
	);
}

function insightistic_map_api_ltd_plan( $api_plan ) {
	$limits = (array) $api_plan['limits'];
	return array(
		'slug' => sanitize_key( (string) $api_plan['slug'] ),
		'name' => sanitize_text_field( (string) $api_plan['name'] ),
		'price' => '$' . number_format_i18n( absint( $api_plan['price'] ) ),
		'featured' => 'angel_studio' === sanitize_key( (string) $api_plan['slug'] ),
		'sites' => absint( $api_plan['sites'] ),
		'team_seats' => absint( $api_plan['team_seats'] ),
		'monthly_ai_credits' => absint( $api_plan['monthly_ai_credits'] ?? 0 ),
		'features' => array_values( array_unique( array_map( 'insightistic_plan_feature_label', (array) ( $api_plan['features'] ?? array() ) ) ) ),
		'limits' => array(
			'crawl_pages' => absint( $limits['crawl_pages_monthly'] ?? 0 ),
			'browser_minutes' => absint( $limits['browser_rendering_minutes_monthly'] ?? 0 ),
			'keywords' => absint( $limits['tracked_keywords'] ?? 0 ),
			'ai_requests' => absint( $limits['standard_ai_requests_monthly'] ?? 0 ),
			'reports' => absint( $limits['client_ready_reports_monthly'] ?? 0 ),
		),
	);
}

/** Cents (int) -> whole-dollar display string, matching the theme's existing "$19" style. */
function insightistic_format_plan_price( $cents ) {
	return '$' . number_format_i18n( round( ( (int) $cents ) / 100 ) );
}

/**
 * Marketing taglines are copy, not entitlements — they stay theme-owned even
 * though price/limits/features now come from the API. Unknown slugs (a new
 * plan added in Admin that this theme hasn't been told about yet) get a
 * generic tagline rather than a blank one.
 */
function insightistic_plan_tagline( $slug ) {
	$taglines = apply_filters(
		'insightistic_plan_taglines',
		array(
			'starter' => 'For small WooCommerce stores finding their footing.',
			'growth'  => 'For growing WooCommerce businesses that want answers.',
			'agency'  => 'For agencies managing multiple client stores.',
			'agency_pro' => 'For established agencies that need more room to scale.',
		)
	);

	return $taglines[ $slug ] ?? 'Everything you need to understand your business.';
}

/** Feature slug (LicenseService::FEATURES) -> human-readable bullet text. */
function insightistic_plan_feature_label( $slug ) {
	$labels = apply_filters(
		'insightistic_plan_feature_labels',
		array(
			'basic_analytics'       => 'Revenue & order analytics',
			'traffic_analytics'     => 'Traffic analytics',
			'seo_analytics'         => 'SEO analytics',
			'seo_analysis'          => 'SEO analytics',
			'email_audit_automation' => 'Email audit automation',
			'performance_tracking'  => 'Site performance tracking',
			'woocommerce_analytics' => 'Full WooCommerce analytics',
			'engagement_analytics'  => 'Engagement analytics',
			'ai_insights'           => 'AI business insights',
			'ai_copilot'            => 'AI copilot',
			'advanced_reports'      => 'Branded PDF reports',
			'scheduled_reports'     => 'Scheduled report delivery',
			'alerts'                => 'Automated alerts',
			'data_export'           => 'CSV data export',
			'multi_site'            => 'Multiple connected stores',
			'team_access'           => 'Team roles & access',
			'agency_white_label'    => 'White-label reporting',
			'white_label_reports'   => 'White-label reports',
			'white_label_dashboard' => 'White-label dashboard',
			'custom_domain'         => 'Custom branded dashboard domain',
			'api_access'            => 'API access',
		)
	);

	return $labels[ $slug ] ?? ucwords( str_replace( '_', ' ', $slug ) );
}

/** Audited fallback mirrors insightistic-api/config/commercial.php 2026-10-14. */
function insightistic_public_catalog_fallback() {
	return array(
		'version' => '2026-10-14',
		'trial_days' => 14,
		'free' => array(
			'slug' => 'free', 'name' => 'Free Connected', 'tagline' => 'Start with the free plugin and one connected site.',
			'monthly' => '$0', 'yearly' => '$0', 'featured' => false,
			'features' => array( 'Basic connected-cloud access', '10 basic AI insights per month', '1,000 AI credits per month' ),
			'limits' => array( 'sites' => 1, 'team_seats' => 1, 'crawl_pages' => 0, 'browser_minutes' => 0, 'keywords' => 0, 'ai_requests' => 10, 'ai_credits' => 1000, 'reports' => 0 ),
		),
		'plans' => array(
			array( 'slug' => 'starter', 'name' => 'Starter', 'tagline' => 'For small WooCommerce stores finding their footing.', 'monthly' => '$29', 'yearly' => '$290', 'features' => array( 'Revenue & order analytics', 'SEO analytics', 'AI business insights', '1 connected site' ), 'featured' => false, 'limits' => array( 'sites' => 1, 'team_seats' => 1, 'crawl_pages' => 20000, 'browser_minutes' => 30, 'keywords' => 150, 'ai_requests' => 50, 'ai_credits' => 5000, 'reports' => 10 ) ),
			array( 'slug' => 'growth', 'name' => 'Growth', 'tagline' => 'For growing WooCommerce businesses that want answers.', 'monthly' => '$69', 'yearly' => '$690', 'features' => array( 'Full cloud WooCommerce analytics', 'Advanced email audit automation', 'Branded PDF reports', 'Scheduled reports', '3 connected sites' ), 'featured' => true, 'limits' => array( 'sites' => 3, 'team_seats' => 3, 'crawl_pages' => 80000, 'browser_minutes' => 120, 'keywords' => 500, 'ai_requests' => 200, 'ai_credits' => 15000, 'reports' => 40 ) ),
			array( 'slug' => 'agency', 'name' => 'Agency', 'tagline' => 'For agencies managing multiple client stores.', 'monthly' => '$149', 'yearly' => '$1,490', 'features' => array( 'Agency white-label reporting', 'White-label dashboard', 'Advanced team access', 'Priority support', '10 connected sites' ), 'featured' => false, 'limits' => array( 'sites' => 10, 'team_seats' => 10, 'crawl_pages' => 250000, 'browser_minutes' => 300, 'keywords' => 1500, 'ai_requests' => 600, 'ai_credits' => 40000, 'reports' => 150 ) ),
			array( 'slug' => 'agency_pro', 'name' => 'Agency Pro', 'tagline' => 'For established agencies that need more room to scale.', 'monthly' => '$299', 'yearly' => '$2,990', 'features' => array( 'Custom branded dashboard domain', 'Higher usage allowances', 'Larger agency portfolio', 'Expanded team capacity', '30 connected sites' ), 'featured' => false, 'limits' => array( 'sites' => 30, 'team_seats' => 25, 'crawl_pages' => 600000, 'browser_minutes' => 600, 'keywords' => 5000, 'ai_requests' => 1500, 'ai_credits' => 100000, 'reports' => 500 ) ),
		),
		'ltd' => array(
			'campaign' => array( 'state' => 'unknown', 'sold_out' => false, 'maximum_sales' => 100 ),
			'plans' => array(
				array( 'slug' => 'angel_solo', 'name' => 'Angel Solo', 'price' => '$149', 'sites' => 3, 'team_seats' => 1, 'monthly_ai_credits' => 3000, 'features' => array( 'Core business analytics', 'SEO analytics', 'AI business insights', '3 connected sites' ), 'limits' => array( 'crawl_pages' => 10000, 'browser_minutes' => 15, 'keywords' => 150, 'ai_requests' => 25, 'reports' => 5 ) ),
				array( 'slug' => 'angel_studio', 'name' => 'Angel Studio', 'price' => '$299', 'sites' => 7, 'team_seats' => 3, 'monthly_ai_credits' => 8000, 'features' => array( 'Full cloud WooCommerce analytics', 'Advanced email audit automation', 'Branded reports', 'Scheduled reports', 'White-label reports' ), 'limits' => array( 'crawl_pages' => 40000, 'browser_minutes' => 60, 'keywords' => 500, 'ai_requests' => 100, 'reports' => 25 ), 'featured' => true ),
				array( 'slug' => 'angel_agency', 'name' => 'Angel Agency', 'price' => '$699', 'sites' => 15, 'team_seats' => 10, 'monthly_ai_credits' => 20000, 'features' => array( 'White-label dashboard', 'Custom branded domain', 'Advanced team roles', '15 connected sites' ), 'limits' => array( 'crawl_pages' => 100000, 'browser_minutes' => 180, 'keywords' => 1500, 'ai_requests' => 250, 'reports' => 100 ) ),
			),
		),
		'credit_packs' => array( array( 'slug' => 'credits_5000', 'credits' => 5000, 'price_minor' => 1500 ), array( 'slug' => 'credits_20000', 'credits' => 20000, 'price_minor' => 4900 ), array( 'slug' => 'credits_50000', 'credits' => 50000, 'price_minor' => 9900 ) ),
		'ai_action_costs' => array( 'basic_wordpress_dashboard_insight' => 100, 'seo_opportunity_analysis' => 200, 'woocommerce_business_analysis' => 300, 'advanced_multi_source_ai_report' => 500, 'comprehensive_ai_business_audit' => 1000 ),
		'source' => 'catalog-fallback',
	);
}

/** Backwards-compatible name used by older child themes and documentation. */
function insightistic_pricing_plans_fallback() {
	$catalog = insightistic_public_catalog_fallback();
	return $catalog['plans'];
}

/** Feature cards shown on the homepage + features page. */
function insightistic_features() {
	$features = array(
		array( 'icon' => 'trending-up', 'title' => 'Revenue analytics', 'text' => 'Revenue, orders, AOV and refunds — calculated daily and ready the moment you log in.' ),
		array( 'icon' => 'sparkles', 'title' => 'AI business insights', 'text' => 'Plain-language explanations of what changed, why it matters, and what to do next.' ),
		array( 'icon' => 'package', 'title' => 'Product intelligence', 'text' => 'Spot winners, slow movers, low stock and high-refund SKUs at a glance.' ),
		array( 'icon' => 'users', 'title' => 'Customer insights', 'text' => 'New vs returning, at-risk segments and lifetime value across every store.' ),
		array( 'icon' => 'file-text', 'title' => 'Branded reports', 'text' => 'Automated weekly and monthly PDF reports delivered to you and your clients.' ),
		array( 'icon' => 'globe', 'title' => 'Agency intelligence', 'text' => 'Organise connected client sites, team access and white-label reporting on eligible agency plans.' ),
		array( 'icon' => 'plug', 'title' => 'WordPress connector', 'text' => 'A secure plugin syncs orders, products and customers — no card data ever leaves your store.' ),
		array( 'icon' => 'activity', 'title' => 'Performance & sync health', 'text' => 'Review site health, performance signals, connector status and sync evidence in one workspace.' ),
	);

	return apply_filters( 'insightistic_features', $features );
}

/** Homepage / FAQ page questions. */
function insightistic_faqs() {
	$faqs = array(
		array( 'q' => 'What is Insightistic?', 'a' => 'Insightistic is an AI-powered business analytics platform for WordPress and WooCommerce websites. It helps store owners, agencies and teams understand revenue, orders, products, customers and AI-powered business insights from one clean dashboard.' ),
		array( 'q' => 'Is Insightistic only for WooCommerce?', 'a' => 'Insightistic is focused on WooCommerce analytics and WordPress-powered businesses. WooCommerce stores get the most value because Insightistic can analyze revenue, orders, products, customers and refunds.' ),
		array( 'q' => 'How does a store connect?', 'a' => 'Already running the free Insightistic WordPress plugin? Create an account, paste the license key into Insightistic → License on your site, and it syncs automatically — no separate install. Not running that plugin? Add a site in the dashboard, copy the connector token, install the standalone Insightistic connector plugin, paste the API URL and token, connect, and run the first sync.' ),
		array( 'q' => 'Is my data secure?', 'a' => 'Yes. Every sync uses signed, secure communication and only sends the business analytics data needed. It does not collect or store customer payment card details.' ),
		array( 'q' => 'Can agencies use Insightistic?', 'a' => 'Yes. Agencies can manage multiple client stores, generate branded reports, monitor performance and provide client-facing dashboards with white-label options.' ),
		array( 'q' => 'Is there a free way to start?', 'a' => 'Yes. Install the free Insightistic WordPress plugin, connect a free Insightistic account and use the Free Connected tier for one cloud-connected site and 10 basic AI insights per month. It is a free tier, not a 14-day trial.' ),
		array( 'q' => 'How do paid trials and AI credits work?', 'a' => 'The current catalog lists a 14-day paid-plan trial. Paid plans include monthly AI credits and standard AI allowances; additional 5,000, 20,000 and 50,000 credit packs are available when the account needs more usage.' ),
	);

	return apply_filters( 'insightistic_faqs', $faqs );
}

/** Overview-style metric cards for the dashboard preview visual. */
function insightistic_preview_metrics() {
	return apply_filters( 'insightistic_preview_metrics', array(
		array( 'label' => 'Revenue', 'value' => '$48,920', 'delta' => '+12.4%' ),
		array( 'label' => 'Orders', 'value' => '1,284', 'delta' => '+8.1%' ),
		array( 'label' => 'New customers', 'value' => '612', 'delta' => '+18%' ),
		array( 'label' => 'AI health', 'value' => '86', 'delta' => '+4 pts' ),
	) );
}

/**
 * AppSumo lifetime-deal link.
 *
 * ONE place for the URL, with the standing per-platform link map: every CTA
 * carries its own platform token so AppSumo can attribute the sale. The website
 * slug (-w) is the default because that is where most CTAs live.
 *
 * Platforms: custom (short link code), w (website), ld (LinkedIn), x (X),
 * ne (newsletter), yo (YouTube), ti (TikTok), in (Instagram), po (podcast),
 * bl (blogs), rd (Reddit), qr (Quora), me (Medium).
 *
 * Override with the `insightistic_promo_url` filter rather than editing templates.
 *
 * @param string $platform One of the keys in the map; unknown keys fall back to -w.
 */
function insightistic_promo_url( string $platform = 'w' ): string {
	$map = array(
		'custom' => 'at3l106SYo',
		'w'      => '-w',
		'ld'     => '-ld',
		'x'      => '-x',
		'ne'     => '-ne',
		'yo'     => '-yo',
		'ti'     => '-ti',
		'in'     => '-in',
		'po'     => '-po',
		'bl'     => '-bl',
		'rd'     => '-rd',
		'qr'     => '-qr',
		'me'     => '-me',
	);

	$token = isset( $map[ $platform ] ) ? $map[ $platform ] : $map['w'];

	// Confirmed 2026-11-25 against the official AppSumo embed snippet Shuvo supplied:
	// the deal lives under /pl/. The custom short link is its own code, every
	// other platform appends its token to the product slug.
	$url = 'custom' === $platform
		? 'https://appsumo.com/pl/' . $token . '/'
		: 'https://appsumo.com/pl/insightistic-ai-business-intelligence' . $token . '/';

	return (string) apply_filters( 'insightistic_promo_url', $url, $platform );
}

/**
 * When the AppSumo deal closes (hard date, CST).
 *
 * Precedence: the JOLLY_PROMO_END constant (wp-config) wins, then the
 * jolly_promo_end theme mod, then this default - the date Shuvo set for the
 * current deal (4 Dec 2026, 4:00 PM US Central). Returning an empty string
 * switches the bar back to its per-visitor evergreen window.
 */
function insightistic_promo_end() {
	if ( defined( 'JOLLY_PROMO_END' ) ) {
		return (string) JOLLY_PROMO_END;
	}

	$mod = (string) get_theme_mod( 'jolly_promo_end', '' );

	if ( '' !== trim( $mod ) ) {
		return trim( $mod );
	}

	return '2026-12-04T16:00:00-06:00';
}
