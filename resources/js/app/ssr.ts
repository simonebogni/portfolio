import { createInertiaApp } from '@inertiajs/vue3';
import { inertiaOptions } from './inertia/options';

// A bare call: @inertiajs/vite wraps it in the SSR server bootstrap at build time.
createInertiaApp({
    ...inertiaOptions,
});
