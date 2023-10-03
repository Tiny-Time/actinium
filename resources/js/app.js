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
        // The 'el' parameter is the element to which the directive is applied.
        // The 'value' parameter contains the tooltip text.

        // Parse the directive name to extract the placement information
        const placement = name.split('.')[2]; // Extract the placement (e.g., 'top')

        // Set the 'title' attribute with the tooltip text
        el.setAttribute('title', value);

        // Initialize the tooltip with Tippy.js, specifying the placement
        tippy(el, {
            placement: placement, // Use the specified placement
            // Add more Tippy.js options as needed
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
