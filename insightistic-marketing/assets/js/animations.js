/* Lazy-load public-safe product videos and pause them when they leave the viewport. */
(function () {
	'use strict';

	var videos = document.querySelectorAll('[data-motion-video]');
	if (!videos.length) { return; }

	var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	var activate = function (video) {
		if (!video.dataset.loaded) {
			Array.prototype.forEach.call(video.querySelectorAll('source[data-src]'), function (source) {
				source.src = source.dataset.src;
			});
			video.dataset.loaded = 'true';
			video.load();
		}
		if (!reduceMotion) {
			var play = video.play();
			if (play && play.catch) { play.catch(function () {}); }
		}
	};

	if (!window.IntersectionObserver) {
		Array.prototype.forEach.call(videos, function (video) { activate(video); });
		return;
	}

	var observer = new IntersectionObserver(function (entries) {
		entries.forEach(function (entry) {
			var video = entry.target;
			if (entry.isIntersecting) {
				activate(video);
			} else if (!video.paused) {
				video.pause();
			}
		});
	}, { rootMargin: '240px 0px', threshold: 0.15 });

	Array.prototype.forEach.call(videos, function (video) { observer.observe(video); });
}());
