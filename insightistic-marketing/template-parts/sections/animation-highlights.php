<?php
/** Homepage motion highlights: search movement and connected intelligence. */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="ins-section ins-motion-highlights" aria-labelledby="ins-motion-highlights-title">
	<div class="ins-container">
		<div class="ins-section__head">
			<p class="ins-eyebrow"><?php esc_html_e( 'Signals, connected', 'insightistic-marketing' ); ?></p>
			<h2 id="ins-motion-highlights-title"><?php esc_html_e( 'See the product before you connect a site', 'insightistic-marketing' ); ?></h2>
			<p class="ins-lead"><?php esc_html_e( 'These illustrative product views show how Insightistic brings search, health, performance and AI context into one workspace.', 'insightistic-marketing' ); ?></p>
		</div>
		<div class="ins-animation-grid">
			<?php echo insightistic_animation_visual( '02' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php echo insightistic_animation_visual( '15' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>
	</div>
</section>
