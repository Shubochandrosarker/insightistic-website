<?php
/**
 * Template Name: Product Tour
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$catalog = insightistic_animation_manifest();
$groups  = array(
	'Overview'             => array( '01', '02', '15' ),
	'Search intelligence'  => array( '03', '04' ),
	'Site auditing'        => array( '05', '06', '07', '08' ),
	'AI workspace'         => array( '09', '10' ),
	'Performance'          => array( '11', '12' ),
	'Traffic'              => array( '13', '14' ),
);
$screen_map = array( 'overview', 'seo', 'audit', 'runs', 'agents', 'performance', 'traffic' );

get_header();
?>
<main id="main" class="ins-main ins-page-template ins-product-tour">
	<header class="ins-section ins-page-hero">
		<div class="ins-container ins-narrow ins-center">
			<p class="ins-eyebrow"><?php esc_html_e( 'Explore Insightistic in motion', 'insightistic-marketing' ); ?></p>
			<h1 class="ins-page-hero__title"><?php esc_html_e( 'A clearer view of the work behind every insight.', 'insightistic-marketing' ); ?></h1>
			<p class="ins-lead"><?php esc_html_e( 'Browse short, illustrative product stories for search, auditing, AI, performance and traffic. These demos use sample data and do not represent customer results.', 'insightistic-marketing' ); ?></p>
		</div>
	</header>

	<?php foreach ( $groups as $group_title => $ids ) : ?>
		<section class="ins-section ins-tour-group" aria-labelledby="ins-tour-<?php echo esc_attr( sanitize_title( $group_title ) ); ?>">
			<div class="ins-container">
				<div class="ins-section__head">
					<p class="ins-eyebrow"><?php echo esc_html( $group_title ); ?></p>
					<h2 id="ins-tour-<?php echo esc_attr( sanitize_title( $group_title ) ); ?>"><?php esc_html_e( 'See the signal, then explore the detail', 'insightistic-marketing' ); ?></h2>
				</div>
				<div class="ins-tour-grid">
					<?php foreach ( $ids as $id ) : ?>
						<?php
						if ( empty( $catalog[ $id ] ) ) {
							continue;
						}
						$item   = $catalog[ $id ];
						$screen = in_array( $item['screen'] ?? '', $screen_map, true ) ? $item['screen'] : 'overview';
						$url    = insightistic_animation_scene_url( $item );
						$poster = INSIGHTISTIC_URI . '/assets/animations/demo/' . $screen . '.svg';
						?>
						<article class="ins-tour-card">
							<a class="ins-tour-card__media" href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener">
								<img src="<?php echo esc_url( $poster ); ?>" alt="<?php echo esc_attr( $item['title'] . ' — illustrative demo' ); ?>" loading="lazy" decoding="async">
								<span aria-hidden="true">↗</span>
							</a>
							<div class="ins-tour-card__body">
								<p class="ins-eyebrow"><?php echo esc_html( $item['eyebrow'] ); ?></p>
								<h3><?php echo esc_html( $item['title'] ); ?></h3>
								<p><?php echo esc_html( $item['subtitle'] ); ?></p>
								<a class="ins-link" href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Open interactive view', 'insightistic-marketing' ); ?> <?php echo insightistic_icon( 'arrow-right', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	<?php endforeach; ?>

	<?php get_template_part( 'template-parts/sections/final-cta' ); ?>
</main>
<?php
get_footer();
