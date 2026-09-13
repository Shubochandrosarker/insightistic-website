<?php
/**
 * Template Name: Terms
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main id="main" class="ins-main ins-legal">
	<?php insightistic_render_legal_page( 'terms', __( 'Terms of Service', 'insightistic-marketing' ) ); ?>
</main>
<?php
get_footer();
