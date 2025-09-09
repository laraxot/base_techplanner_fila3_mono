import defaultTheme from 'tailwindcss/defaultTheme';
// import preset from './../../vendor/filament/support/tailwind.config.preset';
=======
>>>>>>> 0321d33 (.)
>>>>>>> 388f236 (.)
import forms from '@tailwindcss/forms'
import typography from '@tailwindcss/typography'
import daisyui from 'daisyui'
import colors from 'tailwindcss/colors';

=======

module.exports = {
    // presets: [preset],
>>>>>>> 0321d33 (.)
>>>>>>> 388f236 (.)
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter var', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Colori Bootstrap Italia
                'italia-blue': {
                    50: '#eff6ff',
                    100: '#dbeafe', 
                    200: '#bfdbfe',
                    300: '#93c5fd',
                    400: '#60a5fa',
                    500: '#0066CC', // Primary blue Bootstrap Italia
                    600: '#0059B3',
                    700: '#004C99',
                    800: '#003F80',
                    900: '#003366',
                },
                'italia-green': {
                    50: '#f0fdf4',
                    100: '#dcfce7',
                    200: '#bbf7d0',
                    300: '#86efac',
                    400: '#4ade80',
                    500: '#00B373', // Success green Bootstrap Italia
                    600: '#009959',
                    700: '#00804D',
                    800: '#006640',
                    900: '#004D33',
                },
                'italia-red': {
                    50: '#fef2f2',
                    100: '#fee2e2',
                    200: '#fecaca',
                    300: '#fca5a5',
                    400: '#f87171',
                    500: '#D9364F', // Error red Bootstrap Italia
                    600: '#CC1F38',
                    700: '#B31829',
                    800: '#99141F',
                    900: '#800F17',
                },
                'italia-yellow': {
                    50: '#fffbeb',
                    100: '#fef3c7',
                    200: '#fde68a',
                    300: '#fcd34d',
                    400: '#fbbf24',
                    500: '#FFB400', // Warning yellow Bootstrap Italia
                    600: '#E6A200',
                    700: '#CC9100',
                    800: '#B37F00',
                    900: '#996D00',
                },
=======
                // Manteniamo compatibilità con i colori esistenti
>>>>>>> 0321d33 (.)
>>>>>>> 388f236 (.)
                primary: {
                    50: '#eff6ff',
                    100: '#dbeafe',
                    200: '#bfdbfe', 
                    300: '#93c5fd',
                    400: '#60a5fa',
                    500: '#0066CC',
                    600: '#0059B3',
                    700: '#004C99',
                    800: '#003F80',
                    900: '#003366',
                },
                secondary: colors.gray,
                success: {
                    50: '#f0fdf4',
                    100: '#dcfce7',
                    200: '#bbf7d0',
                    300: '#86efac',
                    400: '#4ade80',
                    500: '#00B373',
                    600: '#009959',
                    700: '#00804D',
                    800: '#006640',
                    900: '#004D33',
                },
                warning: {
                    50: '#fffbeb',
                    100: '#fef3c7',
                    200: '#fde68a',
                    300: '#fcd34d',
                    400: '#fbbf24',
                    500: '#FFB400',
                    600: '#E6A200',
                    700: '#CC9100',
                    800: '#B37F00',
                    900: '#996D00',
                },
                danger: {
                    50: '#fef2f2',
                    100: '#fee2e2',
                    200: '#fecaca',
                    300: '#fca5a5',
                    400: '#f87171',
                    500: '#D9364F',
                    600: '#CC1F38',
                    700: '#B31829',
                    800: '#99141F',
                    900: '#800F17',
                },
            },
        },
    },
    variants: {
        extend: {
            backgroundColor: ['active'],
        }
    },

    content: [

        '../../app/Filament/**/*.php',
        '../../resources/views/**/*.blade.php',
        '../../vendor/filament/**/*.blade.php',
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./assets/**/*.js",
        "./assets/**/*.css",
        "./resources/views/**/*.blade.php",
        "./resources/views/filament/**/*.blade.php",
        "./app/Filament/**/*.php",
        "./vendor/filament/**/*.blade.php",
        
        "../../app/Filament/**/*.php",
        "../../resources/views/**/*.blade.php",
        "../../vendor/filament/**/*.blade.php",
=======
>>>>>>> 0321d33 (.)
>>>>>>> 388f236 (.)
        "../../Modules/**/Filament/**/*.php",
        "../../Modules/**/resources/views/**/*.blade.php",
        "../../storage/framework/views/*.php",
        "../../vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./node_modules/flowbite/**/*.js",
        "./resources/views/**/*.blade.php",  //----------- e' un tema !!!!
        "../../Themes/**/resources/views/**/*.blade.php",  //----------- e' un tema !!!!
        "../../../public_html/vendor/**/*.blade.php",
    ],
