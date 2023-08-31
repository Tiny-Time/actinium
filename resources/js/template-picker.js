import "@splidejs/splide/css";
import Splide from "@splidejs/splide";

import $ from "jquery";

if ($(".template-splide").length > 0) {
    var templateSplide = new Splide(".template-splide", {
        perPage: 1,
        focus: 0,
    });

    templateSplide.mount();
}
