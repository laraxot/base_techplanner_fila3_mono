<<<<<<< HEAD
import preset from './vendor/filament/support/tailwind.config.preset'

/** @type {import('tailwindcss').Config} */
export default {
    presets: [preset],
    darkMode: 'class',
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './assets/**/*.js',
        './assets/**/*.css',
        '../../app/Filament/**/*.php',
        '../../resources/views/**/*.blade.php',
        '../../vendor/filament/**/*.blade.php',
        '../../Modules/**/Filament/**/*.php',
        '../../Modules/**/resources/views/**/*.blade.php',
        '../../storage/framework/views/*.php',
        '../../vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './node_modules/flowbite/**/*.js',
        '../../../public_html/vendor/**/*.blade.php',
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',

    ],
    theme: {
        extend: {
            colors: {
                danger: {
                    50: 'rgb(var(--color-danger-50) / <alpha-value>)',
                    100: 'rgb(var(--color-danger-100) / <alpha-value>)',
                    200: 'rgb(var(--color-danger-200) / <alpha-value>)',
                    300: 'rgb(var(--color-danger-300) / <alpha-value>)',
                    400: 'rgb(var(--color-danger-400) / <alpha-value>)',
                    500: 'rgb(var(--color-danger-500) / <alpha-value>)',
                    600: 'rgb(var(--color-danger-600) / <alpha-value>)',
                    700: 'rgb(var(--color-danger-700) / <alpha-value>)',
                    800: 'rgb(var(--color-danger-800) / <alpha-value>)',
                    900: 'rgb(var(--color-danger-900) / <alpha-value>)',
                    950: 'rgb(var(--color-danger-950) / <alpha-value>)',
                },
                primary: {
                    50: 'rgb(var(--color-primary-50) / <alpha-value>)',
                    100: 'rgb(var(--color-primary-100) / <alpha-value>)',
                    200: 'rgb(var(--color-primary-200) / <alpha-value>)',
                    300: 'rgb(var(--color-primary-300) / <alpha-value>)',
                    400: 'rgb(var(--color-primary-400) / <alpha-value>)',
                    500: 'rgb(var(--color-primary-500) / <alpha-value>)',
                    600: 'rgb(var(--color-primary-600) / <alpha-value>)',
                    700: 'rgb(var(--color-primary-700) / <alpha-value>)',
                    800: 'rgb(var(--color-primary-800) / <alpha-value>)',
                    900: 'rgb(var(--color-primary-900) / <alpha-value>)',
                    950: 'rgb(var(--color-primary-950) / <alpha-value>)',
                },
                success: {
                    50: 'rgb(var(--color-success-50) / <alpha-value>)',
                    100: 'rgb(var(--color-success-100) / <alpha-value>)',
                    200: 'rgb(var(--color-success-200) / <alpha-value>)',
                    300: 'rgb(var(--color-success-300) / <alpha-value>)',
                    400: 'rgb(var(--color-success-400) / <alpha-value>)',
                    500: 'rgb(var(--color-success-500) / <alpha-value>)',
                    600: 'rgb(var(--color-success-600) / <alpha-value>)',
                    700: 'rgb(var(--color-success-700) / <alpha-value>)',
                    800: 'rgb(var(--color-success-800) / <alpha-value>)',
                    900: 'rgb(var(--color-success-900) / <alpha-value>)',
                    950: 'rgb(var(--color-success-950) / <alpha-value>)',
                },
                warning: {
                    50: 'rgb(var(--color-warning-50) / <alpha-value>)',
                    100: 'rgb(var(--color-warning-100) / <alpha-value>)',
                    200: 'rgb(var(--color-warning-200) / <alpha-value>)',
                    300: 'rgb(var(--color-warning-300) / <alpha-value>)',
                    400: 'rgb(var(--color-warning-400) / <alpha-value>)',
                    500: 'rgb(var(--color-warning-500) / <alpha-value>)',
                    600: 'rgb(var(--color-warning-600) / <alpha-value>)',
                    700: 'rgb(var(--color-warning-700) / <alpha-value>)',
                    800: 'rgb(var(--color-warning-800) / <alpha-value>)',
                    900: 'rgb(var(--color-warning-900) / <alpha-value>)',
                    950: 'rgb(var(--color-warning-950) / <alpha-value>)',
=======
/** @type {import('tailwindcss').Config} */
import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./assets/**/*.js",
        "./assets/**/*.css",
        "../../app/Filament/**/*.php",
        "../../resources/views/**/*.blade.php",
        "../../vendor/filament/**/*.blade.php",
        "../../Modules/**/Filament/**/*.php",
        "../../Modules/**/resources/views/**/*.blade.php",
        "../../storage/framework/views/*.php",
        "../../vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./node_modules/flowbite/**/*.js",
        "../../../public_html/vendor/**/*.blade.php",
    ],
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                primary: {
                    50: '#f0f9ff',
                    100: '#e0f2fe',
                    200: '#bae6fd',
                    300: '#7dd3fc',
                    400: '#38bdf8',
                    500: '#0ea5e9',
                    600: '#0284c7',
                    700: '#0369a1',
                    800: '#075985',
                    900: '#0c4a6e',
                    950: '#082f49',
>>>>>>> 1b374b6 (.)
                },
                secondary: {
                    50: '#f8fafc',
                    100: '#f1f5f9',
                    200: '#e2e8f0',
                    300: '#cbd5e1',
                    400: '#94a3b8',
                    500: '#64748b',
                    600: '#475569',
                    700: '#334155',
                    800: '#1e293b',
                    900: '#0f172a',
                },
            },
            fontFamily: {
                sans: ['Figtree', 'sans-serif'],
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('flowbite/plugin'),
    ],
<<<<<<< HEAD
}
=======
};
>>>>>>> 1b374b6 (.)