=======
>>>>>>> 0321d33 (.)
>>>>>>> 388f236 (.)
    colors: {
        custom: {
            50: 'rgba(var(--c-50), <alpha-value>)',
            100: 'rgba(var(--c-100), <alpha-value>)',
            200: 'rgba(var(--c-200), <alpha-value>)',
            300: 'rgba(var(--c-300), <alpha-value>)',
            400: 'rgba(var(--c-400), <alpha-value>)',
            500: 'rgba(var(--c-500), <alpha-value>)',
            600: 'rgba(var(--c-600), <alpha-value>)',
            700: 'rgba(var(--c-700), <alpha-value>)',
            800: 'rgba(var(--c-800), <alpha-value>)',
            900: 'rgba(var(--c-900), <alpha-value>)',
            950: 'rgba(var(--c-950), <alpha-value>)',
        },
        danger: {
            50: 'rgba(var(--danger-50), <alpha-value>)',
            100: 'rgba(var(--danger-100), <alpha-value>)',
            200: 'rgba(var(--danger-200), <alpha-value>)',
            300: 'rgba(var(--danger-300), <alpha-value>)',
            400: 'rgba(var(--danger-400), <alpha-value>)',
            500: 'rgba(var(--danger-500), <alpha-value>)',
            600: 'rgba(var(--danger-600), <alpha-value>)',
            700: 'rgba(var(--danger-700), <alpha-value>)',
            800: 'rgba(var(--danger-800), <alpha-value>)',
            900: 'rgba(var(--danger-900), <alpha-value>)',
            950: 'rgba(var(--danger-950), <alpha-value>)',
        },
        gray: {
            50: 'rgba(var(--gray-50), <alpha-value>)',
            100: 'rgba(var(--gray-100), <alpha-value>)',
            200: 'rgba(var(--gray-200), <alpha-value>)',
            300: 'rgba(var(--gray-300), <alpha-value>)',
            400: 'rgba(var(--gray-400), <alpha-value>)',
            500: 'rgba(var(--gray-500), <alpha-value>)',
            600: 'rgba(var(--gray-600), <alpha-value>)',
            700: 'rgba(var(--gray-700), <alpha-value>)',
            800: 'rgba(var(--gray-800), <alpha-value>)',
            900: 'rgba(var(--gray-900), <alpha-value>)',
            950: 'rgba(var(--gray-950), <alpha-value>)',
        },
        info: {
            50: 'rgba(var(--info-50), <alpha-value>)',
            100: 'rgba(var(--info-100), <alpha-value>)',
            200: 'rgba(var(--info-200), <alpha-value>)',
            300: 'rgba(var(--info-300), <alpha-value>)',
            400: 'rgba(var(--info-400), <alpha-value>)',
            500: 'rgba(var(--info-500), <alpha-value>)',
            600: 'rgba(var(--info-600), <alpha-value>)',
            700: 'rgba(var(--info-700), <alpha-value>)',
            800: 'rgba(var(--info-800), <alpha-value>)',
            900: 'rgba(var(--info-900), <alpha-value>)',
            950: 'rgba(var(--info-950), <alpha-value>)',
        },
        primary: {
            50: 'rgba(var(--primary-50), <alpha-value>)',
            100: 'rgba(var(--primary-100), <alpha-value>)',
            200: 'rgba(var(--primary-200), <alpha-value>)',
            300: 'rgba(var(--primary-300), <alpha-value>)',
            400: 'rgba(var(--primary-400), <alpha-value>)',
            500: 'rgba(var(--primary-500), <alpha-value>)',
            600: 'rgba(var(--primary-600), <alpha-value>)',
            700: 'rgba(var(--primary-700), <alpha-value>)',
            800: 'rgba(var(--primary-800), <alpha-value>)',
            900: 'rgba(var(--primary-900), <alpha-value>)',
            950: 'rgba(var(--primary-950), <alpha-value>)',
        },
        success: {
            50: 'rgba(var(--success-50), <alpha-value>)',
            100: 'rgba(var(--success-100), <alpha-value>)',
            200: 'rgba(var(--success-200), <alpha-value>)',
            300: 'rgba(var(--success-300), <alpha-value>)',
            400: 'rgba(var(--success-400), <alpha-value>)',
            500: 'rgba(var(--success-500), <alpha-value>)',
            600: 'rgba(var(--success-600), <alpha-value>)',
            700: 'rgba(var(--success-700), <alpha-value>)',
            800: 'rgba(var(--success-800), <alpha-value>)',
            900: 'rgba(var(--success-900), <alpha-value>)',
            950: 'rgba(var(--success-950), <alpha-value>)',
        },
        warning: {
            50: 'rgba(var(--warning-50), <alpha-value>)',
            100: 'rgba(var(--warning-100), <alpha-value>)',
            200: 'rgba(var(--warning-200), <alpha-value>)',
            300: 'rgba(var(--warning-300), <alpha-value>)',
            400: 'rgba(var(--warning-400), <alpha-value>)',
            500: 'rgba(var(--warning-500), <alpha-value>)',
            600: 'rgba(var(--warning-600), <alpha-value>)',
            700: 'rgba(var(--warning-700), <alpha-value>)',
            800: 'rgba(var(--warning-800), <alpha-value>)',
            900: 'rgba(var(--warning-900), <alpha-value>)',
            950: 'rgba(var(--warning-950), <alpha-value>)',
        },
    },
    plugins: [
        forms,
        typography,
=======
        daisyui
>>>>>>> 0321d33 (.)
>>>>>>> 388f236 (.)
    ],
    daisyui: {
        themes: ['light', 'dark'],
    },
}
=======
>>>>>>> 477a6d1 (.)
