<?php
/**
 * Footer: brand + newsletter + widget columns + legal row.
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$ins_socials = array(
	'twitter'  => 'X / Twitter',
	'linkedin' => 'LinkedIn',
	'youtube'  => 'YouTube',
	'github'   => 'GitHub',
);
$ins_business = insightistic_business_details();
$ins_footer_sidebars = array();
foreach ( array( 'footer-1', 'footer-2', 'footer-3' ) as $ins_sidebar_id ) {
	if ( ! is_active_sidebar( $ins_sidebar_id ) ) {
		continue;
	}
	ob_start();
	dynamic_sidebar( $ins_sidebar_id );
	$ins_sidebar_html = (string) ob_get_clean();
	// Empty/style-only widgets should not reserve a large visible card or
	// leave a blank track in the footer grid.
	$ins_sidebar_text = trim( wp_strip_all_tags( preg_replace( '/<\s*(style|script)\b[^>]*>.*?<\/\s*\1\s*>/is', '', $ins_sidebar_html ) ) );
	// Some legacy widgets contain a raw stylesheet as text. Do not publish it
	// as footer copy; fall back to the controlled navigation columns instead.
	$ins_sidebar_has_raw_css = (bool) preg_match( '/(?:^|\s)(?:body|html|[#.]?[a-z][a-z0-9_-]*)\s*\{|--[a-z0-9_-]+\s*:|\b(?:font-size|display|margin|padding|color|background)\s*:/i', $ins_sidebar_text );
	if ( '' !== $ins_sidebar_text && ! $ins_sidebar_has_raw_css ) {
		$ins_footer_sidebars[] = $ins_sidebar_html;
	}
}
?>
<footer class="ins-footer" role="contentinfo">
	<div class="ins-container">

		<div class="ins-footer__top">
			<div class="ins-footer__brand ins-reveal">
				<span class="ins-footer__eyebrow"><?php esc_html_e( 'Insightistic analytics', 'insightistic-marketing' ); ?></span>
				<a class="ins-logo ins-logo--inverse" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img class="ins-logo__image ins-logo__image--footer" src="<?php echo esc_url( insightistic_asset_url( 'assets/images/insightistic-brand-logo.png' ) ); ?>" width="2172" height="724" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" loading="lazy" decoding="async" />
				</a>
				<p class="ins-footer__tagline">
					<?php echo esc_html( insightistic_option( 'insightistic_footer_tagline', __( 'AI business analytics for WordPress & WooCommerce.', 'insightistic-marketing' ) ) ); ?>
				</p>
				<p class="ins-footer__parent"><span class="ins-footer__parent-label"><?php esc_html_e( 'A product of', 'insightistic-marketing' ); ?></span><strong>WordPressistic LLC</strong><span><?php esc_html_e( 'under the WPISTIC EcoSystem', 'insightistic-marketing' ); ?></span></p>
				<p><a class="ins-link" href="https://wordpressistic.com/" target="_blank" rel="noopener"><?php esc_html_e( 'Part of the WordPressistic ecosystem', 'insightistic-marketing' ); ?> <?php echo insightistic_icon( 'arrow-right', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a></p>

				<div class="ins-footer__newsletter">
					<h3><?php esc_html_e( 'Get product updates', 'insightistic-marketing' ); ?></h3>
					<?php insightistic_formistic_form( 'newsletter' ); ?>
				</div>
			</div>

			<div class="ins-footer__cols">
				<?php if ( ! empty( $ins_footer_sidebars ) ) : ?>
					<?php foreach ( $ins_footer_sidebars as $ins_sidebar_html ) : ?>
						<div class="ins-footer__col ins-reveal"><?php echo $ins_sidebar_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- rendered by trusted widget APIs. ?></div>
					<?php endforeach; ?>
					<div class="ins-footer__col ins-reveal">
						<h3><?php esc_html_e( 'Insights', 'insightistic-marketing' ); ?></h3>
						<ul>
							<li><a href="<?php echo esc_url( home_url( '/category/ai-insights/' ) ); ?>"><?php esc_html_e( 'AI insights', 'insightistic-marketing' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/category/analytics/' ) ); ?>"><?php esc_html_e( 'Analytics', 'insightistic-marketing' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/category/seo/' ) ); ?>"><?php esc_html_e( 'SEO', 'insightistic-marketing' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/category/product-updates/' ) ); ?>"><?php esc_html_e( 'Product updates', 'insightistic-marketing' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/woocommerce-sales-reports/' ) ); ?>"><?php esc_html_e( 'WooCommerce sales reports', 'insightistic-marketing' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/woocommerce-analytics-uk-stores/' ) ); ?>"><?php esc_html_e( 'WooCommerce analytics for UK stores', 'insightistic-marketing' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/do-i-need-a-wordpress-analytics-plugin/' ) ); ?>"><?php esc_html_e( 'WordPress analytics guide', 'insightistic-marketing' ); ?></a></li>
						</ul>
					</div>
				<?php else : ?>
					<div class="ins-footer__col ins-reveal">
						<h3><?php esc_html_e( 'Product', 'insightistic-marketing' ); ?></h3>
						<ul>
							<li><a href="<?php echo esc_url( home_url( '/features' ) ); ?>"><?php esc_html_e( 'Features', 'insightistic-marketing' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/pricing' ) ); ?>"><?php esc_html_e( 'Pricing', 'insightistic-marketing' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/traffic-analytics' ) ); ?>"><?php esc_html_e( 'Traffic analytics', 'insightistic-marketing' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/seo-analytics' ) ); ?>"><?php esc_html_e( 'SEO analytics', 'insightistic-marketing' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/performance-monitoring' ) ); ?>"><?php esc_html_e( 'Performance monitoring', 'insightistic-marketing' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/integrations' ) ); ?>"><?php esc_html_e( 'Integrations', 'insightistic-marketing' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/agency' ) ); ?>"><?php esc_html_e( 'For agencies', 'insightistic-marketing' ); ?></a></li>
						</ul>
					</div>
					<div class="ins-footer__col ins-reveal">
						<h3><?php esc_html_e( 'Company', 'insightistic-marketing' ); ?></h3>
						<ul>
							<li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>"><?php esc_html_e( 'About', 'insightistic-marketing' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/why-insightistic' ) ); ?>"><?php esc_html_e( 'Why Insightistic', 'insightistic-marketing' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/security' ) ); ?>"><?php esc_html_e( 'Security', 'insightistic-marketing' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/changelog' ) ); ?>"><?php esc_html_e( 'Changelog', 'insightistic-marketing' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/blog' ) ); ?>"><?php esc_html_e( 'Blog', 'insightistic-marketing' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/knowledgebase' ) ); ?>"><?php esc_html_e( 'Knowledgebase', 'insightistic-marketing' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/ecosystem' ) ); ?>"><?php esc_html_e( 'Ecosystem', 'insightistic-marketing' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/sitemap' ) ); ?>"><?php esc_html_e( 'Sitemap', 'insightistic-marketing' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( 'Contact', 'insightistic-marketing' ); ?></a></li>
						</ul>
					</div>
					<div class="ins-footer__col ins-reveal">
						<h3><?php esc_html_e( 'Insights', 'insightistic-marketing' ); ?></h3>
						<ul>
							<li><a href="<?php echo esc_url( home_url( '/category/ai-insights/' ) ); ?>"><?php esc_html_e( 'AI insights', 'insightistic-marketing' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/category/analytics/' ) ); ?>"><?php esc_html_e( 'Analytics', 'insightistic-marketing' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/category/seo/' ) ); ?>"><?php esc_html_e( 'SEO', 'insightistic-marketing' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/category/product-updates/' ) ); ?>"><?php esc_html_e( 'Product updates', 'insightistic-marketing' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/woocommerce-sales-reports/' ) ); ?>"><?php esc_html_e( 'WooCommerce sales reports', 'insightistic-marketing' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/woocommerce-analytics-uk-stores/' ) ); ?>"><?php esc_html_e( 'WooCommerce analytics for UK stores', 'insightistic-marketing' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/do-i-need-a-wordpress-analytics-plugin/' ) ); ?>"><?php esc_html_e( 'WordPress analytics guide', 'insightistic-marketing' ); ?></a></li>
						</ul>
					</div>
					<div class="ins-footer__col ins-reveal">
						<h3><?php esc_html_e( 'App', 'insightistic-marketing' ); ?></h3>
						<ul>
							<li><a href="<?php echo esc_url( insightistic_login_url() ); ?>"><?php esc_html_e( 'Sign in', 'insightistic-marketing' ); ?></a></li>
							<li><a href="<?php echo esc_url( insightistic_register_url() ); ?>"><?php esc_html_e( 'Start free', 'insightistic-marketing' ); ?></a></li>
							<li><a href="<?php echo esc_url( insightistic_dashboard_url() ); ?>"><?php esc_html_e( 'Dashboard', 'insightistic-marketing' ); ?></a></li>
						</ul>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="ins-footer__bottom ins-reveal">
			<p class="ins-footer__copy">
				&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?> · <?php esc_html_e( 'by WordPressistic', 'insightistic-marketing' ); ?>
			</p>
			<address class="ins-footer__entity"><strong><?php echo esc_html( $ins_business['legal_name'] ); ?></strong><br><?php echo esc_html( $ins_business['address'] ); ?><br><?php echo esc_html( $ins_business['city'] . ', ' . $ins_business['state'] . ' ' . $ins_business['postal_code'] . ( 'US' === $ins_business['country'] ? ', USA' : ', ' . $ins_business['country'] ) ); ?></address>

			<?php
			if ( has_nav_menu( 'legal' ) ) {
				$legal_menu = wp_nav_menu(
					array(
						'theme_location' => 'legal',
						'container'      => false,
						'menu_class'     => 'ins-footer__legal',
						'depth'          => 1,
						'fallback_cb'    => false,
						'echo'           => false,
					)
				);
				if ( false === strpos( (string) $legal_menu, '/sitemap' ) ) {
					$legal_menu = str_replace(
						'</ul>',
						'<li class="menu-item"><a href="' . esc_url( home_url( '/sitemap/' ) ) . '">' . esc_html__( 'Sitemap', 'insightistic-marketing' ) . '</a></li></ul>',
						(string) $legal_menu
					);
				}
				echo wp_kses_post( $legal_menu );
			} else {
				echo '<ul class="ins-footer__legal">';
				printf( '<li><a href="%s">%s</a></li>', esc_url( home_url( '/privacy-policy' ) ), esc_html__( 'Privacy', 'insightistic-marketing' ) );
				printf( '<li><a href="%s">%s</a></li>', esc_url( home_url( '/refunds' ) ), esc_html__( 'Refunds', 'insightistic-marketing' ) );
				printf( '<li><a href="%s">%s</a></li>', esc_url( home_url( '/terms' ) ), esc_html__( 'Terms', 'insightistic-marketing' ) );
				printf( '<li><a href="%s">%s</a></li>', esc_url( home_url( '/cookies' ) ), esc_html__( 'Cookies', 'insightistic-marketing' ) );
				printf( '<li><a href="%s">%s</a></li>', esc_url( home_url( '/security' ) ), esc_html__( 'Security', 'insightistic-marketing' ) );
				printf( '<li><a href="%s">%s</a></li>', esc_url( home_url( '/data-processing' ) ), esc_html__( 'Data processing', 'insightistic-marketing' ) );
				printf( '<li><a href="%s">%s</a></li>', esc_url( home_url( '/legal-notices' ) ), esc_html__( 'Legal notices', 'insightistic-marketing' ) );
				printf( '<li><a href="%s">%s</a></li>', esc_url( home_url( '/sitemap/' ) ), esc_html__( 'Sitemap', 'insightistic-marketing' ) );
				echo '</ul>';
			}
			?>

			<div class="ins-footer__social">
				<?php
				foreach ( $ins_socials as $slug => $label ) {
					$url = insightistic_option( 'insightistic_social_' . $slug, '' );
					if ( $url ) {
						printf(
							'<a href="%1$s" target="_blank" rel="noopener" aria-label="%2$s">%2$s</a>',
							esc_url( $url ),
							esc_html( $label )
						);
					}
				}
				?>
			</div>
		</div>
	</div>
</footer>
