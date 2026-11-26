<?php
/**
 * Trust bar / logo cloud.
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$items = array( 'WordPress', 'WooCommerce', 'Google Search Console', 'White-label ready', 'Agency built' );
?>
<section class="ins-section ins-logocloud" aria-label="<?php esc_attr_e( 'Built for', 'insightistic-marketing' ); ?>">
	<div class="ins-container">
		<ul class="ins-logocloud__list">
			<?php foreach ( $items as $item ) : ?>
				<li><?php echo esc_html( $item ); ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
