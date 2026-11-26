/**
 * Store a visitor's explicit decision to hide the current campaign.
 */
( function () {
	'use strict';

	const banner = document.querySelector( '.wpistic-ins-ltd' );
	if ( ! banner ) {
		return;
	}

	const key = 'wpistic-insightistic-ltd-dismissed-v1';
	try {
		banner.hidden = localStorage.getItem( key ) === '1';
	} catch ( error ) {
		// The close control still works when storage is unavailable.
	}

	const dismiss = banner.querySelector( '.wpistic-ins-ltd__dismiss' );
	dismiss.hidden = false;
	dismiss.addEventListener( 'click', () => {
		banner.hidden = true;
		try {
			localStorage.setItem( key, '1' );
		} catch ( error ) {
			// Dismiss for this page view.
		}
		const next = document.querySelector( 'a.skip-link, header a[href], main a[href]' );
		if ( next ) {
			next.focus();
		}
	} );
} )();
