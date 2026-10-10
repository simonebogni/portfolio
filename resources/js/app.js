import { createInertiaApp } from '@inertiajs/vue3';
import options from './inertia-options';

// The active design's stylesheet is loaded by resources/views/app.blade.php.
createInertiaApp({
    ...options,
    progress: {
        color: 'var(--color-accent)',
    },
});
