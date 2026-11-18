<?php
/**
 * Traffic analytics section (split: text + visual).
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="ins-section ins-split" aria-labelledby="ins-traffic-title">
	<div class="ins-container ins-split__inner">
		<div class="ins-split__text">
			<p class="ins-eyebrow"><?php esc_html_e( 'Traffic analytics', 'insightistic-marketing' ); ?></p>
			<h2 id="ins-traffic-title"><?php esc_html_e( 'Know where your traffic comes from — and where it drops off', 'insightistic-marketing' ); ?></h2>
			<p class="ins-lead"><?php esc_html_e( 'Sessions, sources and landing pages, trended daily and broken down by channel — so a traffic drop shows up before it shows up in revenue.', 'insightistic-marketing' ); ?></p>
			<ul class="ins-checklist">
				<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Sessions, pageviews and unique visitors trended daily', 'insightistic-marketing' ); ?></li>
				<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Source, medium and channel breakdown', 'insightistic-marketing' ); ?></li>
				<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Landing page, device and geography dimensions', 'insightistic-marketing' ); ?></li>
				<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Automatic alerts on unexpected traffic drops or spikes', 'insightistic-marketing' ); ?></li>
			</ul>
			<a class="ins-link" href="<?php echo esc_url( home_url( '/traffic-analytics' ) ); ?>"><?php esc_html_e( 'Explore traffic analytics', 'insightistic-marketing' ); ?> <?php echo insightistic_icon( 'arrow-right', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
		</div>
		<div class="ins-split__visual">
			<div class="ins-animation-stack">
				<?php echo insightistic_animation_visual( '13' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<?php echo insightistic_animation_visual( '14' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
		</div>
	</div>
</section>
