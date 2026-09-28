<?php
/**
 * Pricing section (monthly/yearly toggle + plan cards).
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$plans = insightistic_pricing_plans();
?>
<section class="ins-section ins-pricing" id="pricing" aria-labelledby="ins-pricing-title">
	<div class="ins-container">
		<div class="ins-section__head">
			<p class="ins-eyebrow"><?php esc_html_e( 'Pricing', 'insightistic-marketing' ); ?></p>
			<h2 id="ins-pricing-title"><?php esc_html_e( 'Simple plans that scale with you', 'insightistic-marketing' ); ?></h2>
			<p class="ins-lead ins-center"><?php esc_html_e( 'Every plan includes a 14-day free trial. No credit card required.', 'insightistic-marketing' ); ?></p>

			<div class="ins-pricing-toggle" data-period="monthly" role="group" aria-label="<?php esc_attr_e( 'Billing period', 'insightistic-marketing' ); ?>">
				<button type="button" class="is-active" data-period="monthly" aria-pressed="true"><?php esc_html_e( 'Monthly', 'insightistic-marketing' ); ?></button>
				<button type="button" data-period="yearly" aria-pressed="false"><?php esc_html_e( 'Annual', 'insightistic-marketing' ); ?> <span class="ins-save"><?php esc_html_e( '2 months free', 'insightistic-marketing' ); ?></span></button>
			</div>
		</div>

		<div class="ins-grid ins-grid--pricing">
			<?php
			foreach ( $plans as $plan ) {
				get_template_part( 'template-parts/cards/pricing-card', null, array( 'plan' => $plan ) );
			}
			?>
		</div>

		<aside class="ins-pricing-plugin" aria-labelledby="ins-pricing-plugin-title">
			<div class="ins-pricing-plugin__copy">
				<p class="ins-eyebrow"><?php esc_html_e( 'Free WordPress plugin', 'insightistic-marketing' ); ?></p>
				<h3 id="ins-pricing-plugin-title"><?php esc_html_e( 'Start with Insightistic on your site', 'insightistic-marketing' ); ?></h3>
				<p><?php esc_html_e( 'Install the free plugin to use its WordPress features. Connect a free Insightistic account when you are ready to sync site data and use cloud features.', 'insightistic-marketing' ); ?></p>
			</div>
			<div class="ins-pricing-plugin__actions">
				<a class="ins-btn ins-btn--brand" href="https://github.com/Wordpressistic/insightistic/releases/latest"><?php esc_html_e( 'Get the free plugin', 'insightistic-marketing' ); ?></a>
				<a class="ins-link" href="<?php echo esc_url( insightistic_register_url() ); ?>"><?php esc_html_e( 'Create a free account', 'insightistic-marketing' ); ?></a>
			</div>
		</aside>

		<p class="ins-center ins-pricing__foot">
			<a class="ins-link" href="<?php echo esc_url( home_url( '/pricing' ) ); ?>"><?php esc_html_e( 'Compare all plan features', 'insightistic-marketing' ); ?> <?php echo insightistic_icon( 'arrow-right', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
		</p>
	</div>
</section>
