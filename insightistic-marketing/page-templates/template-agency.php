<?php
/**
 * Template Name: Agency
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$agency_features = array(
	array( 'icon' => 'globe', 'title' => 'White-label dashboard', 'text' => 'Your logo, brand colors and custom domain on a client-ready dashboard.' ),
	array( 'icon' => 'file-text', 'title' => 'Branded PDF reports', 'text' => 'Automated, on-brand reports your clients receive every week or month.' ),
	array( 'icon' => 'users', 'title' => 'Client viewer access', 'text' => 'Give each client a read-only view scoped to just their own store.' ),
	array( 'icon' => 'shield', 'title' => 'Team roles', 'text' => 'Owner, admin, analyst and client-viewer roles keep access tidy.' ),
);

/*
 * The agency URL is also used by legacy SEO/schema integrations. Scope the
 * head workaround to this template so a broken third-party callback cannot
 * take down the public page; keep the normal theme assets explicit.
 */
if ( function_exists( 'did_action' ) && ! did_action( 'wp_enqueue_scripts' ) ) {
	do_action( 'wp_enqueue_scripts' );
}
remove_all_actions( 'wp_head' );
add_action(
	'wp_head',
	static function () {
		$base = trailingslashit( get_stylesheet_directory_uri() ) . 'assets/css/';
		$ver  = defined( 'INSIGHTISTIC_MARKETING_VERSION' ) ? INSIGHTISTIC_MARKETING_VERSION : '1.6.3';
		foreach ( array( 'theme.css', 'blocks.css', 'responsive.css' ) as $file ) {
			printf( '<link rel="stylesheet" href="%s" type="text/css" media="all" />%s', esc_url( add_query_arg( 'ver', $ver, $base . $file ) ), PHP_EOL );
		}
	},
	8
);

get_header();
?>
<main id="main" class="ins-main ins-page-template ins-agency">
	<header class="ins-section ins-page-hero">
		<div class="ins-container ins-narrow ins-center">
			<p class="ins-eyebrow"><?php esc_html_e( 'For agencies', 'insightistic-marketing' ); ?></p>
			<h1 class="ins-page-hero__title"><?php echo esc_html( get_the_title() ? get_the_title() : __( 'A white-label analytics workspace for client teams', 'insightistic-marketing' ) ); ?></h1>
			<?php if ( has_excerpt() ) : ?><p class="ins-lead"><?php echo esc_html( get_the_excerpt() ); ?></p><?php endif; ?>
			<div class="ins-hero__actions ins-center">
				<a class="ins-btn ins-btn--brand ins-btn--lg" href="<?php echo esc_url( insightistic_register_url( 'agency' ) ); ?>"><?php esc_html_e( 'Start Agency trial', 'insightistic-marketing' ); ?></a>
				<a class="ins-btn ins-btn--ghost ins-btn--lg" href="<?php echo esc_url( home_url( '/pricing/' ) ); ?>"><?php esc_html_e( 'Compare plans', 'insightistic-marketing' ); ?></a>
			</div>
		</div>
	</header>

	<section class="ins-section" aria-labelledby="ins-agency-benefits-title">
		<div class="ins-container">
			<div class="ins-section__head ins-center">
				<p class="ins-eyebrow"><?php esc_html_e( 'Built for client delivery', 'insightistic-marketing' ); ?></p>
				<h2 id="ins-agency-benefits-title"><?php esc_html_e( 'A calmer reporting workflow for every account.', 'insightistic-marketing' ); ?></h2>
				<p class="ins-lead"><?php esc_html_e( 'Give your team one workspace for client visibility, repeatable reporting and clear access boundaries.', 'insightistic-marketing' ); ?></p>
			</div>
			<div class="ins-grid ins-grid--features">
				<?php foreach ( $agency_features as $agency_feature ) : ?>
					<article class="ins-feature">
						<span class="ins-feature__icon" aria-hidden="true"><?php echo insightistic_icon( $agency_feature['icon'], 20 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						<h3 class="ins-feature__title"><?php echo esc_html( $agency_feature['title'] ); ?></h3>
						<p class="ins-feature__text"><?php echo esc_html( $agency_feature['text'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="ins-section" aria-labelledby="ins-agency-process-title">
		<div class="ins-container ins-narrow">
			<div class="ins-section__head">
				<p class="ins-eyebrow"><?php esc_html_e( 'A practical operating loop', 'insightistic-marketing' ); ?></p>
				<h2 id="ins-agency-process-title"><?php esc_html_e( 'Connect, review and share with less manual work.', 'insightistic-marketing' ); ?></h2>
			</div>
			<div class="ins-stepgrid">
				<article class="ins-step"><span class="ins-step__num">01</span><h3><?php esc_html_e( 'Connect client stores', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'Keep each WordPress or WooCommerce connection scoped to the right workspace.', 'insightistic-marketing' ); ?></p></article>
				<article class="ins-step"><span class="ins-step__num">02</span><h3><?php esc_html_e( 'Review what changed', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'Bring revenue, SEO, traffic and performance signals into one reviewable view.', 'insightistic-marketing' ); ?></p></article>
				<article class="ins-step"><span class="ins-step__num">03</span><h3><?php esc_html_e( 'Share the next action', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'Turn the important findings into client-ready reports and clear follow-up work.', 'insightistic-marketing' ); ?></p></article>
			</div>
		</div>
	</section>

	<section class="ins-section" aria-labelledby="ins-agency-cta-title">
		<div class="ins-container ins-narrow ins-center">
			<div class="ins-ctaband__card">
				<p class="ins-eyebrow"><?php esc_html_e( 'Ready for a cleaner client workflow?', 'insightistic-marketing' ); ?></p>
				<h2 id="ins-agency-cta-title"><?php esc_html_e( 'Start with a free agency workspace.', 'insightistic-marketing' ); ?></h2>
				<p><?php esc_html_e( 'Review the current plan details or talk to the team about your client portfolio.', 'insightistic-marketing' ); ?></p>
				<div class="ins-hero__actions ins-center">
					<a class="ins-btn ins-btn--brand" href="<?php echo esc_url( insightistic_register_url( 'agency' ) ); ?>"><?php esc_html_e( 'Start Agency trial', 'insightistic-marketing' ); ?></a>
					<a class="ins-btn ins-btn--ghost" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Talk to our team', 'insightistic-marketing' ); ?></a>
				</div>
			</div>
		</div>
	</section>
</main>
<?php get_footer();
