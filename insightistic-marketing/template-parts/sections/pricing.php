<?php
/** Pricing section: Free Connected, subscriptions, resource comparison and credits. */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$catalog      = insightistic_public_catalog();
$plans        = (array) $catalog['plans'];
$free         = (array) $catalog['free'];
$credit_packs = (array) $catalog['credit_packs'];
$format       = static function ( $value ) { return number_format_i18n( (int) $value ); };
$comparison_rows = array(
	array( 'label' => 'Connected sites', 'key' => 'sites' ),
	array( 'label' => 'Team seats', 'key' => 'team_seats' ),
	array( 'label' => 'HTTP crawl pages/month', 'key' => 'crawl_pages' ),
	array( 'label' => 'Browser minutes/month', 'key' => 'browser_minutes' ),
	array( 'label' => 'Tracked keywords', 'key' => 'keywords' ),
	array( 'label' => 'Standard AI requests/month', 'key' => 'ai_requests' ),
	array( 'label' => 'AI credits/month', 'key' => 'ai_credits' ),
	array( 'label' => 'Reports/month', 'key' => 'reports' ),
);
?>
<section class="ins-section ins-pricing" id="pricing" aria-labelledby="ins-pricing-title">
	<div class="ins-container">
		<div class="ins-section__head">
			<p class="ins-eyebrow"><?php esc_html_e( 'Plans built around usage you can see', 'insightistic-marketing' ); ?></p>
			<h2 id="ins-pricing-title"><?php esc_html_e( 'Start free. Add the intelligence your business needs.', 'insightistic-marketing' ); ?></h2>
			<p class="ins-lead ins-center"><?php esc_html_e( 'Free Connected is a real free tier. Paid plans add cloud resources, connected sites, reports, team access and monthly AI allowances.', 'insightistic-marketing' ); ?></p>
			<div class="ins-pricing-toggle" data-period="monthly" role="group" aria-label="<?php esc_attr_e( 'Billing period', 'insightistic-marketing' ); ?>">
				<button type="button" class="is-active" data-period="monthly" aria-pressed="true"><?php esc_html_e( 'Monthly', 'insightistic-marketing' ); ?></button>
				<button type="button" data-period="yearly" aria-pressed="false"><?php esc_html_e( 'Annual', 'insightistic-marketing' ); ?> <span class="ins-save"><?php esc_html_e( 'save on annual billing', 'insightistic-marketing' ); ?></span></button>
			</div>
		</div>

		<div class="ins-pricing__free-wrap">
			<article class="ins-plan ins-plan--free">
				<div>
					<span class="ins-plan__eyebrow"><?php esc_html_e( 'Free entry', 'insightistic-marketing' ); ?></span>
					<h3 class="ins-plan__name"><?php echo esc_html( $free['name'] ?? 'Free Connected' ); ?></h3>
					<p class="ins-plan__tagline"><?php echo esc_html( $free['tagline'] ?? 'Start with the free plugin and one connected site.' ); ?></p>
					<p class="ins-plan__price"><span class="ins-plan__amount"><?php echo esc_html( $free['monthly'] ?? '$0' ); ?></span><span class="ins-plan__per"><?php esc_html_e( 'forever', 'insightistic-marketing' ); ?></span></p>
					<ul class="ins-plan__features">
						<?php foreach ( (array) ( $free['features'] ?? array() ) as $feature ) : ?>
							<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php echo esc_html( $feature ); ?></span></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<a class="ins-btn ins-btn--ghost" href="<?php echo esc_url( insightistic_register_url() ); ?>"><?php esc_html_e( 'Create a free account', 'insightistic-marketing' ); ?></a>
			</article>
			<div class="ins-pricing__free-copy">
				<p class="ins-eyebrow"><?php esc_html_e( 'Free WordPress plugin', 'insightistic-marketing' ); ?></p>
				<h3><?php esc_html_e( 'Useful before you upgrade.', 'insightistic-marketing' ); ?></h3>
				<p><?php esc_html_e( 'Install the free plugin to use local WordPress and WooCommerce analytics. Connect a Free Connected account when you want cloud access and basic AI insights. Paid tiers add resources; they do not erase the value of the plugin.', 'insightistic-marketing' ); ?></p>
				<a class="ins-link" href="https://github.com/Wordpressistic/insightistic/releases/latest"><?php esc_html_e( 'Get the free plugin', 'insightistic-marketing' ); ?> <?php echo insightistic_icon( 'arrow-right', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
			</div>
		</div>

		<div class="ins-grid ins-grid--pricing">
			<?php foreach ( $plans as $plan ) : ?>
				<?php get_template_part( 'template-parts/cards/pricing-card', null, array( 'plan' => $plan ) ); ?>
			<?php endforeach; ?>
		</div>

		<div class="ins-pricing__catalog-note">
			<?php printf( esc_html__( 'Paid plans include the current %d-day trial listed by the catalog. Billing, eligibility and final entitlements are confirmed in the Insightistic app.', 'insightistic-marketing' ), (int) ( $catalog['trial_days'] ?? 14 ) ); ?>
		</div>

		<div class="ins-comparison" aria-labelledby="ins-comparison-title">
			<div class="ins-section__head ins-section__head--compact">
				<p class="ins-eyebrow"><?php esc_html_e( 'Compare resources', 'insightistic-marketing' ); ?></p>
				<h3 id="ins-comparison-title"><?php esc_html_e( 'Know what each plan includes each month.', 'insightistic-marketing' ); ?></h3>
			</div>
			<div class="ins-comparison__scroll">
				<table class="ins-comparison__table">
					<thead><tr><th scope="col"><?php esc_html_e( 'Resource', 'insightistic-marketing' ); ?></th><?php foreach ( $plans as $plan ) : ?><th scope="col"><?php echo esc_html( $plan['name'] ); ?></th><?php endforeach; ?></tr></thead>
					<tbody>
						<?php foreach ( $comparison_rows as $row ) : ?>
							<tr><th scope="row"><?php echo esc_html( $row['label'] ); ?></th><?php foreach ( $plans as $plan ) : ?><td><?php echo esc_html( $format( $plan['limits'][ $row['key'] ] ?? 0 ) ); ?></td><?php endforeach; ?></tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>

		<div class="ins-credit-band" aria-labelledby="ins-credit-title">
			<div>
				<p class="ins-eyebrow"><?php esc_html_e( 'Insight Credits', 'insightistic-marketing' ); ?></p>
				<h3 id="ins-credit-title"><?php esc_html_e( 'Keep AI usage flexible.', 'insightistic-marketing' ); ?></h3>
				<p><?php esc_html_e( 'Monthly plan allowances renew. Purchased credits remain available for eligible AI actions when you need more room.', 'insightistic-marketing' ); ?></p>
			</div>
			<div class="ins-credit-band__packs">
				<?php foreach ( $credit_packs as $pack ) : ?>
					<div class="ins-credit-pack"><strong><?php echo esc_html( $format( $pack['credits'] ?? 0 ) ); ?></strong><span><?php echo esc_html( '$' . $format( round( (int) ( $pack['price_minor'] ?? 0 ) / 100 ) ) ); ?></span></div>
				<?php endforeach; ?>
			</div>
		</div>

		<p class="ins-center ins-pricing__foot"><a class="ins-link" href="<?php echo esc_url( home_url( '/pricing/' ) ); ?>"><?php esc_html_e( 'See full plan details and FAQ', 'insightistic-marketing' ); ?> <?php echo insightistic_icon( 'arrow-right', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a></p>
	</div>
</section>
