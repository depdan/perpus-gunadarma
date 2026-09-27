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
                sans: ['"Plus Jakarta Sans"', 'Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                royal: {
                    50: '#F0F6FE',
                    100: '#E8F0FE',
                    200: '#D2E3FC',
                    300: '#AECBFA',
                    400: '#669DF6',
                    500: '#3B82F6',
                    600: '#2563EB',
                    700: '#1E65DE', // User reference royal blue
                    800: '#1557BF', // Darker royal
                    900: '#0E3E8C',
                    950: '#092B66',
                },
            },
            boxShadow: {
                'royal-sm': '0 1px 3px 0 rgba(30, 101, 222, 0.1), 0 1px 2px 0 rgba(30, 101, 222, 0.06)',
                'royal-md': '0 4px 14px 0 rgba(30, 101, 222, 0.15), 0 2px 4px 0 rgba(30, 101, 222, 0.08)',
                'royal-lg': '0 10px 25px -3px rgba(30, 101, 222, 0.25)',
                'royal-glow': '0 0 20px rgba(30, 101, 222, 0.35)',
            },
        },
    },

    plugins: [forms],
};



