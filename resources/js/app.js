import "./bootstrap";

import "@splidejs/splide/css";
import Splide from "@splidejs/splide";

import $ from "jquery";

import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css';

import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';

Livewire.start()

document.addEventListener('alpine:init', () => {
    Alpine.directive('tooltip', (el, value, { name }) => {

        const placement = name.split('.')[2];

        el.setAttribute('title', value);

        tippy(el, {
            placement: placement,
        });
    });
});

import.meta.glob(["../images/**", "../fonts/**"]);

if ($(".splide").length > 0) {
    var splide = new Splide(".splide", {
        perPage: 3,
        focus: 0,
        omitEnd: true,
        breakpoints: {
            913: {
                perPage: 2,
            },
            600: {
                perPage: 1,
            },
        },
        gap: "1em",
    });

    splide.mount();
}
