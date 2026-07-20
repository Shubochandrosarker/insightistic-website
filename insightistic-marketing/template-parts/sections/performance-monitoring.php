<?php
/**
 * Performance monitoring section (split: text + visual).
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="ins-section ins-split" aria-labelledby="ins-performance-title">
	<div class="ins-container ins-split__inner">
		<div class="ins-split__text">
			<p class="ins-eyebrow"><?php esc_html_e( 'Performance monitoring', 'insightistic-marketing' ); ?></p>
			<h2 id="ins-performance-title"><?php esc_html_e( 'Catch a slow store before it costs you conversions', 'insightistic-marketing' ); ?></h2>
			<p class="ins-lead"><?php esc_html_e( 'Core Web Vitals and page-speed history tracked automatically, plus broken-link monitoring — no manual audits, no waiting for a customer to complain.', 'insightistic-marketing' ); ?></p>
			<ul class="ins-checklist">
				<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Core Web Vitals and performance score, tracked over time', 'insightistic-marketing' ); ?></li>
				<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Regressions flagged automatically, not discovered by accident', 'insightistic-marketing' ); ?></li>
				<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Broken-link and 404 monitoring across the whole store', 'insightistic-marketing' ); ?></li>
				<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'History that proves whether a fix actually worked', 'insightistic-marketing' ); ?></li>
			</ul>
			<a class="ins-link" href="<?php echo esc_url( home_url( '/performance-monitoring' ) ); ?>"><?php esc_html_e( 'Explore performance monitoring', 'insightistic-marketing' ); ?> <?php echo insightistic_icon( 'arrow-right', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
		</div>
		<div class="ins-split__visual">
			<div class="ins-panel-card">
				<div class="ins-preview__metrics ins-preview__metrics--2">
					<?php
					foreach ( array(
						array( 'label' => 'Performance score', 'value' => '86', 'delta' => '+4 pts' ),
						array( 'label' => 'Largest contentful paint', 'value' => '2.1s', 'delta' => '-0.3s' ),
						array( 'label' => 'Broken links', 'value' => '2', 'delta' => '-3' ),
						array( 'label' => 'Uptime', 'value' => '99.97%', 'delta' => '+0.02%' ),
					) as $metric ) {
						get_template_part( 'template-parts/cards/metric-card', null, $metric );
					}
					?>
				</div>
			</div>
		</div>
	</div>
</section>
