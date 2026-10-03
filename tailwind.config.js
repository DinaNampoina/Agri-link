import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    50: '#fbfefc',
                    100: '#f4fbf6',
                    200: '#e6f6eb',
                    300: '#d6f1df',
                    400: '#8eceaa',
                    500: '#30a46c',
                    600: '#2b9a66',
                    700: '#218358',
                    800: '#193b2d',
                    900: '#132d21',
                    950: '#0e1512',
                },
                accent: {
                    50: '#fbfdff',
                    100: '#f4faff',
                    200: '#e6f4fe',
                    300: '#d5efff',
                    400: '#8ec8f6',
                    500: '#0090ff',
                    600: '#0588f0',
                    700: '#0d74ce',
                    800: '#113264',
                    900: '#0d2847',
                    950: '#0d1520',
                },
                surface: {
                    light: '#fbfefc',
                    dark: '#0e1512',
                },
            },
        },
    },
    plugins: [forms],
};
