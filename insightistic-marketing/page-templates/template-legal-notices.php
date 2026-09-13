<?php
/** Template Name: Legal Notices */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
?><main id="main" class="ins-main ins-legal"><?php insightistic_render_legal_page( 'legal-notices', __( 'Legal Notices', 'insightistic-marketing' ) ); ?></main><?php
get_footer();
