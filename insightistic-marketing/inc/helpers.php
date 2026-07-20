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
 * Safely join the app base with a path. Always run through esc_url() on output.
 *
 * @param string $path e.g. '/login' or '/register?plan=pro'.
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
 * Pricing plans. Prices are display strings so they can be edited freely.
 */
function insightistic_pricing_plans() {
	$plans = array(
		array(
			'slug'      => 'starter',
			'name'      => 'Starter',
			'tagline'   => 'For small WooCommerce stores finding their footing.',
			'monthly'   => '$19',
			'yearly'    => '$15',
			'features'  => array( '1 connected store', 'Revenue & order analytics', 'Weekly AI summary', 'Email reports', '7-day free trial' ),
			'featured'  => false,
		),
		array(
			'slug'      => 'pro',
			'name'      => 'Pro',
			'tagline'   => 'For growing WooCommerce businesses that want answers.',
			'monthly'   => '$49',
			'yearly'    => '$39',
			'features'  => array( 'Up to 3 stores', 'Full AI business insights', 'Branded PDF reports', 'Product & customer intelligence', 'Priority support' ),
			'featured'  => true,
		),
		array(
			'slug'      => 'agency',
			'name'      => 'Agency',
			'tagline'   => 'For agencies managing multiple client stores.',
			'monthly'   => '$129',
			'yearly'    => '$99',
			'features'  => array( 'Unlimited stores', 'White-label dashboard & domain', 'Client viewer access', 'Team roles', 'All Pro features' ),
			'featured'  => false,
		),
	);

	return apply_filters( 'insightistic_pricing_plans', $plans );
}

/** Feature cards shown on the homepage + features page. */
function insightistic_features() {
	$features = array(
		array( 'icon' => 'trending-up', 'title' => 'Revenue analytics', 'text' => 'Revenue, orders, AOV and refunds — calculated daily and ready the moment you log in.' ),
		array( 'icon' => 'sparkles', 'title' => 'AI business insights', 'text' => 'Plain-language explanations of what changed, why it matters, and what to do next.' ),
		array( 'icon' => 'package', 'title' => 'Product intelligence', 'text' => 'Spot winners, slow movers, low stock and high-refund SKUs at a glance.' ),
		array( 'icon' => 'users', 'title' => 'Customer insights', 'text' => 'New vs returning, at-risk segments and lifetime value across every store.' ),
		array( 'icon' => 'file-text', 'title' => 'Branded reports', 'text' => 'Automated weekly and monthly PDF reports delivered to you and your clients.' ),
		array( 'icon' => 'globe', 'title' => 'White-label workspace', 'text' => 'Your logo, your colors, your domain — a branded analytics product to resell.' ),
		array( 'icon' => 'plug', 'title' => 'WordPress connector', 'text' => 'A secure plugin syncs orders, products and customers — no card data ever leaves your store.' ),
		array( 'icon' => 'activity', 'title' => 'Site health & sync logs', 'text' => 'Connector heartbeat, sync status and data integrity, monitored continuously.' ),
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
		array( 'q' => 'Do you offer a free trial?', 'a' => 'Yes — every plan starts with a 7-day free trial, no credit card required. Start at app.insightistic.com/register.' ),
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
