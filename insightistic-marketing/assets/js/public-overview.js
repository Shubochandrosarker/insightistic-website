/**
 * Progressively enhance the homepage workspace example.
 */
( function () {
	'use strict';

	const example = document.querySelector( '.ins-home-refresh [role="tablist"]' );
	if ( ! example ) {
		return;
	}

	const tabs = Array.from( example.querySelectorAll( '[role="tab"]' ) );
	example.hidden = false;

	function selectTab( selected ) {
		for ( const tab of tabs ) {
			const active = tab === selected;
			tab.setAttribute( 'aria-selected', String( active ) );
			tab.tabIndex = active ? 0 : -1;
			document.getElementById( tab.getAttribute( 'aria-controls' ) ).hidden = ! active;
		}
	}

	example.addEventListener( 'click', ( event ) => {
		const tab = event.target.closest( '[role="tab"]' );
		if ( tab ) {
			selectTab( tab );
		}
	} );

	example.addEventListener( 'keydown', ( event ) => {
		const index = tabs.indexOf( event.target );
		const positions = {
			ArrowRight: ( index + 1 ) % tabs.length,
			ArrowLeft: ( index + tabs.length - 1 ) % tabs.length,
			Home: 0,
			End: tabs.length - 1,
		};
		const next = positions[ event.key ];
		if ( index < 0 || ! Number.isInteger( next ) ) {
			return;
		}

		event.preventDefault();
		selectTab( tabs[ next ] );
		tabs[ next ].focus();
	} );
} )();
