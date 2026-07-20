<?php
/**
 * Idempotent Formistic form provisioning (spec §16.3).
 *
 * The theme's four builder-form Customizer slots ('agency', 'ltd',
 * 'early_access', 'support' — see customizer.php) previously required an
 * admin to manually build each form in Formistic and pick it from a
 * dropdown before any of those areas would render. This auto-creates all
 * four the first time both this theme and Formistic are active, using
 * Formistic's generic Wpistic_Formistic_Forms::ensure_form() (which itself
 * guarantees no duplicate is ever created for the same identifier — see
 * that method's own docblock). A Customizer slot is only ever filled in
 * when it's empty; an admin's manual choice is never overwritten.
 *
 * 'contact' and 'newsletter' are deliberately excluded — they render via
 * Formistic's fixed wpistic_contact_form / wpistic_formistic_newsletter
 * shortcodes (see insightistic_formistic_form() in helpers.php) and were
 * never built with the CPT builder in the first place.
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The four form specs, in the theme's own vocabulary — Formistic's
 * ensure_form() doesn't know or care what "agency inquiry" means; that
 * meaning lives entirely here.
 *
 * @return array<string,array> slug => { title, fields, settings }.
 */
function insightistic_formistic_form_definitions() {
	$defs = array(
		'agency'       => array(
			'title'  => __( 'Agency Inquiry', 'insightistic-marketing' ),
			'fields' => array(
				array( 'label' => __( 'Agency name', 'insightistic-marketing' ), 'type' => 'text', 'required' => true ),
				array( 'label' => __( 'Work email', 'insightistic-marketing' ), 'type' => 'email', 'required' => true ),
				array(
					'label'   => __( 'Client stores managed', 'insightistic-marketing' ),
					'type'    => 'select',
					'options' => implode( "\n", array( '1-5', '6-20', '21-50', '50+' ) ),
				),
				array( 'label' => __( 'Website', 'insightistic-marketing' ), 'type' => 'url' ),
				array( 'label' => __( 'Tell us about your agency', 'insightistic-marketing' ), 'type' => 'textarea' ),
			),
			'settings' => array(
				'submit_label' => __( 'Request agency demo', 'insightistic-marketing' ),
				'success'      => __( "Thanks — we'll reach out within one business day to set up your agency demo.", 'insightistic-marketing' ),
			),
		),
		'ltd'          => array(
			'title'  => __( 'Lifetime Deal Signup', 'insightistic-marketing' ),
			'fields' => array(
				array( 'label' => __( 'Full name', 'insightistic-marketing' ), 'type' => 'text', 'required' => true ),
				array( 'label' => __( 'Email', 'insightistic-marketing' ), 'type' => 'email', 'required' => true ),
				array( 'label' => __( 'Store URL', 'insightistic-marketing' ), 'type' => 'url', 'required' => true ),
				array(
					'label'   => __( 'How many stores do you manage?', 'insightistic-marketing' ),
					'type'    => 'select',
					'options' => implode( "\n", array( '1', '2-5', '6+' ) ),
				),
			),
			'settings' => array(
				'submit_label' => __( 'Claim my lifetime deal', 'insightistic-marketing' ),
				'success'      => __( "You're on the list — we'll email your lifetime deal redemption instructions shortly.", 'insightistic-marketing' ),
			),
		),
		'early_access' => array(
			'title'  => __( 'Early Access Waitlist', 'insightistic-marketing' ),
			'fields' => array(
				array( 'label' => __( 'Email', 'insightistic-marketing' ), 'type' => 'email', 'required' => true ),
				array( 'label' => __( 'Store URL', 'insightistic-marketing' ), 'type' => 'url' ),
				array(
					'label'   => __( "What are you most interested in?", 'insightistic-marketing' ),
					'type'    => 'checkbox_group',
					'options' => implode( "\n", array(
						__( 'Traffic analytics', 'insightistic-marketing' ),
						__( 'SEO analytics', 'insightistic-marketing' ),
						__( 'Performance tracking', 'insightistic-marketing' ),
						__( 'AI insights', 'insightistic-marketing' ),
					) ),
				),
			),
			'settings' => array(
				'submit_label' => __( 'Join the waitlist', 'insightistic-marketing' ),
				'success'      => __( "You're on the early access list — we'll email you as soon as a spot opens up.", 'insightistic-marketing' ),
			),
		),
		'support'      => array(
			'title'  => __( 'Support Request', 'insightistic-marketing' ),
			'fields' => array(
				array( 'label' => __( 'Name', 'insightistic-marketing' ), 'type' => 'text', 'required' => true ),
				array( 'label' => __( 'Email', 'insightistic-marketing' ), 'type' => 'email', 'required' => true ),
				array( 'label' => __( 'Account email (if different)', 'insightistic-marketing' ), 'type' => 'email' ),
				array( 'label' => __( 'Subject', 'insightistic-marketing' ), 'type' => 'text', 'required' => true ),
				array( 'label' => __( 'Describe the issue', 'insightistic-marketing' ), 'type' => 'textarea', 'required' => true ),
			),
			'settings' => array(
				'submit_label' => __( 'Send support request', 'insightistic-marketing' ),
				'success'      => __( "Thanks — our team will get back to you as soon as possible.", 'insightistic-marketing' ),
			),
		),
	);

	return apply_filters( 'insightistic_formistic_form_definitions', $defs );
}

/**
 * Provision any missing builder forms and fill any empty Customizer slot
 * they belong to. Runs on admin_init rather than a single activation hook
 * because this theme and the Formistic plugin can be activated in either
 * order — this keeps retrying (cheaply: one option read) until both are
 * present, then marks itself done.
 */
function insightistic_maybe_provision_formistic_forms() {
	if ( get_option( 'insightistic_formistic_forms_provisioned' ) ) {
		return;
	}
	if ( ! insightistic_formistic_active() || ! class_exists( 'Wpistic_Formistic_Forms' ) ) {
		return;
	}

	foreach ( insightistic_formistic_form_definitions() as $slug => $definition ) {
		$form_id = Wpistic_Formistic_Forms::ensure_form( 'insightistic-marketing:' . $slug, $definition );

		if ( $form_id && ! insightistic_option( 'insightistic_form_' . $slug, 0 ) ) {
			set_theme_mod( 'insightistic_form_' . $slug, $form_id );
		}
	}

	update_option( 'insightistic_formistic_forms_provisioned', 1 );
}
add_action( 'admin_init', 'insightistic_maybe_provision_formistic_forms' );
