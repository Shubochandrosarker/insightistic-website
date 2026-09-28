<?php
/**
 * Metric card. Pass via: get_template_part(..., null, array('label','value','delta')).
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$ins_label = isset( $args['label'] ) ? $args['label'] : '';
$ins_value = isset( $args['value'] ) ? $args['value'] : '';
$ins_delta = isset( $args['delta'] ) ? $args['delta'] : '';
$ins_countable = (bool) preg_match( '/^[^a-z]*[\d,.]+(?:\s*[%a-z]*)?$/i', trim( $ins_value ) );
?>
<div class="ins-metric<?php echo $ins_countable ? ' ins-metric--animated' : ''; ?>">
	<span class="ins-metric__label"><?php echo esc_html( $ins_label ); ?></span>
	<span class="ins-metric__value"<?php echo $ins_countable ? ' data-count="' . esc_attr( $ins_value ) . '"' : ''; ?>><?php echo esc_html( $ins_value ); ?></span>
	<?php if ( $ins_delta ) : ?>
		<span class="ins-metric__delta"><?php echo esc_html( $ins_delta ); ?></span>
	<?php endif; ?>
</div>
