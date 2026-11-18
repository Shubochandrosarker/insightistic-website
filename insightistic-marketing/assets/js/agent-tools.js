( function () {
	'use strict';

	function registerInsightisticTool() {
		var modelContext = document.modelContext || ( window.navigator && window.navigator.modelContext );
		if ( ! modelContext || 'function' !== typeof modelContext.registerTool ) {
			return;
		}

		var registration = modelContext.registerTool( {
			name: 'search_insightistic_resources',
			description: 'Find public Insightistic product, learning, company, contact, security or legal resources by keyword. This tool only searches published public resource metadata.',
			inputSchema: {
				type: 'object',
				properties: {
					query: {
						type: 'string',
						description: 'A short keyword or question such as pricing, privacy, WooCommerce analytics or contact.',
					}
				},
				required: [ 'query' ],
				additionalProperties: false,
			},
			execute: async function ( input ) {
				var query = input && 'string' === typeof input.query ? input.query.trim().toLowerCase() : '';
				var response = await fetch( '/llms-full.txt', { credentials: 'omit', headers: { Accept: 'text/plain' } } );
				if ( ! response.ok ) {
					throw new Error( 'Insightistic public resources are temporarily unavailable.' );
				}

				var text = await response.text();
				if ( ! query ) {
					return { content: [ { type: 'text', text: text } ] };
				}

				var terms = query.split( /\s+/ ).filter( Boolean );
				var matches = text.split( /\r?\n/ ).filter( function ( line ) {
					var lower = line.toLowerCase();
					return terms.every( function ( term ) { return lower.indexOf( term ) !== -1; } );
				} ).slice( 0, 80 );

				return { content: [ { type: 'text', text: matches.length ? matches.join( '\n' ) : 'No matching public Insightistic resource was found.' } ] };
			},
		} );

		if ( registration && 'function' === typeof registration.catch ) {
			registration.catch( function () {} );
		}
	}

	if ( 'loading' === document.readyState ) {
		document.addEventListener( 'DOMContentLoaded', registerInsightisticTool, { once: true } );
	} else {
		registerInsightisticTool();
	}
}() );
