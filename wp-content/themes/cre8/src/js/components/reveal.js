'use strict';

// Fade sections in as they scroll into view. Skipped for reduced motion; the CSS only hides
// .u-reveal elements once <html> has the has-reveal class, so nothing is hidden without JS.
(function () {
	const items = document.querySelectorAll('.u-reveal');
	if (!items.length || !('IntersectionObserver' in window) || matchMedia('(prefers-reduced-motion: reduce)').matches) return;

	document.documentElement.classList.add('has-reveal');

	const observer = new IntersectionObserver(entries => entries.forEach(entry => {
		if (!entry.isIntersecting) return;
		entry.target.classList.add('is-visible');
		observer.unobserve(entry.target);
	}), { threshold: .12 });

	items.forEach(item => {
		// Anything already on screen shows straight away
		if (item.getBoundingClientRect().top < window.innerHeight) item.classList.add('is-visible');
		observer.observe(item);
	});
}());
