import type { Profile } from './types';

export type ContactChannel = 'email' | 'linkedin' | 'github';

export interface ContactLink {
    channel: ContactChannel;
    href: string;
}

/**
 * The best way to get in touch, from the configured links: email first, then LinkedIn, then GitHub.
 * Null when none is set. Each design words the link itself.
 */
export function contactLink(profile: Pick<Profile, 'email' | 'linkedin_url' | 'github_url'> | null | undefined): ContactLink | null {
    if (profile?.email) {
        return { channel: 'email', href: `mailto:${profile.email}` };
    }

    if (profile?.linkedin_url) {
        return { channel: 'linkedin', href: profile.linkedin_url };
    }

    if (profile?.github_url) {
        return { channel: 'github', href: profile.github_url };
    }

    return null;
}
