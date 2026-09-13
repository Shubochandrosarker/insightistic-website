<?php
/**
 * Template Name: Privacy Policy
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main id="main" class="ins-main ins-legal">
	<?php insightistic_render_legal_page( 'privacy-policy', __( 'Privacy Policy', 'insightistic-marketing' ) ); ?>
</main>
<?php
get_footer();
