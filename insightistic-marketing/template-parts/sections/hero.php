<?php
/**
 * Hero section.
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$eyebrow  = insightistic_option( 'insightistic_hero_eyebrow', __( 'AI business intelligence for WordPress & WooCommerce', 'insightistic-marketing' ) );
$title    = insightistic_option( 'insightistic_hero_title', __( 'Your business, handled. Even at 3 AM.', 'insightistic-marketing' ) );
$subtitle = insightistic_option( 'insightistic_hero_subtitle', __( 'Agent JOLLY works your analytics while you sleep: it connects Search Console, GA4, WooCommerce, your site audit and your knowledge base, then hands you a brief with the one decision that matters today.', 'insightistic-marketing' ) );
?>
<section class="ins-section ins-hero" aria-labelledby="ins-hero-title">
	<div class="ins-container ins-hero__inner">
		<p class="ins-eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
		<h1 id="ins-hero-title" class="ins-hero__title"><?php echo esc_html( $title ); ?></h1>
		<p class="ins-hero__subtitle"><?php echo esc_html( $subtitle ); ?></p>

		<div class="ins-hero__actions">
			<a class="ins-btn ins-btn--brand ins-btn--lg" href="<?php echo esc_url( insightistic_register_url() ); ?>">
				<?php esc_html_e( 'Start free', 'insightistic-marketing' ); ?>
				<?php echo insightistic_icon( 'arrow-right', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</a>
			<a class="ins-btn ins-btn--ghost ins-btn--lg" href="<?php echo esc_url( home_url( '/pricing' ) ); ?>">
				<?php esc_html_e( 'Explore features', 'insightistic-marketing' ); ?>
			</a>
		</div>

		<div class="ins-hero__supporting-links" aria-label="<?php esc_attr_e( 'Getting started options', 'insightistic-marketing' ); ?>">
			<span><?php esc_html_e( 'Free WordPress plugin', 'insightistic-marketing' ); ?></span>
			<span><?php esc_html_e( 'Free Connected account', 'insightistic-marketing' ); ?></span>
			<a href="<?php echo esc_url( home_url( '/pricing/' ) ); ?>"><?php esc_html_e( 'Compare pricing', 'insightistic-marketing' ); ?> <?php echo insightistic_icon( 'arrow-right', 15 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
		</div>

		<p class="ins-hero__note"><?php esc_html_e( 'Start with the plugin and a free account. Add cloud resources as your business grows.', 'insightistic-marketing' ); ?></p>
	</div>
</section>
