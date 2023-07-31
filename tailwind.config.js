import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
                'trochut':['Trochut', 'cursive', ...defaultTheme.fontFamily.sans],
                'rokkitt':['Rokkitt', ...defaultTheme.fontFamily.sans],
            },
            colors:{
                'olivine':'#A2C376',
                'gm':'#2C3539',
            }
        },
    },

    plugins: [forms, typography],
};
