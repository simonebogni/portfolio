import type { Company, WorkPosition } from '@core/entities/work';
import { describe, expect, it } from 'vitest';
import { currentRoleEntry, positionEntries } from './entries';

function position(id: number, startDate: string, current = false): WorkPosition {
    return { id, title: `Role ${id}`, period: null, startDate, endDate: null, current, descriptionHtml: null, tags: [] };
}

function company(positions: WorkPosition[]): Company {
    return { id: 1, name: 'Acme', city: 'Varese', country: 'Italy', description: null, website: null, positions };
}

const profile = {
    location: 'Tel Aviv, Israel',
    current_role: { title: 'Tech Lead', company: 'Initech', since: '2023', team_size: 5, summary: null },
};

describe('currentRoleEntry', () => {
    it('describes the configured role when no position is current', () => {
        expect(currentRoleEntry(profile, [company([position(1, '2020-01')])])).toEqual({
            title: 'Tech Lead',
            period: '2023 – present',
            organisation: 'Initech · Tel Aviv, Israel',
        });
    });

    it('is null when a position is current', () => {
        expect(currentRoleEntry(profile, [company([position(1, '2020-01', true)])])).toBeNull();
    });
});

describe('positionEntries', () => {
    it('lists positions newest first with their company', () => {
        const entries = positionEntries([company([position(1, '2019-01'), position(2, '2021-06')])]);

        expect(entries.map((entry) => entry.id)).toEqual([2, 1]);
        expect(entries[0]?.organisation).toBe('Acme · Varese, Italy');
    });
});
