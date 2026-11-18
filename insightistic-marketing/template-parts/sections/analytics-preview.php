<?php
/**
 * SaaS dashboard preview visual (homepage section 3).
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<section class="ins-section ins-preview" aria-label="<?php esc_attr_e( 'Dashboard preview', 'insightistic-marketing' ); ?>">
	<div class="ins-container">
		<?php echo insightistic_animation_visual( '01', array( 'class' => 'ins-animation--featured' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</div>
</section>
