'use strict';

// Product Detail block: thumbnails swap the large image.
(function () {
	document.querySelectorAll('[data-product-gallery]').forEach(gallery => {
		const stage = gallery.querySelector('[data-gallery-stage]');
		const buttons = [...gallery.querySelectorAll('[data-gallery-image]')];
		if (!stage) return;

		buttons.forEach(button => button.addEventListener('click', () => {
			stage.removeAttribute('srcset');
			if (button.dataset.gallerySrcset) stage.srcset = button.dataset.gallerySrcset;
			stage.src = button.dataset.galleryImage;
			stage.alt = button.dataset.galleryAlt || '';
			buttons.forEach(item => {
				item.classList.toggle('is-active', item === button);
				item.setAttribute('aria-pressed', String(item === button));
			});
		}));
	});
}());
