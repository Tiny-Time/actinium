import { defineConfig } from "vite";
import laravel, { refreshPaths } from "laravel-vite-plugin";
import { createRequire } from "module";
const require = createRequire(import.meta.url);
const getThemeFiles = require("./getThemeFiles");

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
                ...getThemeFiles(),
            ],
            refresh: [...refreshPaths, "app/Http/Livewire/**"],
        }),
    ],
});
