import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'light-beige': '#F5F0E6', // Light Beige for text
                'espresso': '#5D4037', // Espresso Brown
                'latte': '#F5F0E6',    // Light Beige (Latte)
                'caramel': '#D4A574',  // Caramel Accent
                'transparent-white': 'rgba(255, 255, 255, 0.8)',
            }
        },
    },

    plugins: [forms],
};
