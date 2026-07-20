<?php
/**
 * Template Name: Changelog
 *
 * Illustrative release notes reflecting real, shipped product capabilities.
 * Dates are placeholders — update this page's content (or the demo entries
 * below, via the `insightistic_changelog_entries` filter) with your actual
 * release dates before publishing.
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Default changelog entries. Filterable so a site owner can replace these
 * with their real release history without editing the template.
 *
 * @return array<int,array{date:string,title:string,items:array<int,string>}>
 */
function insightistic_changelog_entries() {
	$entries = array(
		array(
			'date'  => __( 'July 2026', 'insightistic-marketing' ),
			'title' => __( 'Super Admin control center', 'insightistic-marketing' ),
			'items' => array(
				__( 'Full audit log for every account, license and billing action', 'insightistic-marketing' ),
				__( 'Archive & restore for organizations, users and sites, with a last-super-admin safety check', 'insightistic-marketing' ),
				__( 'Read-only support/impersonation mode for troubleshooting an account without changing billing', 'insightistic-marketing' ),
				__( 'A single plan & feature registry that pricing, entitlements and the dashboard all read from', 'insightistic-marketing' ),
			),
		),
		array(
			'date'  => __( 'June 2026', 'insightistic-marketing' ),
			'title' => __( 'Contextual AI, alerts & scheduled reports', 'insightistic-marketing' ),
			'items' => array(
				__( 'AI insights now generated per page (traffic, SEO, performance, commerce) instead of one generic summary', 'insightistic-marketing' ),
				__( 'Automatic alerts for revenue drops, refund spikes, traffic drops, SEO decline and performance regressions', 'insightistic-marketing' ),
				__( 'Reports can be scheduled to send automatically — weekly or monthly, no manual export', 'insightistic-marketing' ),
				__( 'CSV export added for traffic, SEO, performance and commerce data', 'insightistic-marketing' ),
			),
		),
		array(
			'date'  => __( 'May 2026', 'insightistic-marketing' ),
			'title' => __( 'Traffic, SEO & performance dashboards', 'insightistic-marketing' ),
			'items' => array(
				__( 'A dedicated Traffic dashboard: sessions, sources, landing pages and device/geo breakdowns', 'insightistic-marketing' ),
				__( 'A dedicated SEO dashboard: queries, pages, clicks, impressions and average position', 'insightistic-marketing' ),
				__( 'A dedicated Performance dashboard: Core Web Vitals history and broken-link monitoring', 'insightistic-marketing' ),
			),
		),
	);

	return apply_filters( 'insightistic_changelog_entries', $entries );
}

get_header();
?>
<main id="main" class="ins-main ins-page-template">
	<?php while ( have_posts() ) : the_post(); ?>
		<header class="ins-section ins-page-hero">
			<div class="ins-container ins-narrow ins-center">
				<p class="ins-eyebrow"><?php esc_html_e( "What's new", 'insightistic-marketing' ); ?></p>
				<h1 class="ins-page-hero__title"><?php echo esc_html( get_the_title() ? get_the_title() : __( 'Changelog', 'insightistic-marketing' ) ); ?></h1>
				<?php if ( has_excerpt() ) : ?><p class="ins-lead"><?php echo esc_html( get_the_excerpt() ); ?></p><?php endif; ?>
			</div>
		</header>
		<?php if ( trim( get_the_content() ) ) : ?><div class="ins-container ins-narrow ins-prose"><?php the_content(); ?></div><?php endif; ?>
	<?php endwhile; ?>

	<div class="ins-container ins-narrow ins-prose">
		<?php foreach ( insightistic_changelog_entries() as $entry ) : ?>
			<article>
				<p class="ins-legal__updated"><?php echo esc_html( $entry['date'] ); ?></p>
				<h2><?php echo esc_html( $entry['title'] ); ?></h2>
				<ul>
					<?php foreach ( $entry['items'] as $item ) : ?>
						<li><?php echo esc_html( $item ); ?></li>
					<?php endforeach; ?>
				</ul>
			</article>
		<?php endforeach; ?>
	</div>

	<?php get_template_part( 'template-parts/sections/final-cta' ); ?>
</main>
<?php
get_footer();
