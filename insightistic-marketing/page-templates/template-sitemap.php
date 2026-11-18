<?php
/** Template Name: HTML Sitemap */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
$topics = insightistic_knowledgebase_topics();
$links  = insightistic_ecosystem_links();
$categories = get_categories( array( 'hide_empty' => true ) );
$posts = get_posts( array( 'post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 100, 'orderby' => 'date', 'order' => 'DESC', 'no_found_rows' => true ) );
?><main id="main" class="ins-main ins-sitemap">
	<section class="ins-section ins-page-hero">
		<div class="ins-container ins-narrow ins-center">
			<?php insightistic_breadcrumbs(); ?>
			<p class="ins-eyebrow"><?php esc_html_e( 'Site map', 'insightistic-marketing' ); ?></p>
			<h1 class="ins-page-hero__title"><?php esc_html_e( 'Find every Insightistic resource', 'insightistic-marketing' ); ?></h1>
			<p class="ins-lead"><?php esc_html_e( 'A human-readable directory of product pages, guides, company information, ecosystem relationships and legal documents. Machines can use the XML and llms endpoints linked below.', 'insightistic-marketing' ); ?></p>
		</div>
	</section>
	<section class="ins-section">
		<div class="ins-container ins-sitemap__grid">
			<div class="ins-sitemap__group"><h2><?php esc_html_e( 'Product', 'insightistic-marketing' ); ?></h2><ul><?php foreach ( array( 'features' => 'Features', 'pricing' => 'Pricing', 'integrations' => 'Integrations', 'agency' => 'For agencies', 'security' => 'Security & trust' ) as $path => $label ) : ?><li><a href="<?php echo esc_url( home_url( '/' . $path . '/' ) ); ?>"><?php echo esc_html( $label ); ?></a></li><?php endforeach; ?></ul></div>
			<div class="ins-sitemap__group"><h2><?php esc_html_e( 'Learn', 'insightistic-marketing' ); ?></h2><ul><li><a href="<?php echo esc_url( home_url( '/knowledgebase/' ) ); ?>">Knowledgebase</a></li><li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Blog</a></li><?php foreach ( $topics as $topic ) : ?><li><a href="<?php echo esc_url( $topic['url'] ); ?>"><?php echo esc_html( $topic['title'] ); ?></a></li><?php endforeach; ?></ul></div>
			<div class="ins-sitemap__group"><h2><?php esc_html_e( 'Company', 'insightistic-marketing' ); ?></h2><ul><?php foreach ( array( 'about' => 'About', 'why-insightistic' => 'Why Insightistic', 'contact' => 'Contact', 'changelog' => 'Changelog', 'ecosystem' => 'Ecosystem' ) as $path => $label ) : ?><li><a href="<?php echo esc_url( home_url( '/' . $path . '/' ) ); ?>"><?php echo esc_html( $label ); ?></a></li><?php endforeach; ?></ul></div>
			<div class="ins-sitemap__group"><h2><?php esc_html_e( 'Ecosystem', 'insightistic-marketing' ); ?></h2><ul><?php foreach ( $links as $link ) : ?><li><a href="<?php echo esc_url( $link['url'] ); ?>"<?php echo $link['external'] ? ' target="_blank" rel="noopener"' : ''; ?>><?php echo esc_html( $link['name'] ); ?></a></li><?php endforeach; ?></ul></div>
			<div class="ins-sitemap__group"><h2><?php esc_html_e( 'Legal', 'insightistic-marketing' ); ?></h2><ul><?php foreach ( array( 'privacy-policy' => 'Privacy Policy', 'terms' => 'Terms of Service', 'cookies' => 'Cookie Policy', 'data-processing' => 'Data Processing', 'refunds' => 'Refunds & cancellation', 'acceptable-use' => 'Acceptable use', 'subprocessors' => 'Subprocessors', 'accessibility' => 'Accessibility', 'legal-notices' => 'Legal notices' ) as $path => $label ) : ?><li><a href="<?php echo esc_url( home_url( '/' . $path . '/' ) ); ?>"><?php echo esc_html( $label ); ?></a></li><?php endforeach; ?></ul></div>
			<div class="ins-sitemap__group"><h2><?php esc_html_e( 'Editorial', 'insightistic-marketing' ); ?></h2><ul><li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Blog</a></li><?php foreach ( $categories as $category ) : ?><?php if ( function_exists( 'insightistic_taxonomy_is_indexable' ) && insightistic_taxonomy_is_indexable( $category ) ) : ?><li><a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"><?php echo esc_html( $category->name ); ?></a></li><?php endif; ?><?php endforeach; ?><?php foreach ( $posts as $post ) : ?><li><a href="<?php echo esc_url( get_permalink( $post ) ); ?>"><?php echo esc_html( get_the_title( $post ) ); ?></a></li><?php endforeach; ?></ul></div>
			<div class="ins-sitemap__group ins-sitemap__machine"><h2><?php esc_html_e( 'Machine-readable', 'insightistic-marketing' ); ?></h2><ul><li><a href="<?php echo esc_url( home_url( '/sitemap.xml' ) ); ?>">sitemap.xml</a></li><li><a href="<?php echo esc_url( home_url( '/llms.txt' ) ); ?>">llms.txt</a></li><li><a href="<?php echo esc_url( home_url( '/llms-full.txt' ) ); ?>">llms-full.txt</a></li><li><a href="<?php echo esc_url( home_url( '/robots.txt' ) ); ?>">robots.txt</a></li></ul><p><?php esc_html_e( 'These endpoints are generated from current published content.', 'insightistic-marketing' ); ?></p></div>
		</div>
	</section>
</main><?php
get_footer();
