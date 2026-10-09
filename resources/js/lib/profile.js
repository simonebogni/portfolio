/**
 * Helpers for the shared `profile` prop (config/profile.php).
 */

/** Replaces `:team_size` in config copy with the configured team size. */
export function fillProfile(text, profile) {
    if (text === null || text === undefined) {
        return '';
    }

    const teamSize = profile?.current_role?.team_size ?? '';

    return String(text).replaceAll(':team_size', String(teamSize));
}

/** True for owner-facing placeholders such as "[CURRENT COMPANY]". */
export function isPlaceholder(text) {
    return typeof text === 'string' && /^\s*\[.*\]\s*$/s.test(text);
}

/** "Simone Bogni" → "SB" */
export function initials(name) {
    return String(name ?? '')
        .split(/\s+/)
        .filter(Boolean)
        .slice(0, 2)
        .map((part) => part[0].toUpperCase())
        .join('');
}

/** True for links that leave the site (they open in a new tab). */
export function isExternal(href) {
    return /^https?:\/\//i.test(String(href ?? ''));
}

/**
 * The best way to get in touch, from the configured links:
 * email first, then LinkedIn, then GitHub. Null when none is set.
 */
export function contactLink(profile) {
    if (profile?.email) {
        return { href: `mailto:${profile.email}`, label: "Let's talk", short: 'Get in touch' };
    }

    if (profile?.linkedin_url) {
        return { href: profile.linkedin_url, label: "Let's talk on LinkedIn", short: 'Get in touch' };
    }

    if (profile?.github_url) {
        return { href: profile.github_url, label: 'See my GitHub', short: 'See my GitHub' };
    }

    return null;
}

/**
 * Splits "a *highlighted* text" into [{ text, em }] segments, so a template can
 * render the emphasis without v-html.
 */
export function emphasisSegments(text) {
    return String(text ?? '')
        .split('*')
        .map((part, index) => ({ text: part, em: index % 2 === 1 }))
        .filter((segment) => segment.text !== '');
}
