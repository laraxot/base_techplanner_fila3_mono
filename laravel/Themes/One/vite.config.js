<<<<<<< HEAD
import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin'

import path from 'path';

export default defineConfig({
=======
import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    build: {
        //outDir: '../../../public_html/build/ewall',
        outDir: __dirname + '/resources/dist',
        emptyOutDir: false,
        manifest: 'manifest.json',
        //rollupOptions: {
        //    output: {
        //        entryFileNames: 'assets/[name].js',
        //        chunkFileNames: 'assets/[name].js',
        //        assetFileNames: 'assets/[name].[ext]'
        //    }
        //}
    },
    ssr: {
        noExternal: ['chart.js/**']
    },
>>>>>>> 1b374b6 (.)
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
<<<<<<< HEAD
            //refresh: true,
            refresh: [
                ...refreshPaths,
                'app/Livewire/**',
            ],
        }),
    ],
    build: {
        outDir: './public',
        emptyOutDir: false,
        manifest: 'manifest.json',
        /*
        rollupOptions: {
            input: [
                path.resolve(__dirname, 'resources/css/app.css'),
                path.resolve(__dirname, 'resources/js/app.js'),
            ],
        },
        */
    },
    resolve: {
        alias: {
            '@': '/resources/js',
        },
=======
            refresh: true,
        }),
        //tailwindcss(),
    ],
    server: {
        cors: true,
>>>>>>> 1b374b6 (.)
    },
});
