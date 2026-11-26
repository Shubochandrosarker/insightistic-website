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
?>
<!-- KingSumo giveaway badge (site-wide, above the footer) -->
<script src="https://kingsumo.com/js/badge.js" data-id="ks-badge" data-url="https://kingsumo.com/g/1j2n8k3/win-10-insightistic-ai-business-intelligence-license-tier-5-plans" data-title="<?php echo esc_attr( 'Win 10 Insightistic - AI business intelligence License Tier 5 plans' ); ?>" data-enter-giveaway="<?php echo esc_attr( 'Enter Giveaway' ); ?>" data-logo="false" async></script>
<footer class="ins-footer" role="contentinfo">
	<div class="ins-container">

		<div class="ins-footer__top">
			<div class="ins-footer__brand">
				<span class="ins-footer__eyebrow"><?php esc_html_e( 'Insightistic analytics', 'insightistic-marketing' ); ?></span>
				<a class="ins-logo ins-logo--inverse" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img class="ins-logo__icon" src="<?php echo esc_url( insightistic_asset_url( 'assets/images/insightistic-icon.png' ) ); ?>" alt="" aria-hidden="true" />
					<span class="ins-logo__wordmark"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
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
				<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
					<div class="ins-footer__col"><?php dynamic_sidebar( 'footer-1' ); ?></div>
				<?php endif; ?>
				<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
					<div class="ins-footer__col"><?php dynamic_sidebar( 'footer-2' ); ?></div>
				<?php endif; ?>
				<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
					<div class="ins-footer__col"><?php dynamic_sidebar( 'footer-3' ); ?></div>
				<?php endif; ?>

				<?php if ( ! is_active_sidebar( 'footer-1' ) && ! is_active_sidebar( 'footer-2' ) && ! is_active_sidebar( 'footer-3' ) ) : ?>
					<div class="ins-footer__col">
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
					<div class="ins-footer__col">
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
					<div class="ins-footer__col">
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

		<div class="ins-footer__bottom">
			<p class="ins-footer__copy">
				&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?> · <?php esc_html_e( 'by WordPressistic', 'insightistic-marketing' ); ?>
			</p>
			<address class="ins-footer__entity"><strong><?php echo esc_html( $ins_business['legal_name'] ); ?></strong><br><?php echo esc_html( $ins_business['address'] ); ?><br><?php echo esc_html( $ins_business['city'] . ', ' . $ins_business['state'] . ' ' . $ins_business['postal_code'] . ( 'US' === $ins_business['country'] ? ', USA' : ', ' . $ins_business['country'] ) ); ?></address>

			<?php
			if ( has_nav_menu( 'legal' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'legal',
						'container'      => false,
						'menu_class'     => 'ins-footer__legal',
						'depth'          => 1,
						'fallback_cb'    => false,
					)
				);
			} else {
				echo '<ul class="ins-footer__legal">';
				printf( '<li><a href="%s">%s</a></li>', esc_url( home_url( '/privacy-policy' ) ), esc_html__( 'Privacy', 'insightistic-marketing' ) );
				printf( '<li><a href="%s">%s</a></li>', esc_url( home_url( '/terms' ) ), esc_html__( 'Terms', 'insightistic-marketing' ) );
				printf( '<li><a href="%s">%s</a></li>', esc_url( home_url( '/cookies' ) ), esc_html__( 'Cookies', 'insightistic-marketing' ) );
				printf( '<li><a href="%s">%s</a></li>', esc_url( home_url( '/data-processing' ) ), esc_html__( 'Data processing', 'insightistic-marketing' ) );
				printf( '<li><a href="%s">%s</a></li>', esc_url( home_url( '/legal-notices' ) ), esc_html__( 'Legal notices', 'insightistic-marketing' ) );
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
