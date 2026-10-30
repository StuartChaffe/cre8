'use strict';

// Main navigation: mobile menu toggle, one dropdown open at a time, solid header on scroll.
(function () {
	const header = document.querySelector('.site-header');
	if (!header) return;

	const toggle = header.querySelector('.menu-toggle');
	const menu = header.querySelector('.nav-links');
	const groups = [...header.querySelectorAll('.nav-group')];
	const desktop = matchMedia('(min-width: 900px)');

	const closeGroups = except => groups.forEach(group => { if (group !== except) group.open = false; });

	const setMenu = open => {
		if (!toggle || !menu) return;
		toggle.setAttribute('aria-expanded', String(open));
		toggle.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
		menu.classList.toggle('is-open', open);
		document.body.classList.toggle('menu-open', open);
	};

	if (toggle && menu) {
		toggle.addEventListener('click', () => setMenu(toggle.getAttribute('aria-expanded') !== 'true'));
		menu.querySelectorAll('a').forEach(link => link.addEventListener('click', () => setMenu(false)));
		desktop.addEventListener('change', () => setMenu(false));
	}

	groups.forEach(group => group.addEventListener('toggle', () => { if (group.open) closeGroups(group); }));

	document.addEventListener('click', event => {
		if (!event.target.closest('.nav-group')) closeGroups();
	});

	document.addEventListener('keydown', event => {
		if (event.key !== 'Escape') return;
		const open = groups.find(group => group.open);
		setMenu(false);
		closeGroups();
		if (open) open.querySelector('summary').focus();
	});

	const updateHeader = () => header.classList.toggle('is-scrolled', window.scrollY > 24);
	updateHeader();
	window.addEventListener('scroll', () => {
		updateHeader();
		if (desktop.matches) closeGroups();
	}, { passive: true });
}());
