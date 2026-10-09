import '../css/app.css';

import { createInertiaApp } from '@inertiajs/vue3';
import options from './inertia-options';

createInertiaApp({
    pages: './pages',
    ...options,
    progress: {
        color: 'var(--color-accent)',
    },
});
