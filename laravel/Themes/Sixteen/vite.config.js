//const dotenvExpand = require('dotenv-expand');
//dotenvExpand(
//	require('dotenv').config({ path: '../../.env' /*, debug: true*/ }),
//);

import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin'



export default defineConfig({
    build: {
        //outDir: '../../../public_html/build/ewall',
