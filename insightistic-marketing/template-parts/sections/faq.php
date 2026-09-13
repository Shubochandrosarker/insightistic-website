<?php
/** FAQ section. Structured data is emitted once by inc/seo.php. */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$faqs = insightistic_faqs();
if ( empty( $faqs ) ) { return; }
?>
<section class="ins-section ins-faq" aria-labelledby="ins-faq-title">
	<div class="ins-container ins-narrow">
		<div class="ins-section__head">
			<p class="ins-eyebrow"><?php esc_html_e( 'FAQ', 'insightistic-marketing' ); ?></p>
			<h2 id="ins-faq-title"><?php esc_html_e( 'Questions, answered', 'insightistic-marketing' ); ?></h2>
		</div>
		<div class="ins-accordion">
			<?php foreach ( $faqs as $i => $faq ) : ?>
				<details class="ins-accordion__item"<?php echo 0 === $i ? ' open' : ''; ?>>
					<summary class="ins-accordion__q"><?php echo esc_html( $faq['q'] ); ?></summary>
					<div class="ins-accordion__a"><p><?php echo esc_html( $faq['a'] ); ?></p></div>
				</details>
			<?php endforeach; ?>
		</div>
	</div>
</section>
