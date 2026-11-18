<?php
/**
 * Agent-ready discovery and public read-only tools.
 *
 * @package Insightistic_Marketing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Public resources that agents may safely discover without authentication. */
function insightistic_agent_public_resources() {
	$resources = array(
		array( 'label' => 'About Insightistic', 'url' => home_url( '/about/' ), 'description' => 'Company, product and editorial context for Insightistic.' ),
		array( 'label' => 'Contact Insightistic', 'url' => home_url( '/contact/' ), 'description' => 'Product, support, legal and accessibility contact route.' ),
		array( 'label' => 'Security and trust', 'url' => home_url( '/security/' ), 'description' => 'Public security, privacy and data-boundary information.' ),
		array( 'label' => 'Legal notices', 'url' => home_url( '/legal-notices/' ), 'description' => 'Public operator, entity and legal notice information.' ),
		array( 'label' => 'Privacy policy', 'url' => home_url( '/privacy-policy/' ), 'description' => 'Public information-handling and privacy policy.' ),
		array( 'label' => 'Terms of service', 'url' => home_url( '/terms/' ), 'description' => 'Terms governing the public website, app and related services.' ),
		array( 'label' => 'Pricing', 'url' => home_url( '/pricing/' ), 'description' => 'Current public Insightistic plan and pricing information.' ),
		array( 'label' => 'Knowledgebase', 'url' => home_url( '/knowledgebase/' ), 'description' => 'Practical WordPress, WooCommerce, SEO and analytics guidance.' ),
		array( 'label' => 'Machine-readable overview', 'url' => home_url( '/llms.txt' ), 'description' => 'Compact public overview intended for assistants and other machine readers.' ),
		array( 'label' => 'Full machine-readable overview', 'url' => home_url( '/llms-full.txt' ), 'description' => 'Expanded public pages, routes, legal and editorial reference.' ),
	);

	return apply_filters( 'insightistic_agent_public_resources', $resources );
}

/** Build a compact Markdown representation of the homepage for content negotiation. */
function insightistic_agent_home_markdown() {
	$details  = insightistic_business_details();
	$lines    = array(
		'# Insightistic',
		'',
		insightistic_discovery_site_summary(),
		'',
		'## Business identity',
		'',
		'- Operator: ' . $details['legal_name'],
		'- Email: ' . $details['email'],
		'- Telephone: ' . $details['telephone'],
		'- Address: ' . $details['address'] . ', ' . $details['city'] . ', ' . $details['state'] . ' ' . $details['postal_code'] . ', ' . $details['country'],
		'',
		'## Product areas',
		'',
	);

	foreach ( insightistic_knowledgebase_topics() as $topic ) {
		$lines[] = '- [' . $topic['title'] . '](' . $topic['url'] . '): ' . $topic['description'];
	}

	$lines[] = '';
	$lines[] = '## Public resources';
	$lines[] = '';
	foreach ( insightistic_agent_public_resources() as $resource ) {
		$lines[] = '- [' . $resource['label'] . '](' . $resource['url'] . '): ' . $resource['description'];
	}

	return implode( "\n", $lines ) . "\n";
}

function insightistic_agent_is_home_request() {
	if ( function_exists( 'is_front_page' ) && is_front_page() ) {
		return true;
	}

	$request_path = wp_parse_url( 'https://insightistic.invalid' . (string) ( $_SERVER['REQUEST_URI'] ?? '/' ), PHP_URL_PATH );
	$home_path    = wp_parse_url( home_url( '/' ), PHP_URL_PATH );

	return untrailingslashit( '/' . ltrim( (string) $request_path, '/' ) ) === untrailingslashit( '/' . ltrim( (string) $home_path, '/' ) );
}

function insightistic_agent_accepts_markdown() {
	$accept = strtolower( (string) ( $_SERVER['HTTP_ACCEPT'] ?? '' ) );
	foreach ( explode( ',', $accept ) as $part ) {
		$part = trim( $part );
		$type = trim( (string) strtok( $part, ';' ) );
		if ( ! in_array( $type, array( 'text/markdown', 'application/markdown' ), true ) ) {
			continue;
		}
		if ( preg_match( '/(?:^|;)\s*q\s*=\s*([0-9.]+)/', $part, $matches ) && (float) $matches[1] <= 0 ) {
			continue;
		}
		return true;
	}

	return false;
}

