import type { IconName } from '@designs/bento/shared/ui';

/** Decorative icons, picked by keyword in the skill name, then by position. */
const ICON_RULES: [RegExp, IconName][] = [
    [/learn/i, 'cap'],
    [/problem|solv|analy/i, 'search'],
    [/responsib|ownership/i, 'shield'],
    [/team|collab/i, 'people'],
    [/manag|autonom/i, 'clock'],
    [/adapt/i, 'cycle'],
    [/open|mind/i, 'eye'],
    [/flexib/i, 'wave'],
];
const FALLBACK_ICONS: IconName[] = ['spark', 'cap', 'search', 'shield', 'people', 'clock', 'cycle', 'eye', 'wave'];

export function iconFor(name: string, index: number): IconName {
    return ICON_RULES.find(([pattern]) => pattern.test(name))?.[1] ?? FALLBACK_ICONS[index % FALLBACK_ICONS.length] ?? 'spark';
}

/** First tile sits beside the header, the next three fill a row of thirds, the rest go in halves (a last odd one full width). */
export function spanFor(index: number, count: number): number {
    if (index < 4) {
        return 4;
    }

    const rest = count - 4;
    const isLastOdd = rest % 2 === 1 && index === count - 1;

    return isLastOdd ? 12 : 6;
}
