<?php
/**
 * Security feature grid — reuses feature-card.php with security-specific content.
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$security_points = array(
	array(
		'icon'  => 'shield',
		'title' => __( 'No payment card data, ever', 'insightistic-marketing' ),
		'text'  => __( 'The connector syncs business analytics data — orders, products, customers, traffic, SEO, performance. It never collects or stores card numbers or payment credentials.', 'insightistic-marketing' ),
	),
	array(
		'icon'  => 'plug',
		'title' => __( 'Signed connector requests', 'insightistic-marketing' ),
		'text'  => __( 'Every sync from your store is authenticated with a per-site HMAC signature, not a shared password — a compromised request can\'t be replayed against a different site.', 'insightistic-marketing' ),
	),
	array(
		'icon'  => 'globe',
		'title' => __( 'Tenant isolation by design', 'insightistic-marketing' ),
		'text'  => __( 'Every database query is scoped to your organization at the framework level. One store\'s data is not just access-controlled from another\'s — it\'s invisible to the query.', 'insightistic-marketing' ),
	),
	array(
		'icon'  => 'file-text',
		'title' => __( 'License keys shown once, stored hashed', 'insightistic-marketing' ),
		'text'  => __( 'A license key is displayed to you exactly once at creation. From then on, only its salted hash is stored — Insightistic itself cannot read your key back out of the database.', 'insightistic-marketing' ),
	),
	array(
		'icon'  => 'bar-chart',
		'title' => __( 'Signed, expiring report links', 'insightistic-marketing' ),
		'text'  => __( 'PDF and HTML report downloads use signed URLs with a defined expiry — a link can\'t be guessed, and it can\'t be shared indefinitely after it should have stopped working.', 'insightistic-marketing' ),
	),
	array(
		'icon'  => 'check',
		'title' => __( 'Every admin action is audited', 'insightistic-marketing' ),
		'text'  => __( 'Every account, license and billing change made from the Insightistic support console is written to an audit log — actor, action, before/after state and reason, never silent.', 'insightistic-marketing' ),
	),
);
?>
<section class="ins-section ins-features" aria-labelledby="ins-security-title">
	<div class="ins-container">
		<div class="ins-section__head">
			<p class="ins-eyebrow"><?php esc_html_e( 'Security & privacy', 'insightistic-marketing' ); ?></p>
			<h2 id="ins-security-title"><?php esc_html_e( 'Built to touch your store data carefully', 'insightistic-marketing' ); ?></h2>
		</div>
		<div class="ins-grid ins-grid--features">
			<?php
			foreach ( $security_points as $point ) {
				get_template_part( 'template-parts/cards/feature-card', null, $point );
			}
			?>
		</div>
	</div>
</section>
