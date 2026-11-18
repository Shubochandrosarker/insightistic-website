<?php
/**
 * AI insights section (split, visual-first / reversed).
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<section class="ins-section ins-split ins-split--reverse" aria-labelledby="ins-ai-title">
	<div class="ins-container ins-split__inner">
		<div class="ins-split__text">
			<p class="ins-eyebrow ins-eyebrow--accent"><?php esc_html_e( 'AI business insights', 'insightistic-marketing' ); ?></p>
			<h2 id="ins-ai-title"><?php esc_html_e( 'What changed, why it matters, what to do next', 'insightistic-marketing' ); ?></h2>
			<p class="ins-lead"><?php esc_html_e( 'Insightistic explains your numbers in plain language and recommends the next action — not just another chart to interpret yourself.', 'insightistic-marketing' ); ?></p>
			<a class="ins-link" href="<?php echo esc_url( home_url( '/ai-insights' ) ); ?>"><?php esc_html_e( 'See how AI insights work', 'insightistic-marketing' ); ?> <?php echo insightistic_icon( 'arrow-right', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
		</div>
		<div class="ins-split__visual">
			<div class="ins-animation-stack">
				<?php echo insightistic_animation_visual( '09' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<?php echo insightistic_animation_visual( '10' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
		</div>
	</div>
</section>
