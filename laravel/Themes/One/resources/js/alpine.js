@tailwind base;
@tailwind components;
@tailwind utilities;
@tailwind variants;


[x-cloak] {
    display: none;
}

/* Custom Filament button styles */
@layer components {
    /* Bottoni Filament */
    .fi-btn {
        @apply inline-flex items-center justify-center gap-1 rounded-lg px-3 py-2 text-sm font-medium shadow-sm ring-1 ring-inset transition-colors duration-75 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:pointer-events-none disabled:opacity-70;
    }

    .fi-btn-primary {
        @apply bg-primary-600 text-white hover:bg-primary-500 focus:ring-primary-500 ring-primary-600/10;
    }

    .fi-btn-secondary {
        @apply bg-white text-gray-700 hover:bg-gray-50 focus:ring-gray-500 ring-gray-300;
    }

    .fi-btn-danger {
        @apply bg-danger-600 text-white hover:bg-danger-500 focus:ring-danger-500 ring-danger-600/10;
    }

    .fi-btn-success {
        @apply bg-success-600 text-white hover:bg-success-500 focus:ring-success-500 ring-success-600/10;
    }

    .fi-btn-warning {
        @apply bg-warning-600 text-white hover:bg-warning-500 focus:ring-warning-500 ring-warning-600/10;
    }

    /* Stili per il form di login */
    .login-form {
        @apply space-y-6;
    }

    .login-button {
        @apply w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500;
    }

    /* Bottoni generici */
    .btn {
        @apply inline-flex items-center justify-center rounded-md px-4 py-2 text-sm font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2;
    }

    .btn-primary {
        @apply bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2;
    }

    .btn-secondary {
        @apply bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2;
    }

    /* Navigazione */
    .nav-link {
        @apply text-gray-500 hover:text-gray-900 px-3 py-2 text-sm font-medium;
    }

    .nav-link-active {
        @apply text-primary-600 hover:text-primary-900;
    }

    .nav-link-mobile {
        @apply -m-2 p-2 block text-gray-500 hover:text-gray-900;
    }

    .nav-link-mobile-active {
        @apply text-primary-600 hover:text-primary-900;
    }

    .input-primary {
        @apply border-gray-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm;
    }

    .card {
        @apply bg-white rounded-lg shadow-md p-6;
    }

    .card-header {
        @apply border-b border-gray-200 pb-4 mb-4;
    }

    .card-title {
        @apply text-lg font-semibold text-gray-900;
    }

    .card-body {
        @apply text-gray-600;
    }

    .card-footer {
        @apply border-t border-gray-200 pt-4 mt-4;
    }

    .fi-input {
        @apply block w-full rounded-lg border-0 bg-white py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary-600 sm:text-sm sm:leading-6 dark:bg-white/5 dark:text-white dark:ring-white/10 dark:focus:ring-primary-500;
    }

    .fi-label {
        @apply block text-sm font-medium leading-6 text-gray-950 dark:text-white;
    }

    .fi-select {
        @apply block w-full rounded-lg border-0 bg-white py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary-600 sm:text-sm sm:leading-6 dark:bg-white/5 dark:text-white dark:ring-white/10 dark:focus:ring-primary-500;
    }

    .fi-checkbox {
        @apply h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-600 dark:border-white/10 dark:bg-white/5 dark:focus:ring-offset-white/10;
    }
}


@layer base {
    :root {
        --color-primary-50: 236 253 245;
        --color-primary-100: 209 250 229;
        --color-primary-200: 167 243 208;
        --color-primary-300: 110 231 183;
        --color-primary-400: 52 211 153;
        --color-primary-500: 16 185 129;
        --color-primary-600: 5 150 105;
        --color-primary-700: 4 120 87;
        --color-primary-800: 6 95 70;
        --color-primary-900: 6 78 59;
        --color-primary-950: 2 44 34;

        --color-danger-50: 254 242 242;
        --color-danger-100: 254 226 226;
        --color-danger-200: 254 202 202;
        --color-danger-300: 252 165 165;
        --color-danger-400: 248 113 113;
        --color-danger-500: 239 68 68;
        --color-danger-600: 220 38 38;
        --color-danger-700: 185 28 28;
        --color-danger-800: 153 27 27;
        --color-danger-900: 127 29 29;
        --color-danger-950: 69 10 10;

        --color-success-50: 240 253 244;
        --color-success-100: 220 252 231;
        --color-success-200: 187 247 208;
        --color-success-300: 134 239 172;
        --color-success-400: 74 222 128;
        --color-success-500: 34 197 94;
        --color-success-600: 22 163 74;
        --color-success-700: 21 128 61;
        --color-success-800: 22 101 52;
        --color-success-900: 20 83 45;
        --color-success-950: 5 46 22;

        --color-warning-50: 254 252 232;
        --color-warning-100: 254 249 195;
        --color-warning-200: 254 240 138;
        --color-warning-300: 253 224 71;
        --color-warning-400: 250 204 21;
        --color-warning-500: 234 179 8;
        --color-warning-600: 202 138 4;
        --color-warning-700: 161 98 7;
        --color-warning-800: 133 77 14;
        --color-warning-900: 113 63 18;
        --color-warning-950: 66 32 6;
    }
}

/* Stili di base */
@layer base {
    body {
        @apply antialiased text-gray-900 bg-white;
    }

    h1 {
        @apply text-4xl font-bold tracking-tight;
    }

    h2 {
        @apply text-3xl font-bold tracking-tight;
    }

    h3 {
        @apply text-2xl font-bold;
    }

    h4 {
        @apply text-xl font-bold;
    }

    p {
        @apply text-base text-gray-700 leading-relaxed;
    }

    a {
        @apply text-primary-600 hover:text-primary-900;
    }

    /* Form */
    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="number"],
    input[type="tel"],
    input[type="url"],
    textarea {
        @apply block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm;
    }

    select {
        @apply block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm;
    }

    label {
        @apply block text-sm font-medium text-gray-700;
    }
}

/* Tabelle */
@layer components {
    table {
        @apply min-w-full divide-y divide-gray-300;
    }

    thead {
        @apply bg-gray-50;
    }

    th {
        @apply px-3 py-3.5 text-left text-sm font-semibold text-gray-900;
    }

    td {
        @apply whitespace-nowrap px-3 py-4 text-sm text-gray-500;
    }
}

/* Layout */
@layer components {
    .fi-section {
        @apply rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10;
    }

    .fi-section-header {
        @apply border-b border-gray-200 px-4 py-2.5 dark:border-white/10 sm:px-6;
    }

    .fi-section-content {
        @apply px-4 py-6 sm:px-6;
    }
}
