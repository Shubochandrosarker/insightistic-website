<?php
/**
 * Pricing card. Pass via: get_template_part(..., null, array('plan' => array(...))).
 * Renders both monthly & yearly prices; pricing-toggle.js swaps the visible one.
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$plan = isset( $args['plan'] ) ? $args['plan'] : array();
if ( empty( $plan ) ) {
	return;
}
$featured = ! empty( $plan['featured'] );
$plan_slug = isset( $plan['slug'] ) ? sanitize_key( (string) $plan['slug'] ) : '';
?>
<article class="ins-plan<?php echo $featured ? ' ins-plan--featured' : ''; ?><?php echo 'agency_pro' === $plan_slug ? ' ins-plan--agency-pro' : ''; ?>">
	<?php if ( $featured ) : ?>
		<span class="ins-plan__badge"><?php esc_html_e( 'Most popular', 'insightistic-marketing' ); ?></span>
	<?php endif; ?>

	<h3 class="ins-plan__name"><?php echo esc_html( $plan['name'] ); ?></h3>
	<p class="ins-plan__tagline"><?php echo esc_html( $plan['tagline'] ); ?></p>

	<p class="ins-plan__price">
		<span class="ins-plan__amount"
			data-monthly="<?php echo esc_attr( $plan['monthly'] ); ?>"
			data-yearly="<?php echo esc_attr( $plan['yearly'] ); ?>"
			aria-live="polite"><?php echo esc_html( $plan['monthly'] ); ?></span>
		<span class="ins-plan__per"><?php esc_html_e( '/mo', 'insightistic-marketing' ); ?></span>
	</p>
	<p class="ins-plan__billing-note"><?php esc_html_e( 'USD · billed per account', 'insightistic-marketing' ); ?></p>

	<?php if ( ! empty( $plan['limits'] ) ) : ?>
		<ul class="ins-plan__limits" aria-label="<?php esc_attr_e( 'Monthly allowances', 'insightistic-marketing' ); ?>">
			<li><strong><?php echo esc_html( number_format_i18n( (int) $plan['limits']['sites'] ) ); ?></strong><span><?php esc_html_e( 'site(s)', 'insightistic-marketing' ); ?></span></li>
			<li><strong><?php echo esc_html( number_format_i18n( (int) $plan['limits']['team_seats'] ) ); ?></strong><span><?php esc_html_e( 'team seat(s)', 'insightistic-marketing' ); ?></span></li>
			<li><strong><?php echo esc_html( number_format_i18n( (int) $plan['limits']['ai_credits'] ) ); ?></strong><span><?php esc_html_e( 'AI credits/mo', 'insightistic-marketing' ); ?></span></li>
		</ul>
	<?php endif; ?>

	<ul class="ins-plan__features">
		<?php foreach ( (array) $plan['features'] as $feature ) : ?>
			<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php echo esc_html( $feature ); ?></span></li>
		<?php endforeach; ?>
	</ul>

	<a class="ins-btn ins-btn--brand ins-btn--block" href="<?php echo esc_url( insightistic_register_url( $plan['slug'] ) ); ?>">
		<?php esc_html_e( 'Choose plan', 'insightistic-marketing' ); ?>
	</a>
</article>
