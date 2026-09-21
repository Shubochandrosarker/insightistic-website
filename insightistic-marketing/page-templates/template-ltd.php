<?php
/**
 * Template Name: Insightistic LTD
 * Template Post Type: page
 *
 * Founder lifetime deal landing page.
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$tiers = array(
	array(
		'name'   => __( 'Founder Tier 1', 'insightistic-marketing' ),
		'price'  => '$79',
		'plan'   => 'founder_tier_1',
		'limits' => __( '3 sites · 10k crawl pages/mo · 150 keywords · 10 AI prompts/mo · basic reports', 'insightistic-marketing' ),
	),
	array(
		'name'   => __( 'Founder Tier 2', 'insightistic-marketing' ),
		'price'  => '$149',
		'plan'   => 'founder_tier_2',
		'limits' => __( '10 sites · 40k crawl pages/mo · 500 keywords · 40 AI prompts/mo · scheduled reports', 'insightistic-marketing' ),
	),
	array(
		'name'   => __( 'Founder Tier 3', 'insightistic-marketing' ),
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
				<p class="ins-eyebrow"><?php esc_html_e( 'Founder launch release', 'insightistic-marketing' ); ?></p>
				<h1><?php esc_html_e( 'Make every WordPress decision with the whole picture in view.', 'insightistic-marketing' ); ?></h1>
				<p class="ins-lead"><?php esc_html_e( 'Insightistic brings revenue, customers, products, traffic, SEO, performance and explainable AI into one clean operating view — built for store owners and the agencies who support them.', 'insightistic-marketing' ); ?></p>
				<div class="ins-hero__actions ins-ltd-hero__actions">
					<a class="ins-btn ins-btn--brand ins-btn--lg" href="<?php echo esc_url( add_query_arg( 'plan', 'founder_tier_2', insightistic_register_url() ) ); ?>"><?php esc_html_e( 'Get founder access', 'insightistic-marketing' ); ?> <?php echo insightistic_icon( 'arrow-right', 17 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
					<a class="ins-btn ins-btn--ghost ins-btn--lg" href="#tiers"><?php esc_html_e( 'Compare founder tiers', 'insightistic-marketing' ); ?></a>
				</div>
				<ul class="ins-ltd-proof" aria-label="<?php esc_attr_e( 'Founder access highlights', 'insightistic-marketing' ); ?>">
					<li><strong><?php esc_html_e( 'One-time', 'insightistic-marketing' ); ?></strong><span><?php esc_html_e( 'payment', 'insightistic-marketing' ); ?></span></li>
					<li><strong><?php esc_html_e( 'Monthly', 'insightistic-marketing' ); ?></strong><span><?php esc_html_e( 'published allowances', 'insightistic-marketing' ); ?></span></li>
					<li><strong><?php esc_html_e( '7 days', 'insightistic-marketing' ); ?></strong><span><?php esc_html_e( 'free trial for SaaS plans', 'insightistic-marketing' ); ?></span></li>
				</ul>
			</div>

			<div class="ins-ltd-hero__visual" aria-label="<?php esc_attr_e( 'Insightistic analytics workspace preview', 'insightistic-marketing' ); ?>">
				<div class="ins-ltd-dashboard">
					<div class="ins-ltd-dashboard__top"><span class="ins-ltd-dashboard__brand">Insightistic</span><span class="ins-ltd-dashboard__status"><?php esc_html_e( 'Live workspace', 'insightistic-marketing' ); ?></span></div>
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
				<p class="ins-eyebrow"><?php esc_html_e( 'One operating view', 'insightistic-marketing' ); ?></p>
				<h2><?php esc_html_e( 'Stop stitching together reports before you can act.', 'insightistic-marketing' ); ?></h2>
				<p class="ins-lead"><?php esc_html_e( 'Connect your WordPress and WooCommerce properties once. Insightistic turns the signals your team already has into a clearer weekly rhythm.', 'insightistic-marketing' ); ?></p>
			</div>
			<div class="ins-ltd-feature-grid">
				<div class="ins-ltd-feature"><span class="ins-ltd-feature__icon" aria-hidden="true">↗</span><h3><?php esc_html_e( 'Commerce clarity', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'See revenue, orders, products, refunds and customer movement together instead of across disconnected dashboards.', 'insightistic-marketing' ); ?></p></div>
				<div class="ins-ltd-feature"><span class="ins-ltd-feature__icon" aria-hidden="true">✦</span><h3><?php esc_html_e( 'Explainable AI', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'Turn meaningful changes into plain-language explanations and reviewable next actions — not opaque scorecards.', 'insightistic-marketing' ); ?></p></div>
				<div class="ins-ltd-feature"><span class="ins-ltd-feature__icon" aria-hidden="true">▤</span><h3><?php esc_html_e( 'Agency-ready reporting', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'Create scheduled, branded reports that give clients the right context without another spreadsheet ritual.', 'insightistic-marketing' ); ?></p></div>
				<div class="ins-ltd-feature"><span class="ins-ltd-feature__icon" aria-hidden="true">✓</span><h3><?php esc_html_e( 'Privacy-conscious connections', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'Use an authenticated WordPress connection with tenant-aware data boundaries and operational sync visibility.', 'insightistic-marketing' ); ?></p></div>
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
				<p class="ins-eyebrow"><?php esc_html_e( 'Founder access', 'insightistic-marketing' ); ?></p>
				<h2><?php esc_html_e( 'Choose the operating room you need today.', 'insightistic-marketing' ); ?></h2>
				<p class="ins-lead"><?php esc_html_e( 'One-time founder pricing with the published monthly allowances below. Lifetime means access to the purchased tier’s included feature family for as long as Insightistic operates.', 'insightistic-marketing' ); ?></p>
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
			<p class="ins-ltd-note"><?php esc_html_e( 'No fake countdowns or surprise meters. Review the published allowances and deal terms before you buy.', 'insightistic-marketing' ); ?> <a href="<?php echo esc_url( home_url( '/terms' ) ); ?>"><?php esc_html_e( 'Read the deal terms', 'insightistic-marketing' ); ?></a>.</p>
		</div>
	</section>

	<section class="ins-section ins-ltd-section ins-ltd-section--dark">
		<div class="ins-container ins-ltd-final">
			<div>
				<p class="ins-eyebrow"><?php esc_html_e( 'Built for the people doing the work', 'insightistic-marketing' ); ?></p>
				<h2><?php esc_html_e( 'Give your next decision more context — and your clients more confidence.', 'insightistic-marketing' ); ?></h2>
				<p><?php esc_html_e( 'Start with the founder tier that fits your portfolio. If you need a fit check first, send your details and the team will help you choose the right path.', 'insightistic-marketing' ); ?></p>
				<a class="ins-btn ins-btn--brand ins-btn--lg" href="<?php echo esc_url( add_query_arg( 'plan', 'founder_tier_2', insightistic_register_url() ) ); ?>"><?php esc_html_e( 'Start with founder access', 'insightistic-marketing' ); ?></a>
			</div>
			<div class="ins-ltd-leadbox">
				<h3><?php esc_html_e( 'Prefer a quick fit check?', 'insightistic-marketing' ); ?></h3>
				<p><?php esc_html_e( 'Tell us what you manage and we’ll help you map it to the right founder tier.', 'insightistic-marketing' ); ?></p>
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
		</div>
	</section>
</main>
<?php
get_footer();
