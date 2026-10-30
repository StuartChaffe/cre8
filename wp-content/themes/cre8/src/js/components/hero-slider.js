'use strict';

// Homepage hero: cross-fade background images every 6 seconds, with dots and a pause button.
// Each slide's title, summary and link are read from its data attributes.
(function () {
	const hero = document.querySelector('[data-hero-slider]');
	if (!hero) return;

	const slides = [...hero.querySelectorAll('.hero-slide')];
	const dots = [...hero.querySelectorAll('.slider-dot')];
	const toggle = hero.querySelector('.slider-toggle');
	const title = hero.querySelector('[data-slide-title]');
	const summary = hero.querySelector('[data-slide-summary]');
	const link = hero.querySelector('[data-slide-link]');
	if (slides.length < 2) return;

	let active = 0;
	let timer;
	let paused = matchMedia('(prefers-reduced-motion: reduce)').matches;

	const show = index => {
		active = (index + slides.length) % slides.length;
		const slide = slides[active];
		slides.forEach((s, i) => s.classList.toggle('is-active', i === active));
		dots.forEach((dot, i) => {
			dot.classList.toggle('is-active', i === active);
			if (i === active) dot.setAttribute('aria-current', 'true');
			else dot.removeAttribute('aria-current');
		});
		if (title) title.textContent = slide.dataset.title;
		if (summary) summary.textContent = slide.dataset.summary;
		if (link && slide.dataset.href) {
			link.textContent = slide.dataset.label;
			link.href = slide.dataset.href;
		}
	};

	const start = () => {
		clearInterval(timer);
		if (!paused) timer = setInterval(() => show(active + 1), 6000);
	};

	const setToggle = () => {
		if (!toggle) return;
		toggle.innerHTML = paused
			? '<span class="play-icon" aria-hidden="true"></span>'
			: '<span class="pause-icon" aria-hidden="true"></span>';
		toggle.setAttribute('aria-label', paused ? 'Play slideshow' : 'Pause slideshow');
	};

	dots.forEach((dot, i) => dot.addEventListener('click', () => { show(i); start(); }));
	if (toggle) toggle.addEventListener('click', () => { paused = !paused; setToggle(); start(); });

	// Pause while the tab is hidden
	document.addEventListener('visibilitychange', () => (document.hidden ? clearInterval(timer) : start()));

	setToggle();
	start();
}());
