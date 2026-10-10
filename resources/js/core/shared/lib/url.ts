/** True for absolute http(s) links: they leave the site, so they open in a new tab. */
export function isExternal(href: string | null | undefined): boolean {
    return /^https?:\/\//i.test(String(href ?? ''));
}
