<?php
/**
 * Homepage — the multi-section marketing landing, composed from template parts.
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * The SEOistic integration currently adds a homepage-only head callback that
 * exhausts PHP memory on the live Hostinger runtime. Keep the homepage
 * available while preserving the theme's styles, scripts and canonical
 * metadata until that integration is upgraded server-side.
 */
if ( function_exists( 'is_front_page' ) && is_front_page() ) {
	// The template is loaded before wp_head fires, so enqueue the theme assets
	// once before replacing the memory-heavy head callbacks below.
	if ( function_exists( 'did_action' ) && ! did_action( 'wp_enqueue_scripts' ) ) {
		do_action( 'wp_enqueue_scripts' );
	}
	remove_all_actions( 'wp_head' );
	add_action( 'wp_head', 'wp_print_styles', 8 );
	add_action( 'wp_head', 'wp_print_head_scripts', 9 );
	add_action(
		'wp_head',
		static function () {
			$title       = 'Insightistic — AI Business Intelligence for WordPress & WooCommerce';
			$description = 'Connect WordPress and WooCommerce analytics, SEO, performance and explainable AI insights in one workspace built for clearer business decisions.';
			$canonical   = home_url( '/' );
			echo '<title>' . esc_html( $title ) . '</title>' . PHP_EOL;
			echo '<meta name="description" content="' . esc_attr( $description ) . '">' . PHP_EOL;
			echo '<meta name="robots" content="index, follow">' . PHP_EOL;
			echo '<link rel="canonical" href="' . esc_url( $canonical ) . '">' . PHP_EOL;
			echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . PHP_EOL;
			echo '<meta property="og:description" content="' . esc_attr( $description ) . '">' . PHP_EOL;
			echo '<meta property="og:url" content="' . esc_url( $canonical ) . '">' . PHP_EOL;
			echo '<meta property="og:type" content="website">' . PHP_EOL;
			echo '<meta name="twitter:card" content="summary_large_image">' . PHP_EOL;
		},
		1
	);
}

get_header();
?>
<main id="main" class="ins-main ins-home">
	<?php
	get_template_part( 'template-parts/sections/hero' );
	get_template_part( 'template-parts/sections/analytics-preview' );
	get_template_part( 'template-parts/sections/animation-highlights' );
	get_template_part( 'template-parts/sections/logo-cloud' );
	get_template_part( 'template-parts/sections/problem' );
	get_template_part( 'template-parts/sections/features' );
	get_template_part( 'template-parts/sections/audit-animations' );
	get_template_part( 'template-parts/sections/woo-insights' );
	get_template_part( 'template-parts/sections/traffic-analytics' );
	get_template_part( 'template-parts/sections/seo-analytics' );
	get_template_part( 'template-parts/sections/ai-insights' );
	get_template_part( 'template-parts/sections/performance-monitoring' );
	get_template_part( 'template-parts/sections/reports' );
	get_template_part( 'template-parts/sections/connector' );
	get_template_part( 'template-parts/sections/security' );
	get_template_part( 'template-parts/sections/pricing' );
	get_template_part( 'template-parts/global/cta-band' );
	get_template_part( 'template-parts/sections/faq' );
	get_template_part( 'template-parts/global/ecosystem-band' );
	get_template_part( 'template-parts/sections/final-cta' );
	?>
	<section class="ins-section ins-home__trust-links" aria-labelledby="ins-home-trust-title">
		<div class="ins-container">
			<div class="ins-section__head">
				<p class="ins-eyebrow"><?php esc_html_e( 'Company & trust', 'insightistic-marketing' ); ?></p>
				<h2 id="ins-home-trust-title"><?php esc_html_e( 'Clear answers start with clear sources.', 'insightistic-marketing' ); ?></h2>
				<p class="ins-lead"><?php esc_html_e( 'Review the people, contact route, security notes and legal information behind Insightistic.', 'insightistic-marketing' ); ?></p>
			</div>
			<nav aria-label="<?php esc_attr_e( 'Company and trust resources', 'insightistic-marketing' ); ?>">
				<ul class="ins-home__trust-list">
					<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About Insightistic', 'insightistic-marketing' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'insightistic-marketing' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/security/' ) ); ?>"><?php esc_html_e( 'Security & trust', 'insightistic-marketing' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/legal-notices/' ) ); ?>"><?php esc_html_e( 'Legal notices', 'insightistic-marketing' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy', 'insightistic-marketing' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>"><?php esc_html_e( 'Terms', 'insightistic-marketing' ); ?></a></li>
				</ul>
			</nav>
		</div>
	</section>
</main>
<?php
get_footer();
