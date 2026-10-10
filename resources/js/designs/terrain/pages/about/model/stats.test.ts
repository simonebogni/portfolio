import { describe, expect, it } from 'vitest';
import { highlightStats } from './stats';

describe('highlightStats', () => {
    it('labels each count and hides zeros', () => {
        expect(highlightStats({ projects: 12, certificates: 1, awards: 0 }, 3)).toEqual([
            { value: 12, label: 'portfolio projects' },
            { value: 1, label: 'certification' },
            { value: 3, label: 'spoken languages' },
        ]);
    });
});
