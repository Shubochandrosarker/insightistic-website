<?php
/**
 * "Without Insightistic" vs "With Insightistic" comparison (split panel,
 * two checklists — deliberately not naming specific competitor products).
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="ins-section ins-split" aria-labelledby="ins-comparison-title">
	<div class="ins-container ins-split__inner">
		<div class="ins-split__text">
			<p class="ins-eyebrow"><?php esc_html_e( 'Without Insightistic', 'insightistic-marketing' ); ?></p>
			<h2 id="ins-comparison-title"><?php esc_html_e( 'Spreadsheets, five tabs and a guess', 'insightistic-marketing' ); ?></h2>
			<ul class="ins-checklist">
				<li><?php echo insightistic_icon( 'x', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'WooCommerce revenue in one place, Search Console in another, PageSpeed in a third', 'insightistic-marketing' ); ?></li>
				<li><?php echo insightistic_icon( 'x', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'You find out traffic dropped days later, from a revenue dip', 'insightistic-marketing' ); ?></li>
				<li><?php echo insightistic_icon( 'x', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Client reports are a manual screenshot-and-export chore every month', 'insightistic-marketing' ); ?></li>
				<li><?php echo insightistic_icon( 'x', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Numbers, no explanation of what changed or why it matters', 'insightistic-marketing' ); ?></li>
			</ul>
		</div>
		<div class="ins-split__visual">
			<p class="ins-eyebrow ins-eyebrow--accent"><?php esc_html_e( 'With Insightistic', 'insightistic-marketing' ); ?></p>
			<ul class="ins-checklist">
				<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Commerce, traffic, SEO and performance in one dashboard', 'insightistic-marketing' ); ?></li>
				<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Automatic alerts the moment a metric moves outside the normal range', 'insightistic-marketing' ); ?></li>
				<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Branded reports generated and delivered on a schedule, automatically', 'insightistic-marketing' ); ?></li>
				<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'AI insights that say what changed, why it matters, and what to do next', 'insightistic-marketing' ); ?></li>
			</ul>
		</div>
	</div>
</section>
