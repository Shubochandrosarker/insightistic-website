<?php
/**
 * Template Name: Lifetime Deal
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Keep the original public URL as a compatibility alias. The campaign now
 * lives at /ltd/ so every campaign link shares one canonical destination.
 */
wp_safe_redirect( home_url( '/ltd/' ), 301 );
exit;
