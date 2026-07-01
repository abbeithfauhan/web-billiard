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
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                heading: ['Poppins', 'Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: '#F0F9FF',
                    100: '#E0F2FE',
                    200: '#BAE6FD',
                    300: '#7DD3FC',
                    400: '#38BDF8',
                    500: '#0EA5E9',
                    600: '#0284C7',
                    700: '#0369A1',
                    800: '#075985',
                    900: '#0C4A6E',
                },
                secondary: {
                    400: '#06B6D4',
                    500: '#06B6D4',
                    600: '#0891B2',
                },
                accent: {
                    400: '#FF8C5A',
                    500: '#FF6B35',
                    600: '#E5531F',
                },
            },
            backgroundImage: {
                'gradient-billiard': 'linear-gradient(135deg, rgb(15, 23, 42) 0%, rgb(30, 58, 138) 50%, rgb(15, 23, 42) 100%)',
                'gradient-cyan-blue': 'linear-gradient(90deg, #0EA5E9 0%, #0284C7 100%)',
                'gradient-orange-red': 'linear-gradient(90deg, #FF6B35 0%, #EF4444 100%)',
            },
            boxShadow: {
                'glow-cyan': '0 0 20px rgba(6, 182, 212, 0.3)',
                'glow-blue': '0 0 20px rgba(14, 165, 233, 0.3)',
                'glow-orange': '0 0 20px rgba(255, 107, 53, 0.3)',
            },
        },
    },

    plugins: [
        require('@tailwindcss/typography'),
        [forms],
    ],
};