/** Emit a Markdown homepage variant when an agent explicitly requests it. */
function insightistic_agent_emit_markdown_homepage() {
	status_header( 200 );
	header( 'Cache-Control: public, max-age=300, s-maxage=300' );
	header( 'Content-Type: text/markdown; charset=' . get_bloginfo( 'charset' ) );
	header( 'Vary: Accept', false );
	header( 'X-Robots-Tag: noindex, follow' );
	header( 'Link: <' . esc_url_raw( home_url( '/llms.txt' ) ) . '>; rel="alternate"; type="text/plain"; title="Insightistic machine-readable overview", <' . esc_url_raw( home_url( '/' ) ) . '>; rel="alternate"; type="text/markdown"; title="Insightistic homepage Markdown"', false );
	echo insightistic_agent_home_markdown();
	exit;
}

/** Advertise machine-readable resources before the page is rendered or cached. */
function insightistic_agent_filter_response_headers( $headers ) {
	if ( ! insightistic_agent_is_home_request() ) {
		return $headers;
	}

	$headers['Vary'] = empty( $headers['Vary'] ) ? 'Accept' : $headers['Vary'] . ', Accept';
	$headers['Link'] = '<' . esc_url_raw( home_url( '/llms.txt' ) ) . '>; rel="alternate"; type="text/plain"; title="Insightistic machine-readable overview", <' . esc_url_raw( home_url( '/' ) ) . '>; rel="alternate"; type="text/markdown"; title="Insightistic homepage Markdown"';

	return $headers;
}
add_filter( 'wp_headers', 'insightistic_agent_filter_response_headers', 20 );

function insightistic_agent_content_negotiation() {
	if ( insightistic_agent_is_home_request() && insightistic_agent_accepts_markdown() ) {
		insightistic_agent_emit_markdown_homepage();
	}
}
add_action( 'template_redirect', 'insightistic_agent_content_negotiation', 0 );

/** Return the tools exposed by the public MCP endpoint. */
function insightistic_agent_mcp_tools() {
	return array(
		array(
			'name'        => 'get_insightistic_overview',
			'description' => 'Return the public Insightistic product, business identity, trust and contact overview. This tool does not access accounts or customer data.',
			'inputSchema' => array(
				'type'                 => 'object',
				'properties'           => new stdClass(),
				'additionalProperties' => false,
			),
		),
		array(
			'name'        => 'search_insightistic_resources',
			'description' => 'Find public Insightistic product, learning, company, contact, security or legal resources by keyword. This tool only searches published public resource metadata.',
			'inputSchema' => array(
				'type'                 => 'object',
				'properties'           => array(
					'query' => array(
						'type'        => 'string',
						'description' => 'A short keyword or question such as pricing, privacy, WooCommerce analytics or contact.',
					),
				),
				'required'            => array( 'query' ),
				'additionalProperties' => false,
			),
		),
	);
}

function insightistic_agent_mcp_search( $query ) {
	$terms   = preg_split( '/\s+/', strtolower( trim( $query ) ), -1, PREG_SPLIT_NO_EMPTY );
	$matches = array();
	foreach ( insightistic_agent_public_resources() as $resource ) {
		$haystack = strtolower( $resource['label'] . ' ' . $resource['description'] . ' ' . $resource['url'] );
		$found    = true;
		foreach ( $terms as $term ) {
			if ( false === strpos( $haystack, $term ) ) {
				$found = false;
				break;
			}
		}
		if ( $found ) {
			$matches[] = '- [' . $resource['label'] . '](' . $resource['url'] . '): ' . $resource['description'];
		}
	}

	return $matches ? implode( "\n", $matches ) : 'No matching public Insightistic resource was found.';
}

function insightistic_agent_mcp_response( $id, $result ) {
	return new WP_REST_Response( array( 'jsonrpc' => '2.0', 'id' => $id, 'result' => $result ), 200 );
}

function insightistic_agent_mcp_error( $id, $code, $message ) {
	return new WP_REST_Response( array( 'jsonrpc' => '2.0', 'id' => $id, 'error' => array( 'code' => $code, 'message' => $message ) ), 200 );
}

