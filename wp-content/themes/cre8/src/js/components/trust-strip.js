'use strict';

// On phones the accreditation strip scrolls sideways; step through it every few seconds.
(function () {
	const strip = document.querySelector('.trust-grid');
	if (!strip || matchMedia('(prefers-reduced-motion: reduce)').matches) return;

	let timer;
	const advance = () => {
		if (matchMedia('(min-width: 700px)').matches) return;
		const items = [...strip.children];
		const next = items.find(item => item.offsetLeft > strip.scrollLeft + 8) || items[0];
		strip.scrollTo({ left: next.offsetLeft - strip.offsetLeft, behavior: 'smooth' });
	};
	const start = () => { clearInterval(timer); timer = setInterval(advance, 3200); };
	const stop = () => clearInterval(timer);

	strip.addEventListener('pointerdown', stop);
	strip.addEventListener('pointerup', start);
	strip.addEventListener('focusin', stop);
	strip.addEventListener('focusout', start);
	start();
}());
