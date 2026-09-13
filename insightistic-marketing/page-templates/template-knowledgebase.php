<?php
/**
 * Template Name: Knowledgebase
 *
 * @package Insightistic_Marketing
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
?><main id="main" class="ins-main ins-knowledgebase">
	<section class="ins-section ins-page-hero">
		<div class="ins-container ins-narrow ins-center">
			<?php insightistic_breadcrumbs(); ?>
			<p class="ins-eyebrow"> <?php esc_html_e( 'Knowledgebase', 'insightistic-marketing' ); ?></p>
			<h1 class="ins-page-hero__title"><?php echo esc_html( insightistic_current_title() ? insightistic_current_title() : __( 'Clear answers for WordPress & WooCommerce teams', 'insightistic-marketing' ) ); ?></h1>
			<p class="ins-lead"><?php esc_html_e( 'Practical, source-aware guidance for measuring store revenue, understanding traffic, improving SEO, monitoring performance and using AI responsibly.', 'insightistic-marketing' ); ?></p>
			<form class="ins-kb-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<label class="screen-reader-text" for="ins-kb-search-field"><?php esc_html_e( 'Search the Knowledgebase', 'insightistic-marketing' ); ?></label>
				<input id="ins-kb-search-field" type="search" name="s" value="" placeholder="<?php esc_attr_e( 'Search WordPress analytics guidance', 'insightistic-marketing' ); ?>">
				<button class="ins-btn ins-btn--brand" type="submit"><?php esc_html_e( 'Search', 'insightistic-marketing' ); ?></button>
			</form>
		</div>
	</section>
	<?php get_template_part( 'template-parts/knowledgebase/directory' ); ?>
	<section class="ins-section ins-kb-trust">
		<div class="ins-container ins-narrow ins-center">
			<p class="ins-eyebrow"><?php esc_html_e( 'Editorial standard', 'insightistic-marketing' ); ?></p>
			<h2><?php esc_html_e( 'Useful answers start with a clear data boundary', 'insightistic-marketing' ); ?></h2>
			<p class="ins-lead"><?php esc_html_e( 'We separate product capabilities, sample data, implementation guidance and verified outcomes. Articles are written for humans first, with clear definitions and reviewable sources so they can also be understood by search engines and answer agents.', 'insightistic-marketing' ); ?></p>
			<a class="ins-link" href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'Meet the team behind the product', 'insightistic-marketing' ); ?> <?php echo insightistic_icon( 'arrow-right', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
		</div>
	</section>
</main><?php
get_footer();
