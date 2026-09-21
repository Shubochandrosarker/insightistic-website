<?php
/**
 * Template Name: Insightistic LTD
 * Template Post Type: page
 *
 * Angel lifetime deal landing page.
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$tiers = array(
	array(
		'name'   => __( 'Angel Solo', 'insightistic-marketing' ),
		'price'  => '$79',
		'plan'   => 'founder_tier_1',
		'limits' => __( '3 sites · 10k crawl pages/mo · 150 keywords · 10 AI prompts/mo · basic reports', 'insightistic-marketing' ),
	),
	array(
		'name'   => __( 'Angel Studio', 'insightistic-marketing' ),
		'price'  => '$149',
		'plan'   => 'founder_tier_2',
		'limits' => __( '10 sites · 40k crawl pages/mo · 500 keywords · 40 AI prompts/mo · scheduled reports', 'insightistic-marketing' ),
	),
	array(
		'name'   => __( 'Angel Agency', 'insightistic-marketing' ),
		'price'  => '$249',
		'plan'   => 'founder_tier_3',
		'limits' => __( '30 sites · 100k crawl pages/mo · 1,500 keywords · 100 AI prompts/mo · white-label reports · 5 team members', 'insightistic-marketing' ),
	),
);

get_header();
?>
<main id="main" class="ins-main ins-page-template ins-ltd-page">
	<section class="ins-ltd-hero">
		<div class="ins-container ins-ltd-hero__grid">
			<div class="ins-ltd-hero__copy">
				<p class="ins-eyebrow"><?php esc_html_e( 'Angel member release · limited time', 'insightistic-marketing' ); ?></p>
				<h1><?php esc_html_e( 'Join the first 100 Angel members building a clearer way to run WordPress businesses.', 'insightistic-marketing' ); ?></h1>
				<p class="ins-lead"><?php esc_html_e( 'Insightistic brings revenue, customers, products, traffic, SEO, performance and explainable AI into one clean operating view — built for store owners and the agencies who support them.', 'insightistic-marketing' ); ?></p>
				<div class="ins-hero__actions ins-ltd-hero__actions">
					<a class="ins-btn ins-btn--brand ins-btn--lg" href="<?php echo esc_url( add_query_arg( 'plan', 'founder_tier_2', insightistic_register_url() ) ); ?>"><?php esc_html_e( 'Join the first 100 Angel members', 'insightistic-marketing' ); ?> <?php echo insightistic_icon( 'arrow-right', 17 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
					<a class="ins-btn ins-btn--ghost ins-btn--lg" href="#tiers"><?php esc_html_e( 'Compare Angel tiers', 'insightistic-marketing' ); ?></a>
				</div>
				<ul class="ins-ltd-proof" aria-label="<?php esc_attr_e( 'Angel member access highlights', 'insightistic-marketing' ); ?>">
					<li><strong><?php esc_html_e( 'One-time', 'insightistic-marketing' ); ?></strong><span><?php esc_html_e( 'payment', 'insightistic-marketing' ); ?></span></li>
					<li><strong><?php esc_html_e( 'First 100', 'insightistic-marketing' ); ?></strong><span><?php esc_html_e( 'Angel members', 'insightistic-marketing' ); ?></span></li>
					<li><strong><?php esc_html_e( 'Monthly', 'insightistic-marketing' ); ?></strong><span><?php esc_html_e( 'published allowances', 'insightistic-marketing' ); ?></span></li>
					<li><strong><?php esc_html_e( '30 days', 'insightistic-marketing' ); ?></strong><span><?php esc_html_e( '100% money-back guarantee', 'insightistic-marketing' ); ?></span></li>
				</ul>
			</div>

			<div class="ins-ltd-hero__visual" aria-label="<?php esc_attr_e( 'Insightistic analytics workspace preview', 'insightistic-marketing' ); ?>">
				<div class="ins-ltd-dashboard">
					<div class="ins-ltd-dashboard__top"><span class="ins-ltd-dashboard__brand">Insightistic</span><span class="ins-ltd-dashboard__status"><?php esc_html_e( 'Example workspace', 'insightistic-marketing' ); ?></span></div>
					<div class="ins-ltd-dashboard__headline"><span><?php esc_html_e( 'Business overview', 'insightistic-marketing' ); ?></span><strong><?php esc_html_e( 'This month', 'insightistic-marketing' ); ?></strong></div>
					<div class="ins-ltd-dashboard__metrics">
						<div><span><?php esc_html_e( 'Revenue', 'insightistic-marketing' ); ?></span><strong>$48,290</strong><em>+18.4%</em></div>
						<div><span><?php esc_html_e( 'Orders', 'insightistic-marketing' ); ?></span><strong>1,284</strong><em>+12.8%</em></div>
						<div><span><?php esc_html_e( 'Returning customers', 'insightistic-marketing' ); ?></span><strong>34.6%</strong><em>+4.1%</em></div>
					</div>
					<div class="ins-ltd-dashboard__insight"><span class="ins-ltd-dashboard__spark" aria-hidden="true">✦</span><p><strong><?php esc_html_e( 'AI insight', 'insightistic-marketing' ); ?></strong><?php esc_html_e( 'Returning-customer revenue is growing faster than acquisition spend. Protect the segment before scaling traffic.', 'insightistic-marketing' ); ?></p></div>
				</div>
			</div>
		</div>
	</section>

	<section class="ins-section ins-ltd-section">
		<div class="ins-container">
			<div class="ins-section__head">
				<p class="ins-eyebrow"><?php esc_html_e( 'A real member cap', 'insightistic-marketing' ); ?></p>
				<h2><?php esc_html_e( 'Stop stitching together reports before you can act.', 'insightistic-marketing' ); ?></h2>
				<p class="ins-lead"><?php esc_html_e( 'Connect your WordPress and WooCommerce properties once. Insightistic turns the signals your team already has into a clearer weekly rhythm.', 'insightistic-marketing' ); ?></p>
			</div>
			<div class="ins-ltd-feature-grid">
				<div class="ins-ltd-feature"><span class="ins-ltd-feature__icon" aria-hidden="true">↗</span><h3><?php esc_html_e( 'Commerce clarity', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'See revenue, orders, products, refunds and customer movement together instead of across disconnected dashboards.', 'insightistic-marketing' ); ?></p></div>
				<div class="ins-ltd-feature"><span class="ins-ltd-feature__icon" aria-hidden="true">✦</span><h3><?php esc_html_e( 'Explainable AI', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'Turn meaningful changes into plain-language explanations and reviewable next actions — not opaque scorecards.', 'insightistic-marketing' ); ?></p></div>
				<div class="ins-ltd-feature"><span class="ins-ltd-feature__icon" aria-hidden="true">▤</span><h3><?php esc_html_e( 'Agency-ready reporting', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'Create scheduled, branded reports that give clients the right context without another spreadsheet ritual.', 'insightistic-marketing' ); ?></p></div>
				<div class="ins-ltd-feature"><span class="ins-ltd-feature__icon" aria-hidden="true">✓</span><h3><?php esc_html_e( 'Privacy-conscious connections', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'Use an authenticated WordPress connection with tenant-aware data boundaries and operational sync visibility.', 'insightistic-marketing' ); ?></p></div>
				<div class="ins-ltd-feature"><span class="ins-ltd-feature__icon" aria-hidden="true">◎</span><h3><?php esc_html_e( 'Search and AI source readiness', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'Keep product facts, source pages and AI-agent discovery paths clear, consistent and ready to be cited — without promising a ranking outcome.', 'insightistic-marketing' ); ?></p></div>
			</div>
		</div>
	</section>

	<section class="ins-section ins-ltd-section ins-ltd-section--tint">
		<div class="ins-container">
			<div class="ins-section__head">
				<p class="ins-eyebrow"><?php esc_html_e( 'From install to insight', 'insightistic-marketing' ); ?></p>
				<h2><?php esc_html_e( 'A simple path to a better operating rhythm.', 'insightistic-marketing' ); ?></h2>
			</div>
			<div class="ins-ltd-steps">
				<div><span>01</span><h3><?php esc_html_e( 'Connect', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'Install the WordPress plugin, connect your store and let the first sync establish your baseline.', 'insightistic-marketing' ); ?></p></div>
				<div><span>02</span><h3><?php esc_html_e( 'Understand', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'Review the metrics that matter, see what changed and let AI surface the signal behind the movement.', 'insightistic-marketing' ); ?></p></div>
				<div><span>03</span><h3><?php esc_html_e( 'Act and share', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'Turn the weekly view into decisions, client conversations and reports your team can trust.', 'insightistic-marketing' ); ?></p></div>
			</div>
		</div>
	</section>

	<section id="tiers" class="ins-section ins-ltd-section">
		<div class="ins-container">
			<div class="ins-section__head">
				<p class="ins-eyebrow"><?php esc_html_e( 'Angel member access', 'insightistic-marketing' ); ?></p>
				<h2><?php esc_html_e( 'Choose the Angel tier that fits your portfolio today.', 'insightistic-marketing' ); ?></h2>
				<p class="ins-lead"><?php esc_html_e( 'One-time Angel pricing with the published monthly allowances below. Lifetime means access to the purchased tier’s included feature family for as long as Insightistic operates.', 'insightistic-marketing' ); ?></p>
			</div>
			<div class="ins-ltd-tiers">
				<?php foreach ( $tiers as $index => $tier ) : ?>
					<article class="ins-ltd-tier<?php echo 1 === $index ? ' ins-ltd-tier--featured' : ''; ?>">
						<?php if ( 1 === $index ) : ?><span class="ins-ltd-tier__badge"><?php esc_html_e( 'Most flexible', 'insightistic-marketing' ); ?></span><?php endif; ?>
						<div class="ins-ltd-tier__name"><?php echo esc_html( $tier['name'] ); ?></div>
						<div class="ins-ltd-tier__price"><?php echo esc_html( $tier['price'] ); ?><span><?php esc_html_e( ' one time', 'insightistic-marketing' ); ?></span></div>
						<p><?php echo esc_html( $tier['limits'] ); ?></p>
						<a class="ins-btn <?php echo 1 === $index ? 'ins-btn--brand' : 'ins-btn--ghost'; ?> ins-btn--block" href="<?php echo esc_url( add_query_arg( 'plan', $tier['plan'], insightistic_register_url() ) ); ?>"><?php esc_html_e( 'Choose this tier', 'insightistic-marketing' ); ?></a>
					</article>
				<?php endforeach; ?>
			</div>
			<p class="ins-ltd-note"><?php esc_html_e( 'Limited-time offer: the campaign closes when the first 100 Angel members are claimed or the campaign ends. No fake countdown timer or surprise meters. Review the published allowances and deal terms before you buy.', 'insightistic-marketing' ); ?> <a href="<?php echo esc_url( home_url( '/terms' ) ); ?>"><?php esc_html_e( 'Read the deal terms', 'insightistic-marketing' ); ?></a>.</p>
		</div>
	</section>

	<section id="compare" class="ins-section ins-ltd-section ins-ltd-section--tint">
		<div class="ins-container">
			<div class="ins-section__head">
				<p class="ins-eyebrow"><?php esc_html_e( 'A fair market comparison', 'insightistic-marketing' ); ?></p>
				<h2><?php esc_html_e( 'One operating view — without five separate subscriptions.', 'insightistic-marketing' ); ?></h2>
				<p class="ins-lead"><?php esc_html_e( 'The market has excellent specialists. Angel is for WordPress and WooCommerce operators who want commerce, site health, search visibility and explainable AI connected in one workflow.', 'insightistic-marketing' ); ?></p>
			</div>
			<div class="ins-ltd-compare-wrap" role="region" aria-label="<?php esc_attr_e( 'Insightistic market comparison', 'insightistic-marketing' ); ?>" tabindex="0">
				<table class="ins-ltd-compare">
					<thead><tr><th scope="col"><?php esc_html_e( 'Provider', 'insightistic-marketing' ); ?></th><th scope="col"><?php esc_html_e( 'Best known for', 'insightistic-marketing' ); ?></th><th scope="col"><?php esc_html_e( 'How Angel fits', 'insightistic-marketing' ); ?></th><th scope="col"><?php esc_html_e( 'Public pricing pattern', 'insightistic-marketing' ); ?></th></tr></thead>
					<tbody>
						<tr class="ins-ltd-compare__featured"><th scope="row"><?php esc_html_e( 'Insightistic Angel', 'insightistic-marketing' ); ?></th><td><?php esc_html_e( 'WordPress/WooCommerce analytics, site signals, AI explanations and agency-ready reporting.', 'insightistic-marketing' ); ?></td><td><?php esc_html_e( 'One connected operating view with a one-time $79 / $149 / $249 launch offer for the first 100 members.', 'insightistic-marketing' ); ?></td><td><?php esc_html_e( 'One-time payment · published monthly allowances · 30-day guarantee', 'insightistic-marketing' ); ?></td></tr>
						<tr><th scope="row"><a href="https://agencyanalytics.com/pricing" target="_blank" rel="noopener"><?php esc_html_e( 'AgencyAnalytics', 'insightistic-marketing' ); ?></a></th><td><?php esc_html_e( 'Agency dashboards, client portals, white-label reports and broad connectors.', 'insightistic-marketing' ); ?></td><td><?php esc_html_e( 'A reporting specialist worth considering when connector breadth is the priority; Angel is deeper in the WordPress/WooCommerce workflow.', 'insightistic-marketing' ); ?></td><td><?php esc_html_e( 'From $20/client/month billed annually; AI Tracker and Rank Tracker are optional add-ons.', 'insightistic-marketing' ); ?></td></tr>
						<tr><th scope="row"><a href="https://databox.com/pricing" target="_blank" rel="noopener"><?php esc_html_e( 'Databox', 'insightistic-marketing' ); ?></a></th><td><?php esc_html_e( 'Cross-source KPI dashboards, governed metrics and AI analyst workflows.', 'insightistic-marketing' ); ?></td><td><?php esc_html_e( 'A flexible BI layer; Angel reduces setup for WordPress businesses by starting from the store and site context.', 'insightistic-marketing' ); ?></td><td><?php esc_html_e( 'Free tier, then monthly plans by users, sources and AI credits.', 'insightistic-marketing' ); ?></td></tr>
						<tr><th scope="row"><a href="https://metorik.com/pricing" target="_blank" rel="noopener"><?php esc_html_e( 'Metorik', 'insightistic-marketing' ); ?></a></th><td><?php esc_html_e( 'WooCommerce/Shopify revenue analytics, segmentation, forecasting and email workflows.', 'insightistic-marketing' ); ?></td><td><?php esc_html_e( 'A strong commerce specialist; Angel adds the site, SEO/performance and AI-source layer around the store.', 'insightistic-marketing' ); ?></td><td><?php esc_html_e( 'Monthly pricing scales with average monthly orders; 30-day free trial.', 'insightistic-marketing' ); ?></td></tr>
						<tr><th scope="row"><a href="https://www.semrush.com/pricing/seo-ai-search/" target="_blank" rel="noopener"><?php esc_html_e( 'Semrush', 'insightistic-marketing' ); ?></a></th><td><?php esc_html_e( 'Large-scale SEO, keyword research, competitive analysis and AI-search visibility.', 'insightistic-marketing' ); ?></td><td><?php esc_html_e( 'A specialist for deep SEO research; Angel is the lighter operating layer for the WordPress/WooCommerce business itself.', 'insightistic-marketing' ); ?></td><td><?php esc_html_e( 'SEO + AI Search plans from $165.17/month billed annually.', 'insightistic-marketing' ); ?></td></tr>
						<tr><th scope="row"><a href="https://ahrefs.com/pricing" target="_blank" rel="noopener"><?php esc_html_e( 'Ahrefs', 'insightistic-marketing' ); ?></a></th><td><?php esc_html_e( 'Backlinks, site audit, rank tracking and AI visibility research.', 'insightistic-marketing' ); ?></td><td><?php esc_html_e( 'A powerful SEO data source; Angel is designed to connect SEO context to commerce decisions and client reporting.', 'insightistic-marketing' ); ?></td><td><?php esc_html_e( 'Lite starts at $129/month; AI Brand Radar is a separate paid option.', 'insightistic-marketing' ); ?></td></tr>
					</tbody>
				</table>
			</div>
			<p class="ins-ltd-note"><?php esc_html_e( 'Prices and features change. The comparison reflects the public pages reviewed for this launch and is a buying aid, not a claim that one tool replaces every specialist.', 'insightistic-marketing' ); ?> <a href="<?php echo esc_url( home_url( '/ai-agents' ) ); ?>"><?php esc_html_e( 'See our source and citation guide', 'insightistic-marketing' ); ?></a>.</p>
		</div>
	</section>

	<section class="ins-section ins-ltd-section ins-ltd-section--dark">
		<div class="ins-container ins-ltd-final">
			<div>
				<p class="ins-eyebrow"><?php esc_html_e( 'Built for the people doing the work', 'insightistic-marketing' ); ?></p>
				<h2><?php esc_html_e( 'Give your next decision more context — and your clients more confidence.', 'insightistic-marketing' ); ?></h2>
				<p><?php esc_html_e( 'Start with the Angel tier that fits your portfolio. Try the real workflow for 30 days; if it is not a fit, request a 100% refund with no questions asked.', 'insightistic-marketing' ); ?></p>
				<a class="ins-btn ins-btn--brand ins-btn--lg" href="<?php echo esc_url( add_query_arg( 'plan', 'founder_tier_2', insightistic_register_url() ) ); ?>"><?php esc_html_e( 'Join the first 100 Angel members', 'insightistic-marketing' ); ?></a>
			</div>
				<div class="ins-ltd-guarantee" id="guarantee"><strong><?php esc_html_e( '30-day, 100% money-back guarantee', 'insightistic-marketing' ); ?></strong><span><?php esc_html_e( 'Use the product. Connect your store. Review the workflow. If it is not a fit, contact us within 30 calendar days of purchase for a full refund — no questions asked, subject to the published deal terms.', 'insightistic-marketing' ); ?></span><a href="<?php echo esc_url( home_url( '/refunds' ) ); ?>"><?php esc_html_e( 'Read the refund policy', 'insightistic-marketing' ); ?></a></div>
			<div class="ins-ltd-leadbox">
				<h3><?php esc_html_e( 'Prefer a quick fit check?', 'insightistic-marketing' ); ?></h3>
				<p><?php esc_html_e( 'Tell us what you manage and we’ll help you map it to the right Angel tier.', 'insightistic-marketing' ); ?></p>
				<?php insightistic_formistic_form( 'ltd' ); ?>
				<p class="ins-consent"><?php esc_html_e( 'By submitting this form, you agree to our', 'insightistic-marketing' ); ?> <a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'insightistic-marketing' ); ?></a>.</p>
			</div>
		</div>
	</section>

	<section class="ins-section ins-ltd-faq">
		<div class="ins-container ins-narrow">
			<div class="ins-section__head"><p class="ins-eyebrow"><?php esc_html_e( 'Clear terms', 'insightistic-marketing' ); ?></p><h2><?php esc_html_e( 'Questions before you commit?', 'insightistic-marketing' ); ?></h2></div>
			<details><summary><?php esc_html_e( 'What does “lifetime” mean here?', 'insightistic-marketing' ); ?></summary><p><?php esc_html_e( 'It means access to the purchased tier and its included feature family, with the published recurring allowances, for as long as Insightistic operates. It is not a subscription disguised as a 100-year term.', 'insightistic-marketing' ); ?></p></details>
			<details><summary><?php esc_html_e( 'Can I use this for client sites?', 'insightistic-marketing' ); ?></summary><p><?php esc_html_e( 'Yes. Choose the tier whose published site and team allowances cover the portfolio you manage. Agency workflows and branded reporting are designed for client-facing work.', 'insightistic-marketing' ); ?></p></details>
			<details><summary><?php esc_html_e( 'Can I start with the free trial instead?', 'insightistic-marketing' ); ?></summary><p><?php esc_html_e( 'Yes. The standard SaaS plans include a 7-day free trial with no card required to start.', 'insightistic-marketing' ); ?></p></details>
			<details><summary><?php esc_html_e( 'How does the 30-day guarantee work?', 'insightistic-marketing' ); ?></summary><p><?php esc_html_e( 'Try the Angel workflow for 30 calendar days. If it is not right for you, contact us within that period for a 100% refund with no questions asked. The published refund policy and payment-provider records control the final request process.', 'insightistic-marketing' ); ?></p></details>
		</div>
	</section>
</main>
<?php
get_footer();
