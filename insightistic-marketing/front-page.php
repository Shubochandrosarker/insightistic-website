<?php
/**
 * Homepage — the multi-section marketing landing, composed from template parts.
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main id="main" class="ins-main ins-home">
	<?php
	get_template_part( 'template-parts/sections/hero' );
	get_template_part( 'template-parts/sections/v3-story' );
	get_template_part( 'template-parts/sections/analytics-preview' );
	get_template_part( 'template-parts/sections/logo-cloud' );
	get_template_part( 'template-parts/sections/problem' );
	get_template_part( 'template-parts/sections/features' );
	get_template_part( 'template-parts/sections/woo-insights' );
	get_template_part( 'template-parts/sections/traffic-analytics' );
	get_template_part( 'template-parts/sections/seo-analytics' );
	get_template_part( 'template-parts/sections/ai-insights' );
	get_template_part( 'template-parts/sections/performance-monitoring' );
	get_template_part( 'template-parts/sections/reports' );
	get_template_part( 'template-parts/sections/connector' );
	get_template_part( 'template-parts/sections/security' );
	get_template_part( 'template-parts/sections/wave1-explainers' );
	get_template_part( 'template-parts/sections/pricing' );
	get_template_part( 'template-parts/global/cta-band' );
	get_template_part( 'template-parts/sections/faq' );
	get_template_part( 'template-parts/global/ecosystem-band' );
	get_template_part( 'template-parts/sections/final-cta' );
	?>
</main>
<?php
get_footer();
