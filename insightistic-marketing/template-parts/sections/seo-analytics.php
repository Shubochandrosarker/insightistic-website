<?php
/**
 * SEO analytics section (split, reversed to alternate visual rhythm with traffic-analytics.php).
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="ins-section ins-split ins-split--reverse" aria-labelledby="ins-seo-title">
	<div class="ins-container ins-split__inner">
		<div class="ins-split__text">
			<p class="ins-eyebrow"><?php esc_html_e( 'SEO analytics', 'insightistic-marketing' ); ?></p>
			<h2 id="ins-seo-title"><?php esc_html_e( "See what's actually driving organic traffic — and what's slipping", 'insightistic-marketing' ); ?></h2>
			<p class="ins-lead"><?php esc_html_e( 'Search queries, impressions, clicks and average position, plus page-level performance for every indexed URL — one dashboard instead of switching between Search Console properties.', 'insightistic-marketing' ); ?></p>
			<ul class="ins-checklist">
				<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Query- and page-level clicks, impressions, CTR and position', 'insightistic-marketing' ); ?></li>
				<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Ranking-decline alerts so a drop gets caught early', 'insightistic-marketing' ); ?></li>
				<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Trend history for every page, not just a snapshot', 'insightistic-marketing' ); ?></li>
				<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Read alongside revenue and traffic — not in a separate tool', 'insightistic-marketing' ); ?></li>
			</ul>
			<a class="ins-link" href="<?php echo esc_url( home_url( '/seo-analytics' ) ); ?>"><?php esc_html_e( 'Explore SEO analytics', 'insightistic-marketing' ); ?> <?php echo insightistic_icon( 'arrow-right', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
		</div>
		<div class="ins-split__visual">
			<div class="ins-animation-stack">
				<?php echo insightistic_animation_visual( '03' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<?php echo insightistic_animation_visual( '04' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
		</div>
	</div>
</section>
