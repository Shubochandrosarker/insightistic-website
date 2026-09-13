<?php
/** Contextual ecosystem cross-link band. */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<section class="ins-section ins-ecosystem-band" aria-labelledby="ins-ecosystem-band-title">
	<div class="ins-container ins-ecosystem-band__inner">
		<div>
			<p class="ins-eyebrow"><?php esc_html_e( 'Part of WordPressistic', 'insightistic-marketing' ); ?></p>
			<h2 id="ins-ecosystem-band-title"><?php esc_html_e( 'One ecosystem, focused products', 'insightistic-marketing' ); ?></h2>
			<p class="ins-lead"><?php esc_html_e( 'Insightistic handles the analytics layer. Explore the wider WordPressistic ecosystem when your business needs automation for conversations, travel operations, bookings, memberships or secure site connections.', 'insightistic-marketing' ); ?></p>
		</div>
		<div class="ins-ecosystem-band__links">
			<a class="ins-btn ins-btn--ghost" href="<?php echo esc_url( home_url( '/ecosystem/' ) ); ?>"><?php esc_html_e( 'Explore the ecosystem', 'insightistic-marketing' ); ?> <?php echo insightistic_icon( 'arrow-right', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
			<a class="ins-link" href="https://wordpressistic.com/" target="_blank" rel="noopener"><?php esc_html_e( 'WordPressistic', 'insightistic-marketing' ); ?> <?php echo insightistic_icon( 'arrow-right', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
			<a class="ins-link" href="https://tripistic.com/" target="_blank" rel="noopener"><?php esc_html_e( 'Tripistic', 'insightistic-marketing' ); ?> <?php echo insightistic_icon( 'arrow-right', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
		</div>
	</div>
</section>
