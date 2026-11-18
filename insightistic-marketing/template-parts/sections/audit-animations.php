<?php
/** Site auditing motion story: crawl, diagnose, prioritize, monitor. */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="ins-section ins-audit-motion" aria-labelledby="ins-audit-motion-title">
	<div class="ins-container">
		<div class="ins-section__head">
			<p class="ins-eyebrow"><?php esc_html_e( 'Technical site intelligence', 'insightistic-marketing' ); ?></p>
			<h2 id="ins-audit-motion-title"><?php esc_html_e( 'Crawl → diagnose → prioritize → monitor', 'insightistic-marketing' ); ?></h2>
			<p class="ins-lead"><?php esc_html_e( 'See how the audit workspace turns technical signals into a reviewable list of next steps. Issues are surfaced for your team to assess; Insightistic does not claim to fix every issue automatically.', 'insightistic-marketing' ); ?></p>
		</div>
		<div class="ins-animation-grid">
			<?php echo insightistic_animation_visual( '05' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php echo insightistic_animation_visual( '06' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php echo insightistic_animation_visual( '07' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php echo insightistic_animation_visual( '08' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>
	</div>
</section>
