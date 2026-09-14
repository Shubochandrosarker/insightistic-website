<?php
/**
 * Template Name: Integrations
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$integrations = array(
	array(
		'icon'  => 'plug',
		'type'  => __( 'Core connection', 'insightistic-marketing' ),
		'title' => __( 'WooCommerce', 'insightistic-marketing' ),
		'text'  => __( 'Bring orders, products, customers, refunds and revenue into the workspace your team already uses.', 'insightistic-marketing' ),
	),
	array(
		'icon'  => 'globe',
		'type'  => __( 'Site connection', 'insightistic-marketing' ),
		'title' => __( 'WordPress', 'insightistic-marketing' ),
		'text'  => __( 'Keep site health, versions, content signals and connector status alongside the business numbers.', 'insightistic-marketing' ),
	),
	array(
		'icon'  => 'bar-chart',
		'type'  => __( 'Account billing', 'insightistic-marketing' ),
		'title' => __( 'Stripe billing', 'insightistic-marketing' ),
		'text'  => __( 'Keep your Insightistic plan and subscription context aligned with the account and reporting workflow.', 'insightistic-marketing' ),
	),
	array(
		'icon'  => 'mail',
		'type'  => __( 'Automated delivery', 'insightistic-marketing' ),
		'title' => __( 'Email reports', 'insightistic-marketing' ),
		'text'  => __( 'Schedule practical reports for your team or clients so important changes arrive without manual exports.', 'insightistic-marketing' ),
	),
	array(
		'icon'  => 'sparkles',
		'type'  => __( 'Decision support', 'insightistic-marketing' ),
		'title' => __( 'AI insights', 'insightistic-marketing' ),
		'text'  => __( 'Use OpenAI-compatible providers or the built-in rule-based fallback to turn metrics into understandable next steps.', 'insightistic-marketing' ),
	),
	array(
		'icon'  => 'shield',
		'type'  => __( 'Trust boundary', 'insightistic-marketing' ),
		'title' => __( 'Secure connector', 'insightistic-marketing' ),
		'text'  => __( 'Sync through a signed, read-only connection. Customer card data is not required for Insightistic analytics.', 'insightistic-marketing' ),
	),
);

get_header();

$page_title = get_the_title( get_queried_object_id() );
if ( ! $page_title ) {
	$page_title = __( 'Integrations', 'insightistic-marketing' );
}
?>
<main id="main" class="ins-main ins-integrations-page">
	<div class="ins-container">
		<?php insightistic_breadcrumbs(); ?>
		<header class="ins-page-header ins-integrations__page-header">
			<h1 class="ins-page-title"><?php echo esc_html( $page_title ); ?></h1>
		</header>
	</div>

	<section class="ins-section ins-integrations-hero" aria-labelledby="ins-integrations-hero-title">
		<div class="ins-container ins-narrow ins-center">
			<p class="ins-eyebrow"><?php esc_html_e( 'WordPress and WooCommerce integrations', 'insightistic-marketing' ); ?></p>
			<h2 id="ins-integrations-hero-title"><?php esc_html_e( 'Connect the data that runs your business', 'insightistic-marketing' ); ?></h2>
			<p class="ins-lead"><?php esc_html_e( 'Insightistic brings your store, website, billing, reports and AI context into one clear analytics workflow for business owners and agencies.', 'insightistic-marketing' ); ?></p>

			<div class="ins-integrations__actions">
				<a class="ins-btn ins-btn--brand ins-btn--lg" href="<?php echo esc_url( insightistic_register_url() ); ?>">
					<?php esc_html_e( 'Start free trial', 'insightistic-marketing' ); ?>
					<?php echo insightistic_icon( 'arrow-right', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</a>
				<a class="ins-btn ins-btn--ghost ins-btn--lg" href="#ins-connector-title">
					<?php esc_html_e( 'See how it connects', 'insightistic-marketing' ); ?>
				</a>
			</div>

			<ul class="ins-integrations__proof" aria-label="<?php esc_attr_e( 'Integration benefits', 'insightistic-marketing' ); ?>">
				<li><?php echo insightistic_icon( 'check', 16 ); ?><?php esc_html_e( 'Signed connections', 'insightistic-marketing' ); ?></li>
				<li><?php echo insightistic_icon( 'check', 16 ); ?><?php esc_html_e( 'Read-only sync', 'insightistic-marketing' ); ?></li>
				<li><?php echo insightistic_icon( 'check', 16 ); ?><?php esc_html_e( 'No card data required', 'insightistic-marketing' ); ?></li>
			</ul>
		</div>
	</section>

	<section id="available-integrations" class="ins-section ins-integrations-catalog" aria-labelledby="ins-integrations-catalog-title">
		<div class="ins-container">
			<div class="ins-section__head">
				<p class="ins-eyebrow"><?php esc_html_e( 'Connected by design', 'insightistic-marketing' ); ?></p>
				<h2 id="ins-integrations-catalog-title"><?php esc_html_e( 'A clear path from data to action', 'insightistic-marketing' ); ?></h2>
				<p class="ins-lead"><?php esc_html_e( 'Each connection has a focused job: bring in the signal, keep it trustworthy and make the next decision easier to see.', 'insightistic-marketing' ); ?></p>
			</div>

			<div class="ins-integration-grid">
				<?php foreach ( $integrations as $integration ) : ?>
					<article class="ins-integration-card">
						<div class="ins-integration-card__top">
							<span class="ins-integration-card__icon"><?php echo insightistic_icon( $integration['icon'], 21 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
							<span class="ins-integration-card__type"><?php echo esc_html( $integration['type'] ); ?></span>
						</div>
						<h3><?php echo esc_html( $integration['title'] ); ?></h3>
						<p><?php echo esc_html( $integration['text'] ); ?></p>
						<div class="ins-integration-card__footer">
							<span><?php echo insightistic_icon( 'check', 16 ); ?><?php esc_html_e( 'Ready when you connect', 'insightistic-marketing' ); ?></span>
						</div>
					</article>
				<?php endforeach; ?>
			</div>

			<aside class="ins-integration-trust">
				<span class="ins-integration-trust__icon"><?php echo insightistic_icon( 'shield', 22 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<div>
					<strong><?php esc_html_e( 'Privacy-aware by default', 'insightistic-marketing' ); ?></strong>
					<p><?php esc_html_e( 'Insightistic only asks for the information it needs to explain the business. Payment card numbers and payment tokens are not part of the reporting workflow.', 'insightistic-marketing' ); ?></p>
				</div>
			</aside>
		</div>
	</section>

	<?php get_template_part( 'template-parts/sections/connector' ); ?>

	<section class="ins-section ins-integrations-faq" aria-labelledby="ins-integrations-faq-title">
		<div class="ins-container ins-narrow">
			<div class="ins-section__head">
				<p class="ins-eyebrow"><?php esc_html_e( 'Common questions', 'insightistic-marketing' ); ?></p>
				<h2 id="ins-integrations-faq-title"><?php esc_html_e( 'Integration FAQs', 'insightistic-marketing' ); ?></h2>
				<p class="ins-lead"><?php esc_html_e( 'The short version of what connects, what stays private and what your team can expect.', 'insightistic-marketing' ); ?></p>
			</div>

			<div class="ins-integration-faqs">
				<details class="ins-integration-faq" open>
					<summary><?php esc_html_e( 'What does Insightistic connect?', 'insightistic-marketing' ); ?></summary>
					<div class="ins-integration-faq__answer">
						<p><?php esc_html_e( 'Insightistic connects WordPress and WooCommerce business signals with account billing, scheduled email reports, AI insight providers and the secure connector that keeps the sync current.', 'insightistic-marketing' ); ?></p>
					</div>
				</details>

				<details class="ins-integration-faq">
					<summary><?php esc_html_e( 'Does the connector send payment card data?', 'insightistic-marketing' ); ?></summary>
					<div class="ins-integration-faq__answer">
						<p><?php esc_html_e( 'No. Insightistic uses a signed, read-only sync for analytics. Payment card numbers and payment tokens are not needed for the reporting workflow.', 'insightistic-marketing' ); ?></p>
					</div>
				</details>

				<details class="ins-integration-faq">
					<summary><?php esc_html_e( 'Can agencies connect client sites?', 'insightistic-marketing' ); ?></summary>
					<div class="ins-integration-faq__answer">
						<p><?php esc_html_e( 'Yes. Agency workflows can keep multiple client sites organised, share practical reports and use white-label reporting options where supported by the account plan.', 'insightistic-marketing' ); ?> <a href="<?php echo esc_url( home_url( '/agency/' ) ); ?>"><?php esc_html_e( 'Explore agency analytics', 'insightistic-marketing' ); ?></a>.</p>
					</div>
				</details>

				<details class="ins-integration-faq">
					<summary><?php esc_html_e( 'How long does it take to connect a site?', 'insightistic-marketing' ); ?></summary>
					<div class="ins-integration-faq__answer">
						<p><?php esc_html_e( 'Most teams can create an account, connect their site and start reading recommendations in about three minutes, depending on the site’s connector setup.', 'insightistic-marketing' ); ?></p>
					</div>
				</details>
			</div>
		</div>
	</section>

	<?php get_template_part( 'template-parts/sections/final-cta' ); ?>
</main>
<?php
get_footer();
