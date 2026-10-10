/**
 * True for lowercase "http://" and "https://" links, which open in a new tab. Unlike core's
 * isExternal, the match is case-sensitive, as it has always been in this design.
 */
export function isHttpUrl(href: string | null | undefined): boolean {
    return /^https?:\/\//.test(href ?? '');
}

/** True for site paths ("/portfolio"), which Inertia visits without a full page load. */
export function isSitePath(href: string | null | undefined): boolean {
    return Boolean(href?.startsWith('/') && !href.startsWith('//'));
}
