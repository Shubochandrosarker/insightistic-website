<?php
/**
 * Template Name: Black Friday Deal
 *
 * Dedicated Google Ads landing page: brief app overview, honest pricing
 * comparison, what is included per tier. All CTAs use the tracked 'ga'
 * AppSumo link. Claims are limited to what the shipped product does.
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
$bf_url = insightistic_promo_url( 'ga' );
?>
<main id="main" class="ins-main ins-page-template ins-ltd">
	<section class="ins-section ins-ltd-hero" aria-labelledby="ins-bf-title">
		<div class="ins-container ins-narrow ins-center">
			<p class="ins-eyebrow"><?php esc_html_e( 'Black Friday — Lifetime Deal', 'insightistic-marketing' ); ?></p>
			<h1 id="ins-bf-title" class="ins-page-hero__title"><?php esc_html_e( 'Hire an AI business manager. Pay once. Keep it for life.', 'insightistic-marketing' ); ?></h1>
			<p class="ins-lead"><?php esc_html_e( 'Insightistic watches your Google rankings, AI visibility, WooCommerce revenue and site health around the clock — and Agent JOLLEY, the AI manager included in every tier, briefs you every morning and fixes issues only after you approve.', 'insightistic-marketing' ); ?></p>
			<div class="ins-ltd-hero__actions">
				<a class="ins-btn ins-btn--brand ins-btn--lg" href="<?php echo esc_url( $bf_url ); ?>" rel="sponsored noopener" target="_blank"><?php esc_html_e( 'Get the Black Friday Lifetime Deal — from $49', 'insightistic-marketing' ); ?></a>
			</div>
			<p class="ins-ltd-terms-note"><?php esc_html_e( 'One payment. Monthly allowances renew. 60-day refund via AppSumo.', 'insightistic-marketing' ); ?></p>
		</div>
	</section>

	<section class="ins-section" aria-labelledby="ins-bf-what-title">
		<div class="ins-container">
			<div class="ins-section__head">
				<p class="ins-eyebrow"><?php esc_html_e( 'What Insightistic does', 'insightistic-marketing' ); ?></p>
				<h2 id="ins-bf-what-title"><?php esc_html_e( 'Every signal your business runs on — one workspace, one AI manager.', 'insightistic-marketing' ); ?></h2>
			</div>
			<div class="ins-trust__grid">
				<article class="ins-trust__item"><h3><?php esc_html_e( 'One workspace for every signal', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'Google Analytics, Search Console, Bing and WooCommerce revenue in one dashboard — no tab juggling, no export spreadsheets.', 'insightistic-marketing' ); ?></p></article>
				<article class="ins-trust__item"><h3><?php esc_html_e( 'AI search visibility', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'See whether AI answers mention and cite your brand for the prompts your customers actually ask — and who gets cited instead.', 'insightistic-marketing' ); ?></p></article>
				<article class="ins-trust__item"><h3><?php esc_html_e( 'The 7 AM brief', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'One short brief every morning: what changed while you slept, what needs your decision, what is on fire. Most days: nothing — and that is the point.', 'insightistic-marketing' ); ?></p></article>
				<article class="ins-trust__item"><h3><?php esc_html_e( 'Fixes with receipts', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'Agent JOLLEY drafts the fix and waits. Approve in one click and it applies the change, then shows you exactly what it did.', 'insightistic-marketing' ); ?></p></article>
				<article class="ins-trust__item"><h3><?php esc_html_e( 'The monitors competitors charge extra for', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'Google Maps rankings, PageSpeed and Core Web Vitals, uptime and SSL expiry — bundled in every tier.', 'insightistic-marketing' ); ?></p></article>
				<article class="ins-trust__item"><h3><?php esc_html_e( 'Built for any website', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'WordPress and WooCommerce connect through a free official connector; any other site connects in one click with a scoped MCP token you can revoke.', 'insightistic-marketing' ); ?></p></article>
			</div>
		</div>
	</section>

	<section class="ins-section" aria-labelledby="ins-bf-compare-title">
		<div class="ins-container">
			<div class="ins-section__head">
				<p class="ins-eyebrow"><?php esc_html_e( 'Honest comparison', 'insightistic-marketing' ); ?></p>
				<h2 id="ins-bf-compare-title"><?php esc_html_e( 'One payment vs monthly forever.', 'insightistic-marketing' ); ?></h2>
				<p class="ins-lead ins-center"><?php esc_html_e( 'Competitor prices are their publicly published monthly rates (November 2026) — check their sites for current terms. Insightistic is a one-time payment.', 'insightistic-marketing' ); ?></p>
			</div>
			<div class="ins-ltd-grid">
				<article class="ins-ltd-card ins-ltd-card--featured">
					<span class="ins-plan__badge"><?php esc_html_e( 'Black Friday pick', 'insightistic-marketing' ); ?></span>
					<p class="ins-plan__eyebrow"><?php esc_html_e( '5 to 50 websites', 'insightistic-marketing' ); ?></p>
					<h3><?php esc_html_e( 'Insightistic Lifetime', 'insightistic-marketing' ); ?></h3>
					<p class="ins-plan__price"><span class="ins-plan__amount">$49</span><span class="ins-plan__per"><?php esc_html_e( 'once', 'insightistic-marketing' ); ?></span></p>
					<ul class="ins-plan__features">
						<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'Agent JOLLEY: briefs, fixes with receipts, memory', 'insightistic-marketing' ); ?></span></li>
						<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'AI search visibility and citation tracking', 'insightistic-marketing' ); ?></span></li>
						<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'GA4, Search Console, Bing, WooCommerce', 'insightistic-marketing' ); ?></span></li>
						<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'Maps tracking, PageSpeed, uptime, SSL', 'insightistic-marketing' ); ?></span></li>
						<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'Monthly AI credits and allowances that renew', 'insightistic-marketing' ); ?></span></li>
						<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( '60-day refund through AppSumo', 'insightistic-marketing' ); ?></span></li>
					</ul>
					<a class="ins-btn ins-btn--brand ins-btn--block" href="<?php echo esc_url( $bf_url ); ?>" rel="sponsored noopener" target="_blank"><?php esc_html_e( 'Get the deal', 'insightistic-marketing' ); ?></a>
				</article>
				<article class="ins-ltd-card">
					<p class="ins-plan__eyebrow"><?php esc_html_e( 'Recurring', 'insightistic-marketing' ); ?></p>
					<h3><?php esc_html_e( 'Ahrefs Lite', 'insightistic-marketing' ); ?></h3>
					<p class="ins-plan__price"><span class="ins-plan__amount">$99</span><span class="ins-plan__per"><?php esc_html_e( 'per month', 'insightistic-marketing' ); ?></span></p>
					<ul class="ins-plan__features">
						<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'Strong backlink and keyword data', 'insightistic-marketing' ); ?></span></li>
						<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'Dashboard only — no agent, no briefs', 'insightistic-marketing' ); ?></span></li>
						<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'No AI-answer visibility, no uptime or SSL care', 'insightistic-marketing' ); ?></span></li>
						<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'Adds up to ~$1,188 per year', 'insightistic-marketing' ); ?></span></li>
					</ul>
				</article>
				<article class="ins-ltd-card">
					<p class="ins-plan__eyebrow"><?php esc_html_e( 'Recurring', 'insightistic-marketing' ); ?></p>
					<h3><?php esc_html_e( 'Semrush Pro', 'insightistic-marketing' ); ?></h3>
					<p class="ins-plan__price"><span class="ins-plan__amount">$139.95</span><span class="ins-plan__per"><?php esc_html_e( 'per month', 'insightistic-marketing' ); ?></span></p>
					<ul class="ins-plan__features">
						<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'Broad SEO toolkit', 'insightistic-marketing' ); ?></span></li>
						<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'Dashboard only — no agent, no approvals', 'insightistic-marketing' ); ?></span></li>
						<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'Adds up to ~$1,679 per year', 'insightistic-marketing' ); ?></span></li>
					</ul>
				</article>
				<article class="ins-ltd-card">
					<p class="ins-plan__eyebrow"><?php esc_html_e( 'AppSumo lifetime', 'insightistic-marketing' ); ?></p>
					<h3><?php esc_html_e( 'Screpy', 'insightistic-marketing' ); ?></h3>
					<p class="ins-plan__price"><span class="ins-plan__amount">$69</span><span class="ins-plan__per"><?php esc_html_e( 'once', 'insightistic-marketing' ); ?></span></p>
					<ul class="ins-plan__features">
						<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'Dashboard-style AI SEO monitoring', 'insightistic-marketing' ); ?></span></li>
						<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'No agent, no memory, no approvals', 'insightistic-marketing' ); ?></span></li>
						<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'No WooCommerce or commerce view', 'insightistic-marketing' ); ?></span></li>
					</ul>
				</article>
			</div>
		</div>
	</section>

	<section class="ins-section" aria-labelledby="ins-bf-tiers-title">
		<div class="ins-container">
			<div class="ins-section__head">
				<p class="ins-eyebrow"><?php esc_html_e( 'Five tiers', 'insightistic-marketing' ); ?></p>
				<h2 id="ins-bf-tiers-title"><?php esc_html_e( 'Pick the workspace size you keep for life.', 'insightistic-marketing' ); ?></h2>
				<p class="ins-lead ins-center"><?php esc_html_e( 'Every tier includes Agent JOLLEY, AI visibility, the full monitor bundle and monthly allowances that renew automatically.', 'insightistic-marketing' ); ?></p>
			</div>
			<div class="ins-ltd-grid">
				<?php
				$bf_tiers = array(
					array( '$49', '5 sites', '5,000 credits', '300 JOLLEY messages', '10,000 crawl pages', '10 keywords' ),
					array( '$79', '10 sites', '10,000 credits', '500 JOLLEY messages', '40,000 crawl pages', '20 keywords' ),
					array( '$149', '15 sites', '30,000 credits', '800 JOLLEY messages', '100,000 crawl pages', '30 keywords' ),
					array( '$269', '30 sites', '75,000 credits', '1,200 JOLLEY messages', '250,000 crawl pages', '50 keywords', 'White-label + priority support' ),
					array( '$499', '50 sites', '250,000 credits', '2,000 JOLLEY messages', '600,000 crawl pages', '100 keywords', 'White-label + priority support' ),
				);
				foreach ( $bf_tiers as $bf_index => $bf_tier ) :
					?>
					<article class="ins-ltd-card<?php echo 1 === $bf_index ? ' ins-ltd-card--featured' : ''; ?>">
						<?php if ( 1 === $bf_index ) : ?><span class="ins-plan__badge"><?php esc_html_e( 'Most popular', 'insightistic-marketing' ); ?></span><?php endif; ?>
						<p class="ins-plan__eyebrow"><?php echo esc_html( $bf_tier[0] ); ?> <?php esc_html_e( 'once — License Tier', 'insightistic-marketing' ); ?> <?php echo esc_html( $bf_index + 1 ); ?></p>
						<ul class="ins-plan__features">
							<?php foreach ( array_slice( $bf_tier, 1 ) as $bf_line ) : ?><li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php echo esc_html( $bf_line ); ?></span></li><?php endforeach; ?>
						</ul>
						<a class="ins-btn ins-btn--ghost ins-btn--block" href="<?php echo esc_url( $bf_url ); ?>" rel="sponsored noopener" target="_blank"><?php esc_html_e( 'Choose this tier', 'insightistic-marketing' ); ?></a>
					</article>
				<?php endforeach; ?>
			</div>
			<p class="ins-ltd-terms-note ins-center"><?php esc_html_e( 'Monthly allowances renew automatically; the purchase itself never renews. WooCommerce included on Tier 2 and above.', 'insightistic-marketing' ); ?></p>
		</div>
	</section>

	<section class="ins-section" aria-labelledby="ins-bf-faq-title">
		<div class="ins-container ins-narrow">
			<div class="ins-section__head">
				<p class="ins-eyebrow"><?php esc_html_e( 'Before you buy', 'insightistic-marketing' ); ?></p>
				<h2 id="ins-bf-faq-title"><?php esc_html_e( 'Straight answers.', 'insightistic-marketing' ); ?></h2>
			</div>
			<div class="ins-stepgrid">
				<article class="ins-step"><h3><?php esc_html_e( 'Is it really one payment?', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'Yes. You pay once on AppSumo; the purchased tier stays active for the lifetime of the service. Monthly allowances renew automatically — the price does not.', 'insightistic-marketing' ); ?></p></article>
				<article class="ins-step"><h3><?php esc_html_e( 'What if it is not for me?', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'AppSumo covers every purchase with a 60-day refund window — no questions, handled by them.', 'insightistic-marketing' ); ?></p></article>
				<article class="ins-step"><h3><?php esc_html_e( 'Does it work without WordPress?', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'Yes. Any website connects in one click with a scoped MCP token. WordPress and WooCommerce simply get deeper, optional integrations.', 'insightistic-marketing' ); ?></p></article>
				<article class="ins-step"><h3><?php esc_html_e( 'Who is Agent JOLLEY for?', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'Owners and small teams who want the watching done for them — and want to approve every change before it happens.', 'insightistic-marketing' ); ?></p></article>
			</div>
		</div>
	</section>

	<section class="ins-section" aria-labelledby="ins-bf-cta-title">
		<div class="ins-container ins-narrow ins-center">
			<h2 id="ins-bf-cta-title"><?php esc_html_e( 'Wake up to progress, not problems.', 'insightistic-marketing' ); ?></h2>
			<p class="ins-lead"><?php esc_html_e( 'The lifetime deal is live on AppSumo — from $49, every tier includes Agent JOLLEY. Enter the giveaway while you are there: ten Tier 5 licenses are being won.', 'insightistic-marketing' ); ?></p>
			<div class="ins-ltd-hero__actions">
				<a class="ins-btn ins-btn--brand ins-btn--lg" href="<?php echo esc_url( $bf_url ); ?>" rel="sponsored noopener" target="_blank"><?php esc_html_e( 'Claim the Black Friday Lifetime Deal', 'insightistic-marketing' ); ?></a>
			</div>
		</div>
	</section>
</main>
<?php get_footer(); ?>
