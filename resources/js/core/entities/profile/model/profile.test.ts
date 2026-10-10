import { describe, expect, it, vi } from 'vitest';
import { contactLink } from './contact';
import { cityOf, fillProfileCopy } from './copy';
import type { Profile } from './types';
import { useProfile } from './useProfile';

const profile: Profile = {
    name: 'Simone Bogni',
    roles: ['Tech Lead'],
    location: 'Tel Aviv, Israel',
    email: null,
    github_url: 'https://github.com/simonebogni',
    linkedin_url: null,
    current_role: { title: 'Tech Lead', company: null, since: null, team_size: 15, summary: null },
    availability: null,
};

vi.mock('@inertiajs/vue3', () => ({ usePage: () => ({ props: { profile } }) }));

describe('contactLink', () => {
    it('prefers email, then LinkedIn, then GitHub', () => {
        expect(contactLink({ email: 'me@example.com', linkedin_url: 'https://linkedin.com/in/me', github_url: 'https://github.com/me' })).toEqual({
            channel: 'email',
            href: 'mailto:me@example.com',
        });
        expect(contactLink({ email: null, linkedin_url: 'https://linkedin.com/in/me', github_url: 'https://github.com/me' })?.channel).toBe('linkedin');
        expect(contactLink({ email: null, linkedin_url: null, github_url: 'https://github.com/me' })?.channel).toBe('github');
        expect(contactLink({ email: null, linkedin_url: null, github_url: null })).toBeNull();
    });
});

describe('profile copy', () => {
    it('fills the team size and reads the city', () => {
        expect(fillProfileCopy('A team of :team_size developers', profile)).toBe('A team of 15 developers');
        expect(fillProfileCopy(null, profile)).toBe('');
        expect(cityOf('Tel Aviv, Israel')).toBe('Tel Aviv');
        expect(cityOf(null)).toBe('');
    });
});

describe('useProfile', () => {
    it('exposes the shared profile and values derived from it', () => {
        const { profile: current, teamSize, city, contact, fill } = useProfile();

        expect(current.value.name).toBe('Simone Bogni');
        expect(teamSize.value).toBe(15);
        expect(city.value).toBe('Tel Aviv');
        expect(contact.value?.channel).toBe('github');
        expect(fill(':team_size people')).toBe('15 people');
    });
});
