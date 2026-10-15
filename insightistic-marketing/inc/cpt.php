<?php
/**
 * Optional "Testimonial" custom post type used by the testimonials section.
 * Only editor-entered, consented proof is rendered; the theme never invents
 * customer quotes or identities as fallback content.
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action(
	'init',
	function () {
		register_post_type(
			'ins_testimonial',
			array(
				'labels'        => array(
					'name'          => __( 'Testimonials', 'insightistic-marketing' ),
					'singular_name' => __( 'Testimonial', 'insightistic-marketing' ),
					'add_new_item'  => __( 'Add Testimonial', 'insightistic-marketing' ),
					'edit_item'     => __( 'Edit Testimonial', 'insightistic-marketing' ),
				),
				'public'        => false,
				'show_ui'       => true,
				'show_in_rest'  => true,
				'menu_icon'     => 'dashicons-format-quote',
				'menu_position' => 26,
				'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
				'has_archive'   => false,
				'rewrite'       => false,
			)
		);
	}
);

/**
 * Return editor-entered testimonials only.
 *
 * @return array<int,array{quote:string,name:string,role:string}>
 */
function insightistic_testimonials() {
	$items = array();

	$query = new WP_Query(
		array(
			'post_type'      => 'ins_testimonial',
			'posts_per_page' => 6,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'no_found_rows'  => true,
		)
	);

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$items[] = array(
				'quote' => wp_strip_all_tags( get_the_content() ),
				'name'  => get_the_title(),
				'role'  => (string) get_post_meta( get_the_ID(), '_ins_role', true ),
			);
		}
		wp_reset_postdata();
	}

	return apply_filters( 'insightistic_testimonials', $items );
}
