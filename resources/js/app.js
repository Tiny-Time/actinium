import './bootstrap';

import '@splidejs/splide/css';
import Splide from '@splidejs/splide';

import $ from 'jquery';

import.meta.glob([
  '../images/**',
  '../fonts/**',
]);

if($('.splide').length > 0){
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
}
