/** @type {import('tailwindcss').Config} */
export default {
	content: [
		"./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
		"./storage/framework/views/*.php",
		"./resources/views/**/*.blade.php",
		"./resources/views/**/*.blade.php",
		"../../Modules/**/Filament/**/*.php",
		"../../Modules/resources/views/**/*.blade.php",
		"../../resources/views/filament/**/*.blade.php",
		"../../vendor/filament/**/*.blade.php",
		"../../resources/views/**/*.blade.php",
		"../../storage/framework/views/*.php",
        "../../vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./node_modules/flowbite/**/*.js",
	],
	theme: {
		fontFamily: {
			sans: ["Figtree", "ui-sans-serif", "system-ui", "sans-serif", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"],
		},
		extend: {},
	},
    plugins: [
		require('flowbite/plugin'),
		require('@tailwindcss/typography'),
    ],
};
