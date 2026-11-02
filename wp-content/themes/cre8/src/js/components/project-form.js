'use strict';

// "Discuss a project": on the first step, choosing an answer moves straight on.
// Gravity Forms replaces the form's markup between steps, so listen on the document.
(function () {
	if (!document.querySelector('.project-form .gform_wrapper')) return;

	document.addEventListener('change', event => {
		const radio = event.target.closest('.project-form__answers input[type="radio"]');
		if (!radio) return;
		const next = radio.closest('.gform_page')?.querySelector('.gform_next_button');
		if (next) setTimeout(() => next.click(), 180);
	});
}());
