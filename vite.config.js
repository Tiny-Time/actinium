import { defineConfig } from "vite";
import laravel, { refreshPaths } from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/custom.css",
                "resources/js/app.js",
                "resources/js/embed.js",
                "resources/js/main.js",
                "resources/js/clipboard.js",
                "resources/views/templates/anniversary/enchanted-midnight-forest/css/style.css",
                "resources/views/templates/birthday/dark-blue-sequins/css/style.css",
                "resources/views/templates/anniversary/scarlet-serenity/css/style.css",
                "resources/views/templates/general/js/subscribe.js",
                "resources/views/templates/general/js/main.js",
                "resources/views/templates/meeting/punctual-meeting/css/style.css",
                "resources/views/templates/meeting/time-master/css/style.css",
                "resources/views/templates/study/shape-the-future/css/style.css",
                "resources/views/templates/live-stream/mind-body-wellness/css/style.css",
                "resources/views/templates/live-stream/science-experiment/css/style.css",
                "resources/views/templates/thanksgiving/feasting-around-the-corner/css/style.css",
                "resources/views/templates/vacation/great-escape/css/style.css",
                "resources/views/templates/fitness/peak-performance/css/style.css",
                "resources/views/templates/fitness/peak-performance-v2/css/style.css",
                "resources/views/templates/vacation/journey-to-relaxation/css/style.css",
                "resources/views/templates/vacation/dream-to-reality/css/style.css",
            ],
            refresh: [...refreshPaths, "app/Http/Livewire/**"],
        }),
    ],
});
