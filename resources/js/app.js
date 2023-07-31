import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';

import '@splidejs/splide/css';
import Splide from '@splidejs/splide';

var splide = new Splide( '.splide', {
    perPage: 3,
    focus  : 0,
    breakpoints: {
		913: {
			perPage: 2,
		},
		600: {
			perPage: 1,
		},
    },
    gap: '1em',
});

splide.mount();

window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();
