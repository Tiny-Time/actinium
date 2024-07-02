import "./bootstrap";

import "@splidejs/splide/css";
import Splide from "@splidejs/splide";
window.Splide = Splide;

import $ from "jquery";
window.jQuery = window.$ = $;

import tippy from "tippy.js";
import "tippy.js/dist/tippy.css";

/* Tooltip */
document.addEventListener("DOMContentLoaded", () => {
    document.addEventListener("alpine:init", () => {
        Alpine.directive("tooltip", (el, value, { name }) => {
            const placement = name.split(".")[2];

            el.setAttribute("title", value);

            tippy(el, { placement: placement });
        });
    });
});

/* Import images and fonts. */
import.meta.glob([
    "../images/**",
    "../fonts/**",
    "../views/themes/**",
]);

/* Splide Slider */

if ($("#splide").length > 0) {
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

/* Validation */
// Days
$(".timer-text.days").on("input", function () {
    var cursorPosition = window.getSelection().getRangeAt(0).startOffset;
    var inputValue = $(this).text();
    var sanitizedValue = cleanInput(inputValue, 3);
    $(this).text(sanitizedValue);
    setCursorPosition(this, cursorPosition);
});
// Hours
$(".timer-text.hours").on("input", function () {
    var cursorPosition = window.getSelection().getRangeAt(0).startOffset;
    var inputValue = $(this).text();
    var sanitizedValue = cleanInput(inputValue, 2);
    $(this).text(sanitizedValue);
    setCursorPosition(this, cursorPosition);
});
// Mins
$(".timer-text.mins").on("input", function () {
    var cursorPosition = window.getSelection().getRangeAt(0).startOffset;
    var inputValue = $(this).text();
    var sanitizedValue = cleanInput(inputValue, 2);
    $(this).text(sanitizedValue);
    setCursorPosition(this, cursorPosition);
});
// Secs
$(".timer-text.secs").on("input", function () {
    var cursorPosition = window.getSelection().getRangeAt(0).startOffset;
    var inputValue = $(this).text();
    var sanitizedValue = cleanInput(inputValue, 2);
    $(this).text(sanitizedValue);
    setCursorPosition(this, cursorPosition);
});
// Validate non-digit characters and length.
function cleanInput(inputValue, length) {
    let sanitizedValue = inputValue.replace(/\D/g, ""); // Remove non-digit characters.
    if (sanitizedValue.length > length) {
        sanitizedValue = sanitizedValue.slice(0, length); // Trim to length characters.
    }
    return sanitizedValue;
}
// Restore cursor position.
function setCursorPosition(element, cursorPosition) {
    var range = document.createRange();
    var sel = window.getSelection();
    range.setStart(
        element.firstChild,
        Math.min(cursorPosition, element.textContent.length)
    );
    range.collapse(true);
    sel.removeAllRanges();
    sel.addRange(range);
}
