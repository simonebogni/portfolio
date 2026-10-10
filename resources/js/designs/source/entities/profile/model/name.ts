import { initials } from '@core/shared/lib';

function nameParts(name: string): string[] {
    return name.trim().split(/\s+/);
}

/** "Simone Bogni" → "Simone" */
export function firstName(name: string): string {
    return nameParts(name)[0] ?? '';
}

/** "Simone Bogni" → "simone.bogni": the brand shown in the header. */
export function handle(name: string): string {
    return nameParts(name).join('.').toLowerCase();
}

/** "Simone Bogni" → "sb": the brand mark. */
export function brandMark(name: string): string {
    return initials(name).toLowerCase();
}
