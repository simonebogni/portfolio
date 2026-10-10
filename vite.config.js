import inertia from '@inertiajs/vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { readdirSync } from 'node:fs';
import { defineConfig } from 'vite';

// One stylesheet entry per design (resources/css/designs/<design>/app.css).
const designStylesheets = readdirSync('resources/css/designs').map((design) => `resources/css/designs/${design}/app.css`);

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js', ...designStylesheets],
            ssr: 'resources/js/ssr.js',
            refresh: true,
        }),
        inertia(),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
