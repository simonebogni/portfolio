import { type ContactChannel, type ContactLink } from '@core/entities/profile';
import { type IconName } from '@designs/bento/shared/ui';

/** The best contact link, worded for Bento's call-to-action button. */
export interface BentoContact extends ContactLink {
    label: string;
    icon: IconName;
}

const WORDING: Record<ContactChannel, { label: string; icon: IconName }> = {
    email: { label: 'Get in touch', icon: 'mail' },
    linkedin: { label: 'Get in touch on LinkedIn', icon: 'linkedin' },
    github: { label: 'Find me on GitHub', icon: 'github' },
};

/** Adds Bento's label and icon to the contact link chosen by core (email, then LinkedIn, then GitHub). */
export function bentoContact(link: ContactLink | null): BentoContact | null {
    return link ? { ...link, ...WORDING[link.channel] } : null;
}
