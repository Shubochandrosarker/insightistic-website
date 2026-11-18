<?php
/**
 * Template Name: Lifetime Deal
 *
 * AppSumo is the only current lifetime offer. Stripe subscriptions remain on
 * the regular pricing page and are never mixed into this redemption page.
 *
 * @package Insightistic_Marketing
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$catalog  = insightistic_public_catalog();
$appsumo  = (array) ( $catalog['appsumo'] ?? array() );
$tiers    = (array) ( $appsumo['plans'] ?? array() );
$campaign = (array) ( $appsumo['campaign'] ?? array() );
$state    = (string) ( $campaign['state'] ?? 'active' );
$sold_out = ! empty( $campaign['sold_out'] ) || 'closed' === $state;
$active   = ! $sold_out;
$format   = static function ( $value ) { return number_format_i18n( (int) $value ); };

if ( function_exists( 'did_action' ) && ! did_action( 'wp_enqueue_scripts' ) ) {
	do_action( 'wp_enqueue_scripts' );
}
remove_all_actions( 'wp_head' );
add_action(
	'wp_head',
	static function () {
		$base = trailingslashit( get_stylesheet_directory_uri() ) . 'assets/css/';
		$ver  = defined( 'INSIGHTISTIC_MARKETING_VERSION' ) ? INSIGHTISTIC_MARKETING_VERSION : '1.6.4';
		foreach ( array( 'theme.css', 'blocks.css', 'responsive.css' ) as $file ) {
			printf( '<link rel="stylesheet" href="%s" type="text/css" media="all" />%s', esc_url( add_query_arg( 'ver', $ver, $base . $file ) ), PHP_EOL );
		}
	},
	8
);

get_header();
?>
<main id="main" class="ins-main ins-page-template ins-ltd">
	<section class="ins-section ins-ltd-hero" aria-labelledby="ins-ltd-title">
		<div class="ins-container ins-narrow ins-center">
			<p class="ins-eyebrow"><?php esc_html_e( 'AppSumo lifetime deal', 'insightistic-marketing' ); ?></p>
			<h1 id="ins-ltd-title" class="ins-page-hero__title"><?php esc_html_e( 'Choose your Insightistic lifetime tier.', 'insightistic-marketing' ); ?></h1>
			<p class="ins-lead"><?php esc_html_e( 'AppSumo is the only current lifetime offer. Choose Tier 1–5 for the connected sites, AI actions, credits, reports and crawl capacity your business needs.', 'insightistic-marketing' ); ?></p>
			<div class="ins-ltd-hero__actions">
				<a class="ins-btn ins-btn--brand ins-btn--lg" href="#appsumo-plans"><?php esc_html_e( 'Compare AppSumo tiers', 'insightistic-marketing' ); ?> <?php echo insightistic_icon( 'arrow-right', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
				<a class="ins-btn ins-btn--ghost ins-btn--lg" href="<?php echo esc_url( insightistic_login_url() ); ?>"><?php esc_html_e( 'Already have an account?', 'insightistic-marketing' ); ?></a>
			</div>
			<div class="ins-ltd-status ins-ltd-status--<?php echo esc_attr( $active ? 'active' : 'closed' ); ?>" role="status">
				<?php if ( $active ) : ?>
					<strong><?php esc_html_e( 'AppSumo redemption active', 'insightistic-marketing' ); ?></strong>
					<span><?php esc_html_e( 'AppSumo manages purchase and redemption. Insightistic activates the lifetime entitlement after a valid redemption.', 'insightistic-marketing' ); ?></span>
				<?php else : ?>
					<strong><?php esc_html_e( 'AppSumo campaign closed', 'insightistic-marketing' ); ?></strong>
					<span><?php echo esc_html( $campaign['sold_out_message'] ?? 'The AppSumo lifetime licenses are no longer available.' ); ?></span>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<section id="appsumo-plans" class="ins-section ins-ltd-plans" aria-labelledby="ins-ltd-plans-title">
		<div class="ins-container">
			<div class="ins-section__head">
				<p class="ins-eyebrow"><?php esc_html_e( 'AppSumo lifetime allowances', 'insightistic-marketing' ); ?></p>
				<h2 id="ins-ltd-plans-title"><?php esc_html_e( 'Compare every AppSumo tier clearly.', 'insightistic-marketing' ); ?></h2>
				<p class="ins-lead ins-center"><?php esc_html_e( 'Each tier is a one-time AppSumo redemption. Monthly allowances renew while the entitlement remains active.', 'insightistic-marketing' ); ?></p>
			</div>

			<div class="ins-ltd-grid">
				<?php foreach ( $tiers as $tier ) : ?>
					<article class="ins-ltd-card<?php echo ! empty( $tier['featured'] ) ? ' ins-ltd-card--featured' : ''; ?>">
						<?php if ( ! empty( $tier['featured'] ) ) : ?><span class="ins-plan__badge"><?php esc_html_e( 'Most popular', 'insightistic-marketing' ); ?></span><?php endif; ?>
						<p class="ins-plan__eyebrow"><?php echo esc_html( $tier['sites'] ); ?> <?php esc_html_e( 'connected sites', 'insightistic-marketing' ); ?></p>
						<h3><?php echo esc_html( $tier['name'] ); ?></h3>
						<p class="ins-plan__price"><span class="ins-plan__amount"><?php echo esc_html( $tier['price'] ); ?></span><span class="ins-plan__per"><?php esc_html_e( 'once', 'insightistic-marketing' ); ?></span></p>
						<ul class="ins-plan__limits ins-plan__limits--ltd" aria-label="<?php esc_attr_e( 'Monthly allowances', 'insightistic-marketing' ); ?>">
							<li><strong><?php echo esc_html( $format( $tier['sites'] ?? 0 ) ); ?></strong><span><?php esc_html_e( 'sites', 'insightistic-marketing' ); ?></span></li>
							<li><strong><?php echo esc_html( $tier['team_seats'] ? $format( $tier['team_seats'] ) : 'Unlimited' ); ?></strong><span><?php esc_html_e( 'team members', 'insightistic-marketing' ); ?></span></li>
							<li><strong><?php echo esc_html( $format( $tier['limits']['crawl_pages'] ?? 0 ) ); ?></strong><span><?php esc_html_e( 'crawl pages/mo', 'insightistic-marketing' ); ?></span></li>
							<li><strong><?php echo esc_html( $format( $tier['limits']['browser_minutes'] ?? 0 ) ); ?></strong><span><?php esc_html_e( 'browser min/mo', 'insightistic-marketing' ); ?></span></li>
							<li><strong><?php echo esc_html( $format( $tier['limits']['keywords'] ?? 0 ) ); ?></strong><span><?php esc_html_e( 'keywords', 'insightistic-marketing' ); ?></span></li>
							<li><strong><?php echo esc_html( $format( $tier['limits']['ai_requests'] ?? 0 ) ); ?></strong><span><?php esc_html_e( 'AI actions/mo', 'insightistic-marketing' ); ?></span></li>
							<li><strong><?php echo esc_html( $format( $tier['monthly_ai_credits'] ?? 0 ) ); ?></strong><span><?php esc_html_e( 'AI credits/mo', 'insightistic-marketing' ); ?></span></li>
							<li><strong><?php echo esc_html( $format( $tier['limits']['reports'] ?? 0 ) ); ?></strong><span><?php esc_html_e( 'reports/mo', 'insightistic-marketing' ); ?></span></li>
							<li><strong><?php echo esc_html( $format( $tier['limits']['schedules'] ?? 0 ) ); ?></strong><span><?php esc_html_e( 'report schedules', 'insightistic-marketing' ); ?></span></li>
						</ul>
						<ul class="ins-plan__features">
							<?php foreach ( (array) ( $tier['features'] ?? array() ) as $feature ) : ?><li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php echo esc_html( $feature ); ?></span></li><?php endforeach; ?>
						</ul>
						<?php if ( $active ) : ?>
							<a class="ins-btn ins-btn--brand ins-btn--block" href="<?php echo esc_url( insightistic_get_app_url( '/pricing#appsumo' ) ); ?>"><?php esc_html_e( 'Redeem through AppSumo', 'insightistic-marketing' ); ?></a>
						<?php else : ?>
							<a class="ins-btn ins-btn--ghost ins-btn--block" href="<?php echo esc_url( home_url( '/pricing/' ) ); ?>"><?php esc_html_e( 'View Stripe plans', 'insightistic-marketing' ); ?></a>
						<?php endif; ?>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="ins-section ins-ltd-promise" aria-labelledby="ins-ltd-promise-title">
		<div class="ins-container ins-narrow">
			<div class="ins-section__head">
				<p class="ins-eyebrow"><?php esc_html_e( 'What the AppSumo deal includes', 'insightistic-marketing' ); ?></p>
				<h2 id="ins-ltd-promise-title"><?php esc_html_e( 'A clear purchase, with clear usage boundaries.', 'insightistic-marketing' ); ?></h2>
			</div>
			<div class="ins-stepgrid">
				<article class="ins-step"><span class="ins-step__num">01</span><h3><?php esc_html_e( 'One payment', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'AppSumo handles the one-time purchase and redemption. Insightistic activates the account after the redemption is verified.', 'insightistic-marketing' ); ?></p></article>
				<article class="ins-step"><span class="ins-step__num">02</span><h3><?php esc_html_e( 'Monthly allowances renew', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'Sites, crawl pages, browser minutes, keywords, AI actions, credits and reports follow the tier’s published monthly limits.', 'insightistic-marketing' ); ?></p></article>
				<article class="ins-step"><span class="ins-step__num">03</span><h3><?php esc_html_e( 'Stripe stays separate', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'AppSumo lifetime entitlements are not Stripe subscriptions. Buying a Stripe plan does not replace or reduce a valid AppSumo entitlement.', 'insightistic-marketing' ); ?></p></article>
			</div>
		</div>
	</section>

	<section class="ins-section" aria-labelledby="ins-ltd-request-title">
		<div class="ins-container ins-narrow">
			<div class="ins-section__head">
				<p class="ins-eyebrow"><?php esc_html_e( 'Need help?', 'insightistic-marketing' ); ?></p>
				<h2 id="ins-ltd-request-title"><?php esc_html_e( 'Ask about AppSumo access', 'insightistic-marketing' ); ?></h2>
				<p class="ins-lead ins-center"><?php esc_html_e( 'Use the form for tier, redemption or account questions. Do not submit payment details here.', 'insightistic-marketing' ); ?></p>
			</div>
			<?php insightistic_formistic_form( 'ltd' ); ?>
			<p class="ins-consent"><?php esc_html_e( 'By submitting this form, you agree to our', 'insightistic-marketing' ); ?> <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'insightistic-marketing' ); ?></a>.</p>
		</div>
	</section>

	<?php get_template_part( 'template-parts/sections/faq' ); ?>
</main>
<?php get_footer(); ?>
