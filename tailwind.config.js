import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Models/**/*.php',
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
                    700: '#1E65DE', // Universitas Gunadarma Royal Blue
                    800: '#1557BF', // Darker royal hover
                    900: '#0E3E8C',
                    950: '#092B66',
                },
                gunadarma: {
                    purple: '#5B21B6',
                    gold: '#D97706',
                    navy: '#0F172A',
                }
            },
            boxShadow: {
                'royal-xs': '0 1px 2px 0 rgba(30, 101, 222, 0.08)',
                'royal-sm': '0 2px 6px 0 rgba(30, 101, 222, 0.18)',
                'royal-md': '0 8px 20px -4px rgba(30, 101, 222, 0.25)',
                'royal-lg': '0 14px 30px -6px rgba(30, 101, 222, 0.35)',
                'card': '0 1px 3px 0 rgba(15, 23, 42, 0.04), 0 1px 2px -1px rgba(15, 23, 42, 0.04)',
                'card-hover': '0 12px 28px -6px rgba(15, 23, 42, 0.08), 0 4px 12px -2px rgba(30, 101, 222, 0.06)',
                'modal': '0 25px 50px -12px rgba(15, 23, 42, 0.25)',
            },
            animation: {
                'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                'float': 'float 3s ease-in-out infinite',
            },
            keyframes: {
                float: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-4px)' },
                }
            }
        },
    },

    plugins: [forms],
};
