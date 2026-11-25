/**
 * AppSumo announcement bar behaviour.
 *
 * Two honest mechanics:
 *  1. Per-visitor EVERGREEN window. The AppSumo listing has no fixed end date,
 *     so a global deadline would expire and strand the bar. On first sight we
 *     store ins_promo_first_seen and count down 8d 23h 59m from it. The stamp is
 *     written once and never reset: a returning visitor's clock keeps running.
 *  2. Dismissal. ins_promo_dismissed hides the bar for good on that device.
 *
 * On expiry the countdown section hides and the bar simplifies to badge + CTA -
 * never a dead "expired" banner.
 */
(function () {
	'use strict';

	var BAR_ID = 'ins-promo-bar';
	var SEEN_KEY = 'ins_promo_first_seen';
	var DISMISS_KEY = 'ins_promo_dismissed';
	var WINDOW_MS = (8 * 24 * 60 * 60 + 23 * 60 * 60 + 59 * 60) * 1000; // 8d 23h 59m

	function read(key) {
		try {
			return window.localStorage.getItem(key);
		} catch (e) {
			return null; // private mode / storage disabled
		}
	}

	function write(key, value) {
		try {
			window.localStorage.setItem(key, value);
		} catch (e) {
			/* nothing we can do; the bar still works without persistence */
		}
	}

	function pad(value) {
		return value < 10 ? '0' + value : String(value);
	}

	function format(ms) {
		var total = Math.max(0, Math.floor(ms / 1000));
		var days = Math.floor(total / 86400);
		var hours = Math.floor((total % 86400) / 3600);
		var minutes = Math.floor((total % 3600) / 60);
		var seconds = total % 60;

		return days + 'd ' + hours + 'h ' + pad(minutes) + 'm ' + pad(seconds) + 's';
	}

	function firstSeen() {
		var stored = parseInt(read(SEEN_KEY), 10);
		var now = Date.now();

		// A stamp in the future means a clock change; keep the original window.
		if (!isNaN(stored) && stored > 0 && stored <= now) {
			return stored;
		}

		write(SEEN_KEY, String(now));

		return now;
	}

	/**
	 * On expiry the offer line stops claiming a live deal. The copy comes from
	 * the partial (data-promo-expired-copy) so wording changes are a template
	 * edit, not a JS edit.
	 */
	function swapExpiredCopy(bar) {
		var copy = bar.getAttribute('data-promo-expired-copy');
		var headline = bar.querySelector('.ins-promo-bar__headline');

		if (copy && headline) {
			headline.textContent = copy;
		}
	}

	function startCountdown(bar, explicitEnd) {
		var countdown = bar.querySelector('[data-promo-countdown]');
		var clock = bar.querySelector('[data-promo-clock]');

		if (!countdown || !clock) {
			return;
		}

		var target;

		if (explicitEnd) {
			var parsed = Date.parse(explicitEnd);
			target = isNaN(parsed) ? firstSeen() + WINDOW_MS : parsed;
		} else {
			target = firstSeen() + WINDOW_MS;
		}

		function tick() {
			var remaining = target - Date.now();

			if (remaining <= 0) {
				countdown.hidden = true; // badge + CTA remain
				swapExpiredCopy(bar);
				window.clearInterval(timer);
				return;
			}

			clock.textContent = format(remaining);
			countdown.hidden = false;
		}

		tick();
		var timer = window.setInterval(tick, 1000);
	}

	function init() {
		var bar = document.getElementById(BAR_ID);

		if (!bar) {
			return;
		}

		if (read(DISMISS_KEY) === '1') {
			bar.hidden = true;
			return;
		}

		bar.hidden = false;
		startCountdown(bar, bar.getAttribute('data-promo-end') || '');

		var close = bar.querySelector('[data-promo-dismiss]');
		if (close) {
			close.addEventListener('click', function () {
				bar.hidden = true;
				write(DISMISS_KEY, '1');
			});
		}
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();
