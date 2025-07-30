//const dotenvExpand = require('dotenv-expand');
//dotenvExpand(
//	require('dotenv').config({ path: '../../.env' /*, debug: true*/ }),
//);

import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin'



export default defineConfig({
    build: {
        //outDir: '../../../public_html/build/ewall',
        outDir: './resources/dist',
        emptyOutDir: false,
        manifest: 'manifest.json',
        //rollupOptions: {
        //    output: {
        //        entryFileNames: `assets/[name].js`,
        //        chunkFileNames: `assets/[name].js`,
        //        assetFileNames: `assets/[name].[ext]`
        //    }
        //}
    },
    ssr: {
        noExternal: ['chart.js/**']
    },
    plugins: [
        laravel({
            publicDirectory: '../../../public_html/',
            // buildDirectory: 'assets/',
            input: [
                //__dirname + '/resources/sass/app.scss',
                //__dirname + '/resources/scss/app-mix.scss',
                __dirname + '/resources/css/app.css',
                __dirname + '/resources/js/app.js',
                // Aggiungiamo i CSS di Filament
                //__dirname + '/vendor/filament/**/*.css',
            ],
            refresh: [
                ...refreshPaths,
                'app/Livewire/**',
            ],
        }),
    ],
    resolve: {
        alias: {
            '@': '/resources',
        },
    },
});


/*
import collectModuleAssetsPaths from './../../vite-module-loader.js';

async function getConfig() {
    const paths = [
        'resources/css/app.css',
        'resources/js/app.js',
    ];
    const allPaths = await collectModuleAssetsPaths(paths, 'Modules');

    return defineConfig({
        plugins: [
            laravel({
                input: allPaths,
                refresh: true,
            })
        ]
    });
}

export default getConfig();
*/

/*
var $from = './resources/dist';
var $to = '../../../public_html/themes/Five/dist';
console.log('from :' + $from);
console.log('to :' + $to);

//mix.copyDirectory($from, $to);
viteStaticCopy({
    targets: [
        {
            src: $from,
            dest: $to
        }
    ]
})
*/
