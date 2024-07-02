import { defineConfig } from "vite";
import laravel, { refreshPaths } from "laravel-vite-plugin";

async function getConfig() {
    const { default: getThemeFiles } = await import('./getThemeFiles.cjs');

    return defineConfig({
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
}

export default getConfig();
