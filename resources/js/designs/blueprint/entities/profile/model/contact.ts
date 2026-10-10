import type { ContactLink } from '@core/entities/profile';

/** The contact link in Blueprint's words: `label` for the footer, `short` for the home page button. */
export interface ContactAction {
    href: string;
    label: string;
    short: string;
}

const WORDING: Record<ContactLink['channel'], Pick<ContactAction, 'label' | 'short'>> = {
    email: { label: "Let's talk", short: 'Get in touch' },
    linkedin: { label: "Let's talk on LinkedIn", short: 'Get in touch' },
    github: { label: 'See my GitHub', short: 'See my GitHub' },
};

export function contactAction(link: ContactLink | null): ContactAction | null {
    return link ? { href: link.href, ...WORDING[link.channel] } : null;
}
