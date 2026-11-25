<?php
/**
 * Wave-1 explainers: what JOLLEY is, and how the money works.
 *
 * These exist because the two questions every buyer asks are "what does the AI
 * actually do" and "what will it cost me later". Both answers are stated in the
 * product's own terms - credits vs standard AI requests, what consumes what,
 * overage behaviour, credit packs, stacking and redemption - with no invented
 * numbers: packs come from the live catalog.
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$ins_catalog = insightistic_public_catalog();
$ins_packs   = (array) ( $ins_catalog['credit_packs'] ?? array() );
?>

<section class="ins-section ins-jolly" id="what-is-jolly" aria-labelledby="ins-jolly-title">
	<div class="ins-container">
		<p class="ins-eyebrow"><?php esc_html_e( 'Meet the agent', 'insightistic-marketing' ); ?></p>
		<h2 id="ins-jolly-title" class="ins-section__title"><?php esc_html_e( 'What Agent JOLLEY actually is', 'insightistic-marketing' ); ?></h2>
		<p class="ins-section__lede"><?php esc_html_e( 'Not a chatbot bolted onto a dashboard. JOLLEY is the analyst that reads your data every day, remembers what it learned, and brings you the decision.', 'insightistic-marketing' ); ?></p>

		<div class="ins-jolly__grid">
			<div class="ins-jolly__item">
				<h3><?php esc_html_e( 'What it reads', 'insightistic-marketing' ); ?></h3>
				<ul class="ins-jolly__list">
					<li><?php esc_html_e( 'Google Search Console clicks, impressions, CTR and position', 'insightistic-marketing' ); ?></li>
					<li><?php esc_html_e( 'GA4 sessions, channels and conversions; WooCommerce revenue and orders', 'insightistic-marketing' ); ?></li>
					<li><?php esc_html_e( 'Your crawl, on-page issues, PageSpeed and Core Web Vitals', 'insightistic-marketing' ); ?></li>
					<li><?php esc_html_e( 'AI-answer visibility runs and who gets cited instead of you', 'insightistic-marketing' ); ?></li>
					<li><?php esc_html_e( 'Your own knowledge base and the memory it has built about your business', 'insightistic-marketing' ); ?></li>
				</ul>
			</div>
			<div class="ins-jolly__item">
				<h3><?php esc_html_e( 'What it does on its own', 'insightistic-marketing' ); ?></h3>
				<p><?php esc_html_e( 'Writes your daily brief before you wake up, keeps a digest of what changed, and schedules a weekly strategy pass on paid plans. All of it is budget-gated: when the monthly AI budget is spent, the brief falls back to the plain evidence summary instead of failing.', 'insightistic-marketing' ); ?></p>
			</div>
			<div class="ins-jolly__item">
				<h3><?php esc_html_e( 'What it never does alone', 'insightistic-marketing' ); ?></h3>
				<p><?php esc_html_e( 'It does not change your site, create an automation, or contact anyone without you. Fixes arrive as a list you approve, automations arrive as a draft you approve, and nothing leaves your workspace on its own.', 'insightistic-marketing' ); ?></p>
			</div>
		</div>
	</div>
</section>

<section class="ins-section ins-credits" id="credits" aria-labelledby="ins-credits-title">
	<div class="ins-container">
		<p class="ins-eyebrow"><?php esc_html_e( 'How the money works', 'insightistic-marketing' ); ?></p>
		<h2 id="ins-credits-title" class="ins-section__title"><?php esc_html_e( 'Insight Credits, explained properly', 'insightistic-marketing' ); ?></h2>

		<div class="ins-credits__grid">
			<div class="ins-credits__item">
				<h3><?php esc_html_e( 'Standard AI requests are included', 'insightistic-marketing' ); ?></h3>
				<p><?php esc_html_e( 'Every paid plan includes a monthly number of standard AI requests. These are the everyday jobs: generating an insight, asking JOLLEY a question, drafting a brief. They reset each month and do not roll over.', 'insightistic-marketing' ); ?></p>
			</div>
			<div class="ins-credits__item">
				<h3><?php esc_html_e( 'Credits pay for the expensive work', 'insightistic-marketing' ); ?></h3>
				<p><?php esc_html_e( 'Credits are the meter for variable-cost actions - AI visibility runs, downloadable reports, deep analyses. Your plan includes a monthly credit allowance, and you can buy more at any time. Purchased credits never expire while the service operates.', 'insightistic-marketing' ); ?></p>
			</div>
			<div class="ins-credits__item">
				<h3><?php esc_html_e( 'What happens when you run out', 'insightistic-marketing' ); ?></h3>
				<p><?php esc_html_e( 'You are never cut off mid-task. When the monthly allowance is gone, the credit metered actions pause and the app shows the exact cost of the next one, so you decide whether to buy a pack. Nothing bills you silently.', 'insightistic-marketing' ); ?></p>
			</div>
		</div>

		<?php if ( ! empty( $ins_packs ) ) : ?>
			<div class="ins-credits__packs">
				<h3><?php esc_html_e( 'Credit packs (one-time, non-expiring)', 'insightistic-marketing' ); ?></h3>
				<div class="ins-credits__pack-grid">
					<?php foreach ( $ins_packs as $ins_pack ) : ?>
						<div class="ins-credit-pack">
							<strong><?php echo esc_html( number_format_i18n( (int) ( $ins_pack['credits'] ?? 0 ) ) ); ?></strong>
							<span><?php echo esc_html( '$' . number_format_i18n( round( (int) ( $ins_pack['price_minor'] ?? 0 ) / 100 ) ) ); ?></span>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>

		<div class="ins-credits__policy">
			<h3><?php esc_html_e( 'Stacking, upgrading and redeeming', 'insightistic-marketing' ); ?></h3>
			<ul class="ins-jolly__list">
				<li><?php esc_html_e( 'AppSumo codes stack: buy two tiers of the same deal and the website, keyword, credit and message allowances add together, up to the deal’s maximum.', 'insightistic-marketing' ); ?></li>
				<li><?php esc_html_e( 'Upgrading a recurring plan takes effect immediately; the unused part of the current plan is credited towards the new one at checkout.', 'insightistic-marketing' ); ?></li>
				<li><?php esc_html_e( 'Redemption: buy on AppSumo, open the code link you receive, paste the license key on the claim page, then set a password. Your lifetime tier is applied to the new workspace automatically.', 'insightistic-marketing' ); ?></li>
				<li><?php esc_html_e( 'Already have an account? Sign in first and the same key attaches the license to your existing workspace instead of creating a second one.', 'insightistic-marketing' ); ?></li>
			</ul>
		</div>
	</div>
</section>