/** Public read-only MCP JSON-RPC transport for the tools listed in the server card. */
function insightistic_agent_mcp_handle( WP_REST_Request $request ) {
	$payload = $request->get_json_params();
	if ( ! is_array( $payload ) || '2.0' !== ( $payload['jsonrpc'] ?? '' ) ) {
		return insightistic_agent_mcp_error( null, -32600, 'A JSON-RPC 2.0 request is required.' );
	}

	$id     = $payload['id'] ?? null;
	$method = (string) ( $payload['method'] ?? '' );
	$params = is_array( $payload['params'] ?? null ) ? $payload['params'] : array();

	if ( 0 === strpos( $method, 'notifications/' ) ) {
		return new WP_REST_Response( null, 204 );
	}

	switch ( $method ) {
		case 'initialize':
			return insightistic_agent_mcp_response(
				$id,
				array(
					'protocolVersion' => '2025-06-18',
					'capabilities'    => array( 'tools' => array( 'listChanged' => false ) ),
					'serverInfo'      => array( 'name' => 'insightistic-public', 'title' => 'Insightistic public resources', 'version' => '1.0.0' ),
					'instructions'    => 'This server exposes public Insightistic resources only. It does not access accounts, analytics workspaces or customer data.',
				)
			);

		case 'ping':
			return insightistic_agent_mcp_response( $id, new stdClass() );

		case 'tools/list':
			return insightistic_agent_mcp_response( $id, array( 'tools' => insightistic_agent_mcp_tools() ) );

		case 'tools/call':
			$name      = (string) ( $params['name'] ?? '' );
			$arguments = is_array( $params['arguments'] ?? null ) ? $params['arguments'] : array();
			if ( 'get_insightistic_overview' === $name ) {
				$text = insightistic_agent_home_markdown();
			} elseif ( 'search_insightistic_resources' === $name ) {
				$query = sanitize_text_field( (string) ( $arguments['query'] ?? '' ) );
				if ( '' === $query ) {
					return insightistic_agent_mcp_error( $id, -32602, 'The query argument is required.' );
				}
				$text = insightistic_agent_mcp_search( $query );
			} else {
				return insightistic_agent_mcp_error( $id, -32602, 'Unknown tool.' );
			}

			return insightistic_agent_mcp_response( $id, array( 'content' => array( array( 'type' => 'text', 'text' => $text ) ), 'isError' => false ) );

		default:
			return insightistic_agent_mcp_error( $id, -32601, 'Method not found.' );
	}
}

function insightistic_agent_mcp_permission( WP_REST_Request $request ) {
	if ( strlen( $request->get_body() ) > 65536 ) {
		return new WP_Error( 'insightistic_mcp_payload_too_large', 'Request body is too large.', array( 'status' => 413 ) );
	}

	return true;
}

function insightistic_register_agent_mcp_endpoint() {
	register_rest_route(
		'insightistic/v1',
		'/mcp',
		array(
			'methods'             => WP_REST_Server::CREATABLE,
			'callback'            => 'insightistic_agent_mcp_handle',
			'permission_callback' => 'insightistic_agent_mcp_permission',
		)
	);
}
add_action( 'rest_api_init', 'insightistic_register_agent_mcp_endpoint' );

/** Emit the SEP-1649-compatible public server card. */
function insightistic_emit_server_card() {
	status_header( 200 );
	header( 'Cache-Control: public, max-age=3600, s-maxage=3600' );
	header( 'Content-Type: application/json; charset=' . get_bloginfo( 'charset' ) );

	$card = array(
		'$schema'         => 'https://static.modelcontextprotocol.io/schemas/mcp-server-card/v1.json',
		'version'         => '1.0',
		'protocolVersion' => '2025-06-18',
		'serverInfo'      => array( 'name' => 'insightistic-public', 'title' => 'Insightistic public resources', 'version' => '1.0.0' ),
		'description'     => 'Public, read-only Insightistic product, learning, contact, trust and legal resources for agents.',
		'documentationUrl' => home_url( '/llms.txt' ),
		'transport'       => array( 'type' => 'streamable-http', 'endpoint' => rest_url( 'insightistic/v1/mcp' ) ),
		'capabilities'    => array( 'tools' => array( 'listChanged' => false ) ),
	);

	echo wp_json_encode( $card, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
	exit;
}

function insightistic_enqueue_agent_tools() {
	if ( is_admin() ) {
		return;
	}

	$path    = INSIGHTISTIC_DIR . '/assets/js/agent-tools.js';
	$version = file_exists( $path ) ? (string) filemtime( $path ) : INSIGHTISTIC_MARKETING_VERSION;
	wp_enqueue_script( 'insightistic-agent-tools', INSIGHTISTIC_URI . '/assets/js/agent-tools.js', array(), $version, true );
}
add_action( 'wp_enqueue_scripts', 'insightistic_enqueue_agent_tools', 30 );
