<?php
/**
 * Template Name: Refund & Cancellation Policy
 *
 * @package Insightistic_Marketing
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
?>
<main id="main" class="ins-main ins-legal">
  <article class="ins-container ins-narrow ins-prose ins-legal__article">
    <p class="ins-eyebrow"><?php esc_html_e( 'Clear terms', 'insightistic-marketing' ); ?></p>
    <h1><?php esc_html_e( 'Refund & Cancellation Policy', 'insightistic-marketing' ); ?></h1>
    <p class="ins-lead"><?php esc_html_e( 'Our Angel lifetime deal is designed to be easy to try and safe to evaluate.', 'insightistic-marketing' ); ?></p>
    <h2><?php esc_html_e( 'Angel lifetime deal', 'insightistic-marketing' ); ?></h2>
    <p><?php esc_html_e( 'For an Angel lifetime purchase, you may request a 100% refund within 30 calendar days of the original purchase. No questions asked. Contact support through the Contact page or the support address shown in your order confirmation and include the purchase email or transaction reference so we can locate the order.', 'insightistic-marketing' ); ?></p>
    <h2><?php esc_html_e( 'What lifetime means', 'insightistic-marketing' ); ?></h2>
    <p><?php esc_html_e( 'Lifetime means access to the purchased tier and its included feature family, with the published monthly allowances, for as long as Insightistic operates. It does not promise every future product, premium module or unlimited usage beyond the published tier.', 'insightistic-marketing' ); ?></p>
    <h2><?php esc_html_e( 'Subscriptions', 'insightistic-marketing' ); ?></h2>
    <p><?php esc_html_e( 'Standard subscriptions can be cancelled through the billing portal. Cancellation stops future renewals; access remains available through the paid period unless the applicable plan terms say otherwise.', 'insightistic-marketing' ); ?></p>
    <h2><?php esc_html_e( 'Important launch note', 'insightistic-marketing' ); ?></h2>
    <p><?php esc_html_e( 'This policy must be reviewed and approved by counsel and configured in the payment provider before the Angel campaign is promoted. If the checkout or payment provider shows a different term, do not publish the campaign until the pages and checkout agree.', 'insightistic-marketing' ); ?></p>
    <p><a class="ins-btn ins-btn--brand" href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( 'Contact Insightistic', 'insightistic-marketing' ); ?></a></p>
  </article>
</main>
<?php get_footer(); ?>
