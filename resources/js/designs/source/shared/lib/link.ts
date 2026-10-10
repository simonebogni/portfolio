/** True for paths of this site ("/…", not the protocol-relative "//…"): they use Inertia navigation. */
export function isInternal(href: string): boolean {
    return href.startsWith('/') && !href.startsWith('//');
}
