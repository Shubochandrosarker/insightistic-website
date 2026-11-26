<?php
/**
 * Public homepage FAQ data shared by the template and schema.
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// A partial theme update may still have the earlier definition in helpers.php.
if ( ! function_exists( 'insightistic_home_faqs' ) ) {
	/** Visible FAQ answers for the public overview. Shared with the homepage graph. */
	function insightistic_home_faqs() {
		return array(
			array( 'q' => __( 'Do I need WooCommerce?', 'insightistic-marketing' ), 'a' => __( 'No. Search and site health work without a store. Connect WooCommerce when you want orders, revenue, and refunds in the same workspace.', 'insightistic-marketing' ) ),
			array( 'q' => __( 'What data can Agent JOLLEY use?', 'insightistic-marketing' ), 'a' => __( 'JOLLEY draws on data available in your workspace, including connected search and store data, site audits, and your knowledge base. Available sources depend on what you connect and your plan.', 'insightistic-marketing' ) ),
			array( 'q' => __( 'Can I look around before connecting anything?', 'insightistic-marketing' ), 'a' => __( 'Yes. Browse the public product tour to see example screens and workflows before you create an account.', 'insightistic-marketing' ) ),
			array( 'q' => __( 'Can I use Insightistic for multiple clients?', 'insightistic-marketing' ), 'a' => __( 'Yes. Compare site allowances, reporting features, and access controls on the agency page.', 'insightistic-marketing' ) ),
		);
	}
}
