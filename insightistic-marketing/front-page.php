<?php
/**
 * Front page for the Insightistic marketing theme.
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main id="main" class="ins-main ins-home-refresh" tabindex="-1">
	<?php get_template_part( 'template-parts/sections/public-overview' ); ?>
</main>
<?php get_footer(); ?>
