import { describe, expect, it } from 'vitest';
import { currentLine, rolesTitle, splitHeadline } from './about';

const role = { title: 'Tech Lead', company: 'Acme', since: '2023', team_size: 4, summary: null };

describe('splitHeadline', () => {
    it('splits off the last word and its punctuation', () => {
        expect(splitHeadline('Full-stack developer who loves taking ideas to reality.')).toEqual({
            start: 'Full-stack developer who loves taking ideas to ',
            accent: 'reality',
            end: '.',
        });
    });

    it('accents a single word whole', () => {
        expect(splitHeadline(' Simone ')).toEqual({ start: '', accent: 'Simone', end: '' });
    });
});

describe('rolesTitle', () => {
    it('joins the roles', () => {
        expect(rolesTitle(['Developer', 'Designer', 'Tech Lead'])).toBe('Developer, Designer & Tech Lead');
        expect(rolesTitle(['Developer'])).toBe('Developer');
        expect(rolesTitle([])).toBe('');
    });
});

describe('currentLine', () => {
    it('adds the current role when it has a company', () => {
        expect(currentLine({ location: 'Tel Aviv, Israel', current_role: role })).toBe('Based in Tel Aviv, Israel. Tech Lead at Acme since 2023.');
        expect(currentLine({ location: 'Varese', current_role: { ...role, company: null } })).toBe('Based in Varese.');
    });
});
