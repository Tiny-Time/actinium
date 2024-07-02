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
                "resources/views/themes/**",
            ],
            refresh: [...refreshPaths, "app/Http/Livewire/**"],
        }),
    ],
});
