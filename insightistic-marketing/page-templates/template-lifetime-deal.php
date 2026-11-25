<?php
/**
 * Template Name: Lifetime Deal
 *
 * @package Insightistic_Marketing
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();
?>
<main id="main" class="ins-main ins-page-template ins-ltd">
	<section class="ins-section ins-ltd-hero" aria-labelledby="ins-ltd-title">
		<div class="ins-container ins-narrow ins-center">
			<p class="ins-eyebrow"><?php esc_html_e( 'Lifetime deal on AppSumo', 'insightistic-marketing' ); ?></p>
			<h1 id="ins-ltd-title" class="ins-page-hero__title"><?php esc_html_e( 'One payment. Lifetime access. Every tier includes Agent JOLLEY.', 'insightistic-marketing' ); ?></h1>
			<p class="ins-lead"><?php esc_html_e( 'Get the Insightistic lifetime deal on AppSumo — five tiers, from $49. Your purchased core plan lasts the lifetime of the service, with monthly AI credits and usage allowances that renew automatically.', 'insightistic-marketing' ); ?></p>
			<div class="ins-ltd-hero__actions">
				<a class="ins-btn ins-btn--brand ins-btn--lg" href="<?php echo esc_url( insightistic_promo_url( 'w' ) ); ?>" rel="sponsored noopener" target="_blank"><?php esc_html_e( 'Get the Lifetime Deal', 'insightistic-marketing' ); ?> <?php echo insightistic_icon( 'arrow-right', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
				<a class="ins-btn ins-btn--ghost ins-btn--lg" href="<?php echo esc_url( insightistic_login_url() ); ?>"><?php esc_html_e( 'Already have an account?', 'insightistic-marketing' ); ?></a>
			</div>
		</div>
	</section>

	<section class="ins-section ins-ltd-promise" aria-labelledby="ins-ltd-promise-title">
		<div class="ins-container ins-narrow">
			<div class="ins-section__head">
				<p class="ins-eyebrow"><?php esc_html_e( 'What lifetime means here', 'insightistic-marketing' ); ?></p>
				<h2 id="ins-ltd-promise-title"><?php esc_html_e( 'A clear purchase, with clear boundaries.', 'insightistic-marketing' ); ?></h2>
			</div>
			<div class="ins-stepgrid">
				<article class="ins-step"><span class="ins-step__num">01</span><h3><?php esc_html_e( 'One payment', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'No subscription renewal for the purchased lifetime plan. Final checkout eligibility is handled by AppSumo and the Insightistic app.', 'insightistic-marketing' ); ?></p></article>
				<article class="ins-step"><span class="ins-step__num">02</span><h3><?php esc_html_e( 'Monthly allowances renew', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'Sites, crawl pages, browser minutes, keywords, AI requests, credits and reports follow the tier’s published monthly limits.', 'insightistic-marketing' ); ?></p></article>
				<article class="ins-step"><span class="ins-step__num">03</span><h3><?php esc_html_e( 'Purchased credits remain available', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'Additional Insight Credits are separate from the monthly allowance and remain subject to the app’s terms and eligible actions.', 'insightistic-marketing' ); ?></p></article>
			</div>
			<p class="ins-ltd-terms-note"><?php esc_html_e( 'Any future WordPressistic product discount or benefit is shown only when its current eligibility terms are published and verified.', 'insightistic-marketing' ); ?></p>
		</div>
	</section>

	<section class="ins-section" aria-labelledby="ins-ltd-request-title">
		<div class="ins-container ins-narrow">
			<div class="ins-section__head">
				<p class="ins-eyebrow"><?php esc_html_e( 'Need help?', 'insightistic-marketing' ); ?></p>
				<h2 id="ins-ltd-request-title"><?php esc_html_e( 'Questions about the deal?', 'insightistic-marketing' ); ?></h2>
				<p class="ins-lead ins-center"><?php esc_html_e( 'Use the form for plan questions or checkout support. Do not submit payment details here.', 'insightistic-marketing' ); ?></p>
			</div>
			<?php insightistic_formistic_form( 'ltd' ); ?>
			<p class="ins-consent"><?php esc_html_e( 'By submitting this form, you agree to our', 'insightistic-marketing' ); ?> <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'insightistic-marketing' ); ?></a>.</p>
		</div>
	</section>

	<?php get_template_part( 'template-parts/sections/faq' ); ?>
</main>
<?php get_footer(); ?>
