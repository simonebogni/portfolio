import { fileURLToPath } from 'node:url';

/**
 * Import aliases for the front end, used by Vite and Vitest. tsconfig.json mirrors them for TypeScript and ESLint.
 *
 * - `@app`     the Inertia bootstrap
 * - `@core`    logic shared by every design (no markup, no CSS)
 * - `@designs` the UI of each design
 */
export const aliases = {
    '@app': fileURLToPath(new URL('./resources/js/app', import.meta.url)),
    '@core': fileURLToPath(new URL('./resources/js/core', import.meta.url)),
    '@designs': fileURLToPath(new URL('./resources/js/designs', import.meta.url)),
};
