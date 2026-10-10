import { readdirSync } from 'node:fs';
import inertia from '@inertiajs/vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';
import { aliases } from './vite.aliases.ts';

// One stylesheet entry per design (resources/js/designs/<design>/app/styles/index.css).
const designStylesheets = readdirSync('resources/js/designs').map((design) => `resources/js/designs/${design}/app/styles/index.css`);

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app/client.ts', ...designStylesheets],
            ssr: 'resources/js/app/ssr.ts',
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
    resolve: {
        alias: aliases,
    },
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
