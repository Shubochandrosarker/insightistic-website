<?php
/**
 * Template Name: Lifetime Deal
 *
 * @package Insightistic_Marketing
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$catalog  = insightistic_public_catalog();
$ltd      = (array) ( $catalog['ltd'] ?? array() );
$campaign = (array) ( $ltd['campaign'] ?? array() );
$tiers    = (array) ( $ltd['plans'] ?? array() );
$state    = (string) ( $campaign['state'] ?? 'unknown' );
$sold_out = ! empty( $campaign['sold_out'] ) || 'closed' === $state;
$active   = 'active' === $state && ! $sold_out;
$format   = static function ( $value ) { return number_format_i18n( (int) $value ); };

get_header();
?>
<main id="main" class="ins-main ins-page-template ins-ltd">
	<section class="ins-section ins-ltd-hero" aria-labelledby="ins-ltd-title">
		<div class="ins-container ins-narrow ins-center">
			<p class="ins-eyebrow"><?php esc_html_e( 'Founding Angel Membership', 'insightistic-marketing' ); ?></p>
			<h1 id="ins-ltd-title" class="ins-page-hero__title"><?php esc_html_e( 'One payment. Lifetime access. Only 100 Founding Angels.', 'insightistic-marketing' ); ?></h1>
			<p class="ins-lead"><?php esc_html_e( 'Become one of Insightistic’s first 100 Founding Angels. Unlock your purchased core plan for the lifetime of the service, with monthly AI credits and usage allowances that renew automatically.', 'insightistic-marketing' ); ?></p>
			<div class="ins-ltd-hero__actions">
				<a class="ins-btn ins-btn--brand ins-btn--lg" href="#angel-plans"><?php esc_html_e( 'Compare Angel plans', 'insightistic-marketing' ); ?> <?php echo insightistic_icon( 'arrow-right', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
				<a class="ins-btn ins-btn--ghost ins-btn--lg" href="<?php echo esc_url( insightistic_login_url() ); ?>"><?php esc_html_e( 'Already have an account?', 'insightistic-marketing' ); ?></a>
			</div>
			<div class="ins-ltd-status ins-ltd-status--<?php echo esc_attr( $active ? 'active' : ( $sold_out ? 'closed' : 'unknown' ) ); ?>" role="status">
				<?php if ( $active ) : ?>
					<strong><?php esc_html_e( 'Campaign active', 'insightistic-marketing' ); ?></strong>
					<span><?php esc_html_e( 'Checkout confirms the remaining eligibility. The 100-license cap is shared across all Angel tiers.', 'insightistic-marketing' ); ?></span>
				<?php elseif ( $sold_out ) : ?>
					<strong><?php esc_html_e( 'Founding Angel campaign closed', 'insightistic-marketing' ); ?></strong>
					<span><?php esc_html_e( 'The first 100 lifetime licenses are no longer available. Regular subscriptions remain open.', 'insightistic-marketing' ); ?></span>
				<?php else : ?>
					<strong><?php esc_html_e( 'Availability is temporarily unavailable', 'insightistic-marketing' ); ?></strong>
					<span><?php esc_html_e( 'We will not guess remaining licenses. Check back later or compare regular plans while the live campaign status is unavailable.', 'insightistic-marketing' ); ?></span>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<section id="angel-plans" class="ins-section ins-ltd-plans" aria-labelledby="ins-ltd-plans-title">
		<div class="ins-container">
			<div class="ins-section__head">
				<p class="ins-eyebrow"><?php esc_html_e( 'Lifetime allowances', 'insightistic-marketing' ); ?></p>
				<h2 id="ins-ltd-plans-title"><?php esc_html_e( 'Choose the workspace you want to keep.', 'insightistic-marketing' ); ?></h2>
				<p class="ins-lead ins-center"><?php esc_html_e( 'The published monthly quotas are shared across connected sites. Monthly allowances renew; the purchase itself does not renew.', 'insightistic-marketing' ); ?></p>
			</div>

			<div class="ins-ltd-grid">
				<?php foreach ( $tiers as $tier ) : ?>
					<article class="ins-ltd-card<?php echo ! empty( $tier['featured'] ) ? ' ins-ltd-card--featured' : ''; ?>">
						<?php if ( ! empty( $tier['featured'] ) ) : ?><span class="ins-plan__badge"><?php esc_html_e( 'Recommended', 'insightistic-marketing' ); ?></span><?php endif; ?>
						<p class="ins-plan__eyebrow"><?php echo esc_html( $tier['sites'] ); ?> <?php esc_html_e( 'connected sites', 'insightistic-marketing' ); ?></p>
						<h3><?php echo esc_html( $tier['name'] ); ?></h3>
						<p class="ins-plan__price"><span class="ins-plan__amount"><?php echo esc_html( $tier['price'] ); ?></span><span class="ins-plan__per"><?php esc_html_e( 'once', 'insightistic-marketing' ); ?></span></p>
						<ul class="ins-plan__limits ins-plan__limits--ltd" aria-label="<?php esc_attr_e( 'Monthly allowances', 'insightistic-marketing' ); ?>">
							<li><strong><?php echo esc_html( $format( $tier['sites'] ?? 0 ) ); ?></strong><span><?php esc_html_e( 'sites', 'insightistic-marketing' ); ?></span></li>
							<li><strong><?php echo esc_html( $format( $tier['team_seats'] ?? 0 ) ); ?></strong><span><?php esc_html_e( 'team seats', 'insightistic-marketing' ); ?></span></li>
							<li><strong><?php echo esc_html( $format( $tier['limits']['crawl_pages'] ?? 0 ) ); ?></strong><span><?php esc_html_e( 'crawl pages/mo', 'insightistic-marketing' ); ?></span></li>
							<li><strong><?php echo esc_html( $format( $tier['limits']['browser_minutes'] ?? 0 ) ); ?></strong><span><?php esc_html_e( 'browser min/mo', 'insightistic-marketing' ); ?></span></li>
							<li><strong><?php echo esc_html( $format( $tier['limits']['keywords'] ?? 0 ) ); ?></strong><span><?php esc_html_e( 'keywords', 'insightistic-marketing' ); ?></span></li>
							<li><strong><?php echo esc_html( $format( $tier['limits']['ai_requests'] ?? 0 ) ); ?></strong><span><?php esc_html_e( 'AI requests/mo', 'insightistic-marketing' ); ?></span></li>
							<li><strong><?php echo esc_html( $format( $tier['monthly_ai_credits'] ?? 0 ) ); ?></strong><span><?php esc_html_e( 'AI credits/mo', 'insightistic-marketing' ); ?></span></li>
							<li><strong><?php echo esc_html( $format( $tier['limits']['reports'] ?? 0 ) ); ?></strong><span><?php esc_html_e( 'reports/mo', 'insightistic-marketing' ); ?></span></li>
						</ul>
						<ul class="ins-plan__features">
							<?php foreach ( (array) ( $tier['features'] ?? array() ) as $feature ) : ?><li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php echo esc_html( $feature ); ?></span></li><?php endforeach; ?>
						</ul>
						<?php if ( $active ) : ?>
							<a class="ins-btn ins-btn--brand ins-btn--block" href="<?php echo esc_url( insightistic_register_url( $tier['slug'] ) ); ?>"><?php printf( esc_html__( 'Choose %s', 'insightistic-marketing' ), esc_html( $tier['name'] ) ); ?></a>
						<?php else : ?>
							<a class="ins-btn ins-btn--ghost ins-btn--block" href="<?php echo esc_url( home_url( '/pricing/' ) ); ?>"><?php esc_html_e( 'View regular plans', 'insightistic-marketing' ); ?></a>
						<?php endif; ?>
					</article>
				<?php endforeach; ?>
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
				<article class="ins-step"><span class="ins-step__num">01</span><h3><?php esc_html_e( 'One payment', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'No subscription renewal for the purchased core Angel plan. Final checkout eligibility is handled by the Insightistic app.', 'insightistic-marketing' ); ?></p></article>
				<article class="ins-step"><span class="ins-step__num">02</span><h3><?php esc_html_e( 'Monthly allowances renew', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'Sites, crawl pages, browser minutes, keywords, AI requests, credits and reports follow the tier’s published monthly limits.', 'insightistic-marketing' ); ?></p></article>
				<article class="ins-step"><span class="ins-step__num">03</span><h3><?php esc_html_e( 'Purchased credits remain available', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'Additional Insight Credits are separate from the monthly Angel allowance and remain subject to the app’s terms and eligible actions.', 'insightistic-marketing' ); ?></p></article>
			</div>
			<p class="ins-ltd-terms-note"><?php esc_html_e( 'Any future WordPressistic product discount or benefit is shown only when its current eligibility terms are published and verified.', 'insightistic-marketing' ); ?></p>
		</div>
	</section>

	<section class="ins-section" aria-labelledby="ins-ltd-request-title">
		<div class="ins-container ins-narrow">
			<div class="ins-section__head">
				<p class="ins-eyebrow"><?php esc_html_e( 'Need help?', 'insightistic-marketing' ); ?></p>
				<h2 id="ins-ltd-request-title"><?php esc_html_e( 'Ask about Angel access', 'insightistic-marketing' ); ?></h2>
				<p class="ins-lead ins-center"><?php esc_html_e( 'Use the form for plan questions or checkout support. Do not submit payment details here.', 'insightistic-marketing' ); ?></p>
			</div>
			<?php insightistic_formistic_form( 'ltd' ); ?>
			<p class="ins-consent"><?php esc_html_e( 'By submitting this form, you agree to our', 'insightistic-marketing' ); ?> <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'insightistic-marketing' ); ?></a>.</p>
		</div>
	</section>

	<?php get_template_part( 'template-parts/sections/faq' ); ?>
</main>
<?php get_footer(); ?>
