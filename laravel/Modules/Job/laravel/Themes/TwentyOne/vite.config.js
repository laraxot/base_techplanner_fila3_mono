import { defineConfig } from "vite";
import laravel, { refreshPaths } from "laravel-vite-plugin";

export default defineConfig({
	build: {
		outDir: "./resources/dist",
		emptyOutDir: false,
        manifest: 'manifest.json',
		rollupOptions: {
			output: {
				entryFileNames: `assets/[name].js`,
				chunkFileNames: `assets/[name].js`,
				assetFileNames: `assets/[name].[ext]`,
			},
		},
	},
	ssr: {
		noExternal: ["chart.js/**"],
	},
	plugins: [
		laravel({
			publicDirectory: "../../../public_html/",
			input: [__dirname + "/resources/css/app.css", __dirname + "/resources/js/app.js", __dirname + "/resources/css/filament/admin/theme.css"],
			refresh: [...refreshPaths, "app/Livewire/**"],
		}),
	],
});
