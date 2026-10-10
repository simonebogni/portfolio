import { createInertiaApp } from '@inertiajs/vue3';
import { inertiaOptions } from './inertia/options';

// The active design's stylesheet is loaded by resources/views/app.blade.php.
createInertiaApp({
    ...inertiaOptions,
    progress: {
        color: 'var(--color-accent)',
    },
});
