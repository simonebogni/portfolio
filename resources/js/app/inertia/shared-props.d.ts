import type { SharedProps } from '@core/entities/profile';

// Types the props every page receives from HandleInertiaRequests (usePage().props).
declare module '@inertiajs/core' {
    export interface InertiaConfig {
        sharedPageProps: SharedProps;
    }
}

export {};
