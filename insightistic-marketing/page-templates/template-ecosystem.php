<?php
/** Template Name: Ecosystem */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
$links = insightistic_ecosystem_links();
?><main id="main" class="ins-main ins-ecosystem">
	<section class="ins-section ins-page-hero">
		<div class="ins-container ins-narrow ins-center">
			<?php insightistic_breadcrumbs(); ?>
			<p class="ins-eyebrow"><?php esc_html_e( 'WordPressistic ecosystem', 'insightistic-marketing' ); ?></p>
			<h1 class="ins-page-hero__title"><?php esc_html_e( 'Connected products for connected business workflows', 'insightistic-marketing' ); ?></h1>
			<p class="ins-lead"><?php esc_html_e( 'Insightistic explains changes in search, site health, and store performance. Explore the WordPressistic products for the next step, from customer messaging to bookings and membership.', 'insightistic-marketing' ); ?></p>
		</div>
	</section>
	<section class="ins-section">
		<div class="ins-container">
			<div class="ins-grid ins-grid--ecosystem">
				<?php foreach ( $links as $link ) : ?>
					<article id="<?php echo esc_attr( $link['slug'] ); ?>" class="ins-ecosystem-card">
						<p class="ins-eyebrow"><?php esc_html_e( 'Ecosystem product', 'insightistic-marketing' ); ?></p>
						<h2><?php echo esc_html( $link['name'] ); ?></h2>
						<p><?php echo esc_html( $link['description'] ); ?></p>
						<a class="ins-link" href="<?php echo esc_url( $link['url'] ); ?>"<?php echo $link['external'] ? ' target="_blank" rel="noopener"' : ''; ?>><?php echo $link['external'] ? esc_html__( 'Visit product site', 'insightistic-marketing' ) : esc_html__( 'Read on this site', 'insightistic-marketing' ); ?> <?php echo insightistic_icon( 'arrow-right', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<section class="ins-section ins-ecosystem__note">
		<div class="ins-container ins-narrow ins-center">
			<h2><?php esc_html_e( 'Find your next step', 'insightistic-marketing' ); ?></h2>
			<p class="ins-lead"><?php esc_html_e( 'Start with the data you already have. Use the integration guide to see which sources support your Insightistic workspace.', 'insightistic-marketing' ); ?></p>
			<a class="ins-link" href="<?php echo esc_url( home_url( '/integrations/' ) ); ?>"><?php esc_html_e( 'View Insightistic integrations', 'insightistic-marketing' ); ?></a>
		</div>
	</section>
</main><?php
get_footer();
