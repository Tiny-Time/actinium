import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/embed.js',
                'resources/js/main.js',
                'resources/js/clipboard.js',
                'resources/js/template-picker.js',
                'resources/views/themes/anniversary/enchanted-midnight-forest/css/style.css',
                'resources/views/themes/birthday/dark-blue-sequins/css/style.css',
                'resources/views/themes/anniversary/scarlet-serenity/css/style.css'
            ],
            refresh: [
                ...refreshPaths,
                'app/Http/Livewire/**',
            ],
        }),
    ],
});
