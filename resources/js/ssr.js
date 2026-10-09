import { createInertiaApp } from '@inertiajs/vue3';
import options from './inertia-options';

// A bare call: @inertiajs/vite wraps it in the SSR server bootstrap at build time.
createInertiaApp({
    pages: './pages',
    ...options,
});
