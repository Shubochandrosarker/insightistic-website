<?php
/**
 * Template Name: Contact
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main id="main" class="ins-main ins-page-template ins-contact">
	<?php while ( have_posts() ) : the_post(); ?>
		<header class="ins-section ins-page-hero">
			<div class="ins-container ins-narrow ins-center">
				<p class="ins-eyebrow"><?php esc_html_e( 'Contact', 'insightistic-marketing' ); ?></p>
				<h1 class="ins-page-hero__title"><?php echo esc_html( get_the_title() ? get_the_title() : __( 'Talk to the Insightistic team', 'insightistic-marketing' ) ); ?></h1>
				<?php if ( has_excerpt() ) : ?><p class="ins-lead"><?php echo esc_html( get_the_excerpt() ); ?></p><?php endif; ?>
			</div>
		</header>

		<section class="ins-section">
			<div class="ins-container ins-contact__layout">
				<div class="ins-contact__intro">
					<p class="ins-eyebrow"><?php esc_html_e( 'Contact', 'insightistic-marketing' ); ?></p>
					<h2><?php esc_html_e( 'Talk to a human. Fast.', 'insightistic-marketing' ); ?></h2>
					<p class="ins-lead"><?php esc_html_e( 'Sales questions, support, partnership or feedback — real people from the Insightistic team reply, usually within one business day.', 'insightistic-marketing' ); ?></p>
				</div>

				<aside class="ins-contact__customer ins-panel-card">
					<p class="ins-eyebrow"><?php esc_html_e( 'Customer support', 'insightistic-marketing' ); ?></p>
					<h3><?php esc_html_e( 'Already a customer?', 'insightistic-marketing' ); ?></h3>
					<p><?php esc_html_e( 'Sign in to your dashboard or open a support request from inside the app.', 'insightistic-marketing' ); ?></p>
					<div class="ins-contact__customer-actions">
						<a class="ins-btn ins-btn--ghost ins-btn--block" href="<?php echo esc_url( insightistic_login_url() ); ?>"><?php esc_html_e( 'Sign in', 'insightistic-marketing' ); ?></a>
						<a class="ins-btn ins-btn--brand ins-btn--block" href="<?php echo esc_url( insightistic_register_url() ); ?>"><?php esc_html_e( 'Start free', 'insightistic-marketing' ); ?></a>
					</div>
				</aside>

			<div class="ins-contact__details" aria-label="<?php esc_attr_e( 'Contact details', 'insightistic-marketing' ); ?>">
				<article class="ins-contact__detail ins-panel-card"><h3><?php esc_html_e( 'Email us', 'insightistic-marketing' ); ?></h3><a href="mailto:hello@insightistic.com">hello@insightistic.com</a><p><?php esc_html_e( 'Replies within one business day', 'insightistic-marketing' ); ?></p></article>
				<article class="ins-contact__detail ins-panel-card"><h3><?php esc_html_e( 'WhatsApp', 'insightistic-marketing' ); ?></h3><a href="https://wa.me/15055201914">+1 (505) 520-1914</a><p><?php esc_html_e( 'Mon–Fri · US business hours', 'insightistic-marketing' ); ?></p></article>
				<article class="ins-contact__detail ins-panel-card"><h3><?php esc_html_e( 'Company', 'insightistic-marketing' ); ?></h3><strong>WordPressistic LLC</strong><p><?php esc_html_e( 'Registered in New Mexico, USA. Team works worldwide.', 'insightistic-marketing' ); ?></p></article>
				<article class="ins-contact__detail ins-panel-card"><h3><?php esc_html_e( 'Before you write', 'insightistic-marketing' ); ?></h3><p><?php esc_html_e( 'For technical issues, include your site URL and what you expected versus what happened. Screenshots help.', 'insightistic-marketing' ); ?></p></article>
			</div>

			<div class="ins-contact__form">
				<?php
				// Formistic renders the canonical heading inside the form. Keep a
				// single heading so the contact page does not show duplicate titles.
				insightistic_formistic_form( 'contact' );
				?>
				<p class="ins-consent"><?php esc_html_e( 'By submitting this form, you agree to our', 'insightistic-marketing' ); ?> <a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'insightistic-marketing' ); ?></a>.</p>
			</div>
			</div>
		</section>
	<?php endwhile; ?>
</main>
<?php
get_footer();
