<?php
/**
 * AppSumo announcement bar (top).
 *
 * Rendered above the site header on every page. The bar is inert markup: the
 * countdown, the per-visitor evergreen window and the dismissal live in
 * assets/js/promo-bar.js so the page still renders with JS disabled.
 *
 * The end date is OPTIONAL. When JOLLY_PROMO_END (or the theme mod) is empty,
 * the countdown simply does not render - badge + CTA remain.
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$promo_end = '';
if ( defined( 'JOLLY_PROMO_END' ) ) {
	$promo_end = (string) JOLLY_PROMO_END;
} else {
	$promo_end = (string) get_theme_mod( 'jolly_promo_end', '' );
}

$promo_url = function_exists( 'insightistic_promo_url' )
	? insightistic_promo_url()
	: 'https://appsumo.com/';
?>
<div
	id="ins-promo-bar"
	class="ins-promo-bar"
	data-promo-end="<?php echo esc_attr( $promo_end ); ?>"
	role="region"
	aria-label="<?php esc_attr_e( 'AppSumo lifetime deal', 'insightistic-marketing' ); ?>"
	hidden
>
	<div class="ins-promo-bar__inner">
		<span class="ins-promo-bar__badge"><?php esc_html_e( 'LIFETIME DEAL', 'insightistic-marketing' ); ?></span>

		<p class="ins-promo-bar__text">
			<span class="ins-promo-bar__headline"><?php esc_html_e( 'Insightistic Lifetime Deal on AppSumo — from $49.', 'insightistic-marketing' ); ?></span>
			<span class="ins-promo-bar__sub"><?php esc_html_e( 'Agent JOLLY included in every tier.', 'insightistic-marketing' ); ?></span>
		</p>

		<span class="ins-promo-bar__countdown" data-promo-countdown hidden aria-live="polite">
			<span class="ins-promo-bar__countdown-label"><?php esc_html_e( 'Ends in', 'insightistic-marketing' ); ?></span>
			<span class="ins-promo-bar__clock" data-promo-clock>—</span>
		</span>

		<a class="ins-promo-bar__cta" href="<?php echo esc_url( $promo_url ); ?>" rel="noopener sponsored">
			<?php esc_html_e( 'Get the Lifetime Deal', 'insightistic-marketing' ); ?>
			<span aria-hidden="true">&rarr;</span>
		</a>

		<button
			type="button"
			class="ins-promo-bar__close"
			data-promo-dismiss
			aria-label="<?php esc_attr_e( 'Dismiss the AppSumo announcement', 'insightistic-marketing' ); ?>"
		>
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
</div>
