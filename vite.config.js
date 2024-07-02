import { defineConfig } from "vite";
import laravel, { refreshPaths } from "laravel-vite-plugin";
import glob from "glob";

function getThemeFiles() {
    return glob.sync("resources/views/themes/**/{*.css,*.js}");
}

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
