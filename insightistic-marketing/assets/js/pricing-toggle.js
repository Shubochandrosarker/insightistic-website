/**
 * Pricing monthly/yearly toggle (vanilla). Swaps each plan's displayed amount
 * from its data-monthly / data-yearly attributes.
 */
(function () {
	'use strict';

	var toggles = document.querySelectorAll( '.ins-pricing-toggle' );
	if ( ! toggles.length ) {
		return;
	}

	function apply( period ) {
		document.querySelectorAll( '.ins-plan__amount[data-monthly][data-yearly]' ).forEach( function ( el ) {
			var val = el.getAttribute( 'data-' + period );
			if ( val ) {
				el.textContent = val;
			}
			var per = el.parentElement ? el.parentElement.querySelector( '.ins-plan__per' ) : null;
			if ( per ) {
				per.textContent = 'yearly' === period ? '/yr billed annually' : '/mo';
			}
		} );
	}

	// Keep the first paint and browser back/forward state deterministic.
	apply( 'monthly' );

	toggles.forEach( function ( toggle ) {
		toggle.addEventListener( 'click', function ( e ) {
			var btn = e.target.closest( 'button[data-period]' );
			if ( ! btn ) {
				return;
			}
			var period = btn.getAttribute( 'data-period' );
			toggle.setAttribute( 'data-period', period );

			toggle.querySelectorAll( 'button' ).forEach( function ( b ) {
				var active = b === btn;
				b.classList.toggle( 'is-active', active );
				b.setAttribute( 'aria-pressed', active ? 'true' : 'false' );
			} );

			apply( period );
		} );
	} );
})();
