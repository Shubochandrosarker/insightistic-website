<?php
/**
 * Plugin Name: Insightistic MU Compatibility Shim
 * Description: Supplies missing SEO helpers after the active theme loads.
 * Version:     1.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Let the MU plugins and theme define their real helpers before adding fallbacks.
add_action(
	'after_setup_theme',
	static function () {
		if ( ! function_exists( 'insightistic_live_seoistic_active' ) ) {
			function insightistic_live_seoistic_active() {
				return false;
			}
		}

		if ( ! function_exists( 'insightistic_seo_plugin_active' ) ) {
			function insightistic_seo_plugin_active() {
				return function_exists( 'insightistic_asset_url' );
			}
		}

		if ( ! function_exists( 'insightistic_live_seo_title' ) ) {
			function insightistic_live_seo_title( $post_id = null ) {
				return '';
			}
		}

		if ( ! function_exists( 'insightistic_seo_title' ) ) {
			function insightistic_seo_title( $post_id = null ) {
				if ( function_exists( 'insightistic_current_title' ) ) {
					return insightistic_current_title( $post_id );
				}
				return get_the_title( $post_id );
			}
		}

		if ( ! function_exists( 'insightistic_live_seo_description' ) ) {
			function insightistic_live_seo_description( $post_id = null ) {
				return '';
			}
		}

		if ( ! function_exists( 'insightistic_seo_description' ) ) {
			function insightistic_seo_description( $post_id = null ) {
				$post = get_post( $post_id );
				if ( $post instanceof WP_Post && $post->post_excerpt ) {
					return wp_strip_all_tags( $post->post_excerpt );
				}
				return get_bloginfo( 'description' );
			}
		}

		if ( ! function_exists( 'insightistic_live_seo_image' ) ) {
			function insightistic_live_seo_image( $post_id = null ) {
				return '';
			}
		}

		if ( ! function_exists( 'insightistic_live_featured_share_image' ) ) {
			function insightistic_live_featured_share_image( $post_id = null ) {
				return '';
			}
		}

		if ( ! function_exists( 'insightistic_live_seo_meta' ) ) {
			function insightistic_live_seo_meta( $post_id = null ) {
				return array();
			}
		}

		if ( ! function_exists( 'insightistic_live_seo_document_title' ) ) {
			function insightistic_live_seo_document_title( $title = '' ) {
				return $title;
			}
		}

		if ( ! function_exists( 'insightistic_live_seo_bootstrap' ) ) {
			function insightistic_live_seo_bootstrap() {
				return null;
			}
		}

		if ( ! function_exists( 'insightistic_live_seed_category_descriptions' ) ) {
			function insightistic_live_seed_category_descriptions() {
				return array();
			}
		}

		if ( ! function_exists( 'insightistic_seed_seoistic_metadata' ) ) {
			function insightistic_seed_seoistic_metadata() {
				return null;
			}
		}

		if ( ! function_exists( 'insightistic_seo_page_defaults' ) ) {
			function insightistic_seo_page_defaults( $post_id = null ) {
				return array();
			}
		}

		if ( ! function_exists( 'insightistic_seo_canonical_url' ) ) {
			function insightistic_seo_canonical_url( $post_id = null ) {
				$link = get_permalink( $post_id );
				return is_string( $link ) ? $link : '';
			}
		}

		if ( ! function_exists( 'insightistic_editorial_metadata' ) ) {
			function insightistic_editorial_metadata( $post_id = null ) {
				return array();
			}
		}

		if ( ! function_exists( 'insightistic_editorial_robots' ) ) {
			function insightistic_editorial_robots( $post_id = null ) {
				return '';
			}
		}

		if ( ! function_exists( 'insightistic_editorial_archive_canonical' ) ) {
			function insightistic_editorial_archive_canonical() {
				return '';
			}
		}

		if ( ! function_exists( 'insightistic_editorial_feature_cta' ) ) {
			function insightistic_editorial_feature_cta( $post_id = null ) {
				return array();
			}
		}

		if ( ! function_exists( 'insightistic_commercial_metadata' ) ) {
			function insightistic_commercial_metadata( $post_id = null ) {
				return array();
			}
		}

		if ( ! function_exists( 'insightistic_schema_graph' ) ) {
			function insightistic_schema_graph( $post_id = null ) {
				return array();
			}
		}

		if ( ! function_exists( 'insightistic_agent_home_markdown' ) ) {
			function insightistic_agent_home_markdown() {
				return '';
			}
		}
	},
	-1000
);
