import { contactLink } from '@core/entities/profile';
import { describe, expect, it } from 'vitest';
import { bentoContact } from './contact';

const profile = { email: null, linkedin_url: null, github_url: null };

describe('bentoContact', () => {
    it('words an email link', () => {
        expect(bentoContact(contactLink({ ...profile, email: 'me@example.com' }))).toEqual({
            channel: 'email',
            href: 'mailto:me@example.com',
            label: 'Get in touch',
            icon: 'mail',
        });
    });

    it('words a LinkedIn link', () => {
        expect(bentoContact(contactLink({ ...profile, linkedin_url: 'https://linkedin.com/in/me' }))).toMatchObject({
            label: 'Get in touch on LinkedIn',
            icon: 'linkedin',
        });
    });

    it('words a GitHub link', () => {
        expect(bentoContact(contactLink({ ...profile, github_url: 'https://github.com/me' }))).toMatchObject({
            label: 'Find me on GitHub',
            icon: 'github',
        });
    });

    it('is null without a link', () => {
        expect(bentoContact(contactLink(profile))).toBeNull();
    });
});
