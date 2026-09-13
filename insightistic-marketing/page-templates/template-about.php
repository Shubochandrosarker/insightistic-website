<?php
/**
 * Template Name: About
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main id="main" class="ins-main ins-page-template">
	<?php while ( have_posts() ) : the_post(); ?>
		<header class="ins-section ins-page-hero">
			<div class="ins-container ins-narrow ins-center">
				<p class="ins-eyebrow"><?php esc_html_e( 'About', 'insightistic-marketing' ); ?></p>
				<h1 class="ins-page-hero__title"><?php echo esc_html( get_the_title() ? get_the_title() : __( 'Business clarity for WordPress-powered teams', 'insightistic-marketing' ) ); ?></h1>
				<?php if ( has_excerpt() ) : ?><p class="ins-lead"><?php echo esc_html( get_the_excerpt() ); ?></p><?php endif; ?>
			</div>
		</header>
		<div class="ins-container ins-narrow ins-prose">
			<?php
			if ( trim( get_the_content() ) ) {
				the_content();
			} else {
				echo '<p>' . esc_html__( 'Insightistic helps WordPress and WooCommerce businesses understand revenue, products, customers, reports and store health from one clean dashboard — with AI that explains what changed and what to do next.', 'insightistic-marketing' ) . '</p>';
			}
			?>
		</div>
		<section class="ins-section ins-about-trust" aria-labelledby="ins-about-trust-title">
			<div class="ins-container ins-narrow">
				<p class="ins-eyebrow"><?php esc_html_e( 'Who builds Insightistic', 'insightistic-marketing' ); ?></p>
				<h2 id="ins-about-trust-title"><?php esc_html_e( 'Product decisions grounded in WordPress work', 'insightistic-marketing' ); ?></h2>
				<p class="ins-lead"><?php $author = insightistic_editorial_author(); printf( esc_html__( '%1$s is the %2$s behind Insightistic. The product is developed as part of WordPressistic LLC’s WordPress-first ecosystem for businesses and agencies that need a clearer operating view.', 'insightistic-marketing' ), esc_html( $author['name'] ), esc_html( $author['title'] ) ); ?></p>
				<p class="ins-about-entity"><?php $details = insightistic_business_details(); printf( esc_html__( 'Operator: %1$s · %2$s · Entity ID %3$s', 'insightistic-marketing' ), esc_html( $details['legal_name'] ), esc_html( $details['city'] . ', ' . $details['state'] . ' ' . $details['postal_code'] ), esc_html( $details['entity_id'] ) ); ?></p>
			</div>
		</section>
	<?php endwhile; ?>
	<?php
	get_template_part( 'template-parts/sections/features' );
	get_template_part( 'template-parts/sections/final-cta' );
	?>
</main>
<?php
get_footer();
