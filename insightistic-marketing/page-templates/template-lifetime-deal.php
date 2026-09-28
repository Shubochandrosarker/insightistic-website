<?php
/**
 * Template Name: Lifetime Deal
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$ltd_tiers = array(
	array(
		'slug'     => 'founder_tier_1',
		'name'     => __( 'Angel Solo', 'insightistic-marketing' ),
		'price'    => '$79',
		'tagline'  => __( 'For one store owner or a focused personal site.', 'insightistic-marketing' ),
		'features' => array(
			__( '3 connected sites', 'insightistic-marketing' ),
			__( '10,000 crawl pages per month', 'insightistic-marketing' ),
			__( '150 tracked keywords', 'insightistic-marketing' ),
			__( '10 AI prompts per month', 'insightistic-marketing' ),
			__( '4 client-ready reports per month', 'insightistic-marketing' ),
		),
	),
	array(
		'slug'     => 'founder_tier_2',
		'name'     => __( 'Angel Studio', 'insightistic-marketing' ),
		'price'    => '$149',
		'tagline'  => __( 'For growing brands and small consulting studios.', 'insightistic-marketing' ),
		'featured' => true,
		'features' => array(
			__( '10 connected sites', 'insightistic-marketing' ),
			__( '40,000 crawl pages per month', 'insightistic-marketing' ),
			__( '500 tracked keywords', 'insightistic-marketing' ),
			__( '40 AI prompts per month', 'insightistic-marketing' ),
			__( '20 client-ready reports per month', 'insightistic-marketing' ),
			__( '3 team members', 'insightistic-marketing' ),
		),
	),
	array(
		'slug'     => 'founder_tier_3',
		'name'     => __( 'Angel Agency', 'insightistic-marketing' ),
		'price'    => '$249',
		'tagline'  => __( 'For agencies running a real client portfolio.', 'insightistic-marketing' ),
		'features' => array(
			__( '30 connected sites', 'insightistic-marketing' ),
			__( '100,000 crawl pages per month', 'insightistic-marketing' ),
			__( '1,500 tracked keywords', 'insightistic-marketing' ),
			__( '100 AI prompts per month', 'insightistic-marketing' ),
			__( '100 client-ready reports per month', 'insightistic-marketing' ),
			__( 'White-label reporting', 'insightistic-marketing' ),
		),
	),
);

$promise_steps = array(
	array(
		'title' => __( 'Connect your sources', 'insightistic-marketing' ),
		'text'  => __( 'WordPress, WooCommerce, GA4 and Search Console connect through the Insightistic plugin and app workflow.', 'insightistic-marketing' ),
	),
	array(
		'title' => __( 'See the signal', 'insightistic-marketing' ),
		'text'  => __( 'Revenue, traffic, SEO and AI visibility sit in one calm workspace with recommendations that explain what changed.', 'insightistic-marketing' ),
	),
	array(
		'title' => __( 'Ship the next action', 'insightistic-marketing' ),
		'text'  => __( 'Turn findings into a priority queue, client-ready reports and practical decisions without rebuilding spreadsheets.', 'insightistic-marketing' ),
	),
);

get_header();
?>
<main id="main" class="ins-main ins-page-template ins-ltd">
	<section class="ins-section ins-ltd-hero" aria-labelledby="ins-ltd-title">
		<div class="ins-container ins-narrow ins-center">
			<p class="ins-eyebrow"><?php esc_html_e( 'Founding lifetime deal', 'insightistic-marketing' ); ?></p>
			<h1 id="ins-ltd-title" class="ins-page-hero__title"><?php esc_html_e( 'Own your analytics. Forever.', 'insightistic-marketing' ); ?></h1>
			<p class="ins-lead"><?php esc_html_e( 'One payment for lifetime access to the AI analytics workspace for WordPress and WooCommerce. No renewals.', 'insightistic-marketing' ); ?></p>
			<div class="ins-ltd-hero__actions">
				<a class="ins-btn ins-btn--brand ins-btn--lg" href="#angel-plans">
					<?php esc_html_e( 'See Angel plans', 'insightistic-marketing' ); ?>
					<?php echo insightistic_icon( 'arrow-right', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</a>
				<a class="ins-btn ins-btn--ghost ins-btn--lg" href="<?php echo esc_url( insightistic_login_url() ); ?>">
					<?php esc_html_e( 'Already have an account?', 'insightistic-marketing' ); ?>
				</a>
			</div>
			<ul class="ins-ltd-proof" aria-label="<?php esc_attr_e( 'Lifetime deal details', 'insightistic-marketing' ); ?>">
				<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Founding window open until October 31, 2026', 'insightistic-marketing' ); ?></li>
				<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( '30-day money-back guarantee', 'insightistic-marketing' ); ?></li>
				<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Secure checkout by Paddle', 'insightistic-marketing' ); ?></li>
			</ul>
		</div>
	</section>

	<section id="angel-plans" class="ins-section ins-ltd-plans" aria-labelledby="ins-ltd-plans-title">
		<div class="ins-container">
			<div class="ins-section__head">
				<p class="ins-eyebrow"><?php esc_html_e( 'Angel plans', 'insightistic-marketing' ); ?></p>
				<h2 id="ins-ltd-plans-title"><?php esc_html_e( 'One payment, lifetime access', 'insightistic-marketing' ); ?></h2>
				<p class="ins-lead ins-center"><?php esc_html_e( 'Monthly allowances reset every month. Every tier includes the Insightistic workspace, future Insightistic product updates and a 30-day guarantee.', 'insightistic-marketing' ); ?></p>
			</div>

			<div class="ins-ltd-grid">
				<?php foreach ( $ltd_tiers as $tier ) : ?>
					<article class="ins-ltd-card<?php echo ! empty( $tier['featured'] ) ? ' ins-ltd-card--featured' : ''; ?>">
						<?php if ( ! empty( $tier['featured'] ) ) : ?>
							<span class="ins-plan__badge"><?php esc_html_e( 'Best value', 'insightistic-marketing' ); ?></span>
						<?php endif; ?>
						<h3><?php echo esc_html( $tier['name'] ); ?></h3>
						<p class="ins-plan__tagline"><?php echo esc_html( $tier['tagline'] ); ?></p>
						<p class="ins-plan__price"><span class="ins-plan__amount"><?php echo esc_html( $tier['price'] ); ?></span><span class="ins-plan__per"><?php esc_html_e( ' one-time', 'insightistic-marketing' ); ?></span></p>
						<ul class="ins-plan__features">
							<?php foreach ( $tier['features'] as $feature ) : ?>
								<li><?php echo insightistic_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php echo esc_html( $feature ); ?></span></li>
							<?php endforeach; ?>
						</ul>
						<a class="ins-btn ins-btn--brand ins-btn--block" href="<?php echo esc_url( insightistic_register_url( $tier['slug'] ) ); ?>">
							<?php
							printf(
								/* translators: 1: plan name, 2: one-time price. */
								esc_html__( 'Get %1$s - %2$s', 'insightistic-marketing' ),
								esc_html( $tier['name'] ),
								esc_html( $tier['price'] )
							);
							?>
						</a>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="ins-section ins-ltd-promise" aria-labelledby="ins-ltd-promise-title">
		<div class="ins-container">
			<div class="ins-section__head">
				<p class="ins-eyebrow"><?php esc_html_e( 'The promise', 'insightistic-marketing' ); ?></p>
				<h2 id="ins-ltd-promise-title"><?php esc_html_e( 'The Angel Studio promise', 'insightistic-marketing' ); ?></h2>
				<p class="ins-lead ins-center"><?php esc_html_e( 'Angel Studio members in the founding window receive 50% off future WordPressistic product plans, including future lifetime deals.', 'insightistic-marketing' ); ?></p>
			</div>
			<div class="ins-stepgrid">
				<?php foreach ( $promise_steps as $index => $step ) : ?>
					<article class="ins-step">
						<span class="ins-step__num"><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
						<h3><?php echo esc_html( $step['title'] ); ?></h3>
						<p><?php echo esc_html( $step['text'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="ins-section" aria-labelledby="ins-ltd-request-title">
		<div class="ins-container ins-narrow">
			<div class="ins-section__head">
				<p class="ins-eyebrow"><?php esc_html_e( 'Need help?', 'insightistic-marketing' ); ?></p>
				<h2 id="ins-ltd-request-title"><?php esc_html_e( 'Request lifetime access support', 'insightistic-marketing' ); ?></h2>
				<p class="ins-lead ins-center"><?php esc_html_e( 'Use this if you need help choosing a tier, agency seats or checkout support.', 'insightistic-marketing' ); ?></p>
			</div>
			<?php insightistic_formistic_form( 'ltd' ); ?>
			<p class="ins-consent"><?php esc_html_e( 'By submitting this form, you agree to our', 'insightistic-marketing' ); ?> <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'insightistic-marketing' ); ?></a>.</p>
		</div>
	</section>

	<?php get_template_part( 'template-parts/sections/faq' ); ?>
</main>
<?php
get_footer();
