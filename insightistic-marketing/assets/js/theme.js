/**
 * Insightistic Marketing — core interactions (vanilla, no jQuery).
 * Mobile navigation, header state, scroll reveals, counters and graph motion.
 */
(function () {
	'use strict';

	// Keep the body state in sync with the early html-class switch. This lets
	// the CSS no-JS fallback stay visible until this deferred bundle is ready.
	if ( document.body ) {
		document.body.classList.remove( 'no-js' );
		document.body.classList.add( 'js' );
	}

	var burger = document.getElementById( 'ins-burger' );
	var panel = document.getElementById( 'ins-mobile' );
	var backdrop = document.querySelector( '.ins-mobile__backdrop' );
	var header = document.getElementById( 'ins-header' );
	var reduceMotion = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
	var closeTimer;

	/* ---- Mobile menu --------------------------------------------------- */
	if ( burger && panel ) {
		var setOpen = function ( open, restoreFocus ) {
			clearTimeout( closeTimer );
			burger.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
			burger.setAttribute( 'aria-label', open ? 'Close menu' : 'Open menu' );
			if ( open ) {
				panel.hidden = false;
				if ( backdrop ) { backdrop.hidden = false; }
				window.requestAnimationFrame( function () { panel.classList.add( 'is-open' ); } );
				document.body.classList.add( 'ins-menu-open' );
				var firstLink = panel.querySelector( 'a' );
				if ( firstLink ) { firstLink.focus(); }
			} else {
				panel.classList.remove( 'is-open' );
				if ( backdrop ) { backdrop.hidden = true; }
				document.body.classList.remove( 'ins-menu-open' );
				closeTimer = window.setTimeout( function () { panel.hidden = true; }, reduceMotion ? 0 : 280 );
				if ( restoreFocus ) { burger.focus(); }
			}
		};

		burger.addEventListener( 'click', function () { setOpen( burger.getAttribute( 'aria-expanded' ) !== 'true', true ); } );
		if ( backdrop ) { backdrop.addEventListener( 'click', function () { setOpen( false, true ); } ); }
		panel.addEventListener( 'click', function ( event ) {
			if ( event.target.closest( 'a' ) ) { setOpen( false, false ); }
		} );
		document.addEventListener( 'keydown', function ( event ) {
			if ( 'Escape' === event.key && burger.getAttribute( 'aria-expanded' ) === 'true' ) { setOpen( false, true ); }
			if ( 'Tab' === event.key && burger.getAttribute( 'aria-expanded' ) === 'true' ) {
				var focusable = panel.querySelectorAll( 'a, button' );
				if ( focusable.length && event.shiftKey && document.activeElement === focusable[ 0 ] ) { event.preventDefault(); focusable[ focusable.length - 1 ].focus(); }
				if ( focusable.length && ! event.shiftKey && document.activeElement === focusable[ focusable.length - 1 ] ) { event.preventDefault(); focusable[ 0 ].focus(); }
			}
		} );

		var mq = window.matchMedia( '(min-width: 1024px)' );
		var onChange = function () { if ( mq.matches ) { setOpen( false, false ); } };
		if ( mq.addEventListener ) { mq.addEventListener( 'change', onChange ); } else if ( mq.addListener ) { mq.addListener( onChange ); }
	}

	/* ---- Header scroll shadow ----------------------------------------- */
	if ( header ) {
		var onScroll = function () { header.classList.toggle( 'is-scrolled', window.scrollY > 8 ); };
		onScroll();
		window.addEventListener( 'scroll', onScroll, { passive: true } );
	}

	/* ---- Hide footer widgets that only inject sitewide CSS or JS -------- */
	var footerColumns = document.querySelectorAll( '.ins-footer__col' );
	Array.prototype.forEach.call( footerColumns, function ( column ) {
		var hasReadableContent = ( column.innerText || '' ).replace( /\u00a0/g, ' ' ).trim().length > 0;

		// Preserve style/script widgets that power the site, but do not leave their
		// otherwise empty widget wrapper visible as a blank footer card.
		if ( ! hasReadableContent ) { column.hidden = true; }
	} );

	/* ---- Reveal sections as they enter the viewport ------------------- */
	var revealTargets = document.querySelectorAll( '.ins-section__head, .ins-feature, .ins-insightcard, .ins-reportcard, .ins-plan, .ins-step, .ins-testimonial, .ins-split__text, .ins-split__visual, .ins-browser, .ins-ctaband__card, .ins-ecosystem-band__inner, .ins-legal__identity, .ins-footer__brand, .ins-footer__col, .ins-footer__bottom' );
	if ( revealTargets.length ) {
		Array.prototype.forEach.call( revealTargets, function ( item ) { item.classList.add( 'ins-reveal' ); } );
		if ( reduceMotion || ! window.IntersectionObserver ) {
			Array.prototype.forEach.call( revealTargets, function ( item ) { item.classList.add( 'is-visible' ); } );
		} else {
			var revealObserver = new IntersectionObserver( function ( entries, observer ) {
				entries.forEach( function ( entry ) { if ( entry.isIntersecting ) { entry.target.classList.add( 'is-visible' ); observer.unobserve( entry.target ); } } );
			}, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 } );
			Array.prototype.forEach.call( revealTargets, function ( item ) { revealObserver.observe( item ); } );
			// Browsers can restore a scrolled page before the observer receives an
			// intersection callback. A bounded fallback prevents a permanently
			// blank marketing page while retaining normal scroll reveals.
			window.setTimeout( function () {
				Array.prototype.forEach.call( revealTargets, function ( item ) {
					if ( ! item.classList.contains( 'is-visible' ) ) { item.classList.add( 'is-visible' ); }
				} );
			}, 2600 );
		}
	}

	/* ---- Count-up statistics ------------------------------------------ */
	var counters = document.querySelectorAll( '[data-count]' );
	var countNumber = function ( text ) { var match = String( text ).match( /[\d,.]+/ ); return match ? parseFloat( match[ 0 ].replace( /,/g, '' ) ) : null; };
	var formatCount = function ( original, value ) {
		var match = String( original ).match( /([\d,.]+)/ );
		if ( ! match ) { return original; }
		var decimals = ( match[ 1 ].split( '.' )[ 1 ] || '' ).length;
		var formatted = value.toLocaleString( 'en-US', { minimumFractionDigits: decimals, maximumFractionDigits: decimals } );
		return String( original ).replace( match[ 1 ], formatted );
	};
	var animateCounter = function ( node ) {
		var original = node.getAttribute( 'data-count' );
		var target = countNumber( original );
		if ( null === target ) { return; }
		if ( reduceMotion ) { node.textContent = original; return; }
		var started = null;
		var duration = 950;
		var tick = function ( timestamp ) {
			if ( ! started ) { started = timestamp; }
			var progress = Math.min( ( timestamp - started ) / duration, 1 );
			var eased = 1 - Math.pow( 1 - progress, 3 );
			node.textContent = formatCount( original, target * eased );
			if ( progress < 1 ) { window.requestAnimationFrame( tick ); } else { node.textContent = original; }
		};
		window.requestAnimationFrame( tick );
	};
	if ( counters.length ) {
		if ( reduceMotion || ! window.IntersectionObserver ) { Array.prototype.forEach.call( counters, animateCounter ); } else {
			var countObserver = new IntersectionObserver( function ( entries, observer ) {
				entries.forEach( function ( entry ) { if ( entry.isIntersecting ) { animateCounter( entry.target ); observer.unobserve( entry.target ); } } );
			}, { threshold: 0.6 } );
			Array.prototype.forEach.call( counters, function ( item ) { countObserver.observe( item ); } );
		}
	}

	/* ---- Draw the dashboard graph once visible ------------------------ */
	var graphs = document.querySelectorAll( '.ins-preview__graph' );
	Array.prototype.forEach.call( graphs, function ( graph ) {
		var line = graph.querySelector( '.ins-preview__graph-line' );
		if ( line && line.getTotalLength ) { graph.style.setProperty( '--graph-length', line.getTotalLength() ); line.style.strokeDasharray = line.getTotalLength(); line.style.strokeDashoffset = line.getTotalLength(); }
		var revealGraph = function () { graph.classList.add( 'is-animated' ); };
		if ( reduceMotion || ! window.IntersectionObserver ) { revealGraph(); } else {
			var graphObserver = new IntersectionObserver( function ( entries, observer ) { if ( entries[ 0 ].isIntersecting ) { revealGraph(); observer.disconnect(); } }, { threshold: 0.3 } );
			graphObserver.observe( graph );
		}
	} );
})();
