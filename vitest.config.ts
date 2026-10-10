import vue from '@vitejs/plugin-vue';
import { defineConfig } from 'vitest/config';
import { aliases } from './vite.aliases.ts';

// Unit tests for the front end: *.test.ts files next to the code they test.
export default defineConfig({
    plugins: [vue()],
    resolve: {
        alias: aliases,
    },
    test: {
        environment: 'jsdom',
        include: ['resources/js/**/*.test.ts'],
    },
});
