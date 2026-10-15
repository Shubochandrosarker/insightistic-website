<?php
/**
 * WordPress connector section (steps + visual).
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$steps = array(
	array( 'n' => '1', 'title' => __( 'Get the free plugin', 'insightistic-marketing' ), 'text' => __( 'Download Insightistic for WordPress and install it on your site.', 'insightistic-marketing' ) ),
	array( 'n' => '2', 'title' => __( 'Create a free account', 'insightistic-marketing' ), 'text' => __( 'Verify your email, then connect your site from the Insightistic app.', 'insightistic-marketing' ) ),
	array( 'n' => '3', 'title' => __( 'Connect and review your data', 'insightistic-marketing' ), 'text' => __( 'Paste the site license key in Insightistic → License. Your signed sync brings site data into the dashboard.', 'insightistic-marketing' ) ),
);
?>
<section class="ins-section ins-connector" aria-labelledby="ins-connector-title">
	<div class="ins-container">
		<div class="ins-section__head">
			<p class="ins-eyebrow"><?php esc_html_e( 'Getting connected', 'insightistic-marketing' ); ?></p>
			<h2 id="ins-connector-title"><?php esc_html_e( 'Connect your site securely, then read the signal', 'insightistic-marketing' ); ?></h2>
			<p class="ins-lead ins-center"><?php esc_html_e( 'Every sync runs over a signed connection — no customer card data ever leaves WordPress. Don\'t run the Insightistic plugin on this site? A standalone connector plugin covers that case too.', 'insightistic-marketing' ); ?></p>
		</div>
		<ol class="ins-steps">
			<?php foreach ( $steps as $step ) : ?>
				<li class="ins-step">
					<span class="ins-step__num"><?php echo esc_html( $step['n'] ); ?></span>
					<h3 class="ins-step__title"><?php echo esc_html( $step['title'] ); ?></h3>
					<p class="ins-step__text"><?php echo esc_html( $step['text'] ); ?></p>
				</li>
			<?php endforeach; ?>
		</ol>
		<div class="ins-center">
			<a class="ins-btn ins-btn--brand ins-btn--lg" href="https://github.com/Wordpressistic/insightistic/releases/latest" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Download the free WordPress plugin', 'insightistic-marketing' ); ?></a>
			<a class="ins-link ins-connector__account-link" href="<?php echo esc_url( insightistic_register_url() ); ?>"><?php esc_html_e( 'Create your free Insightistic account', 'insightistic-marketing' ); ?></a>
		</div>
	</div>
</section>
