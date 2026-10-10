/** The icons AppIcon can draw. */
export type IconName =
    | 'arrowRight'
    | 'menu'
    | 'close'
    | 'sun'
    | 'moon'
    | 'pin'
    | 'cap'
    | 'github'
    | 'linkedin'
    | 'mail'
    | 'trophy'
    | 'external'
    | 'code'
    | 'check';

/** Stroke paths per icon (24×24 grid). The sun and a few extra shapes are drawn in the template. */
export const iconPaths: Partial<Record<IconName, readonly string[]>> = {
    arrowRight: ['M5 12h14', 'M13 6l6 6-6 6'],
    menu: ['M4 7h16', 'M4 12h16', 'M4 17h16'],
    close: ['M6 6l12 12', 'M18 6L6 18'],
    moon: ['M20 14.5A8 8 0 0 1 9.5 4a8 8 0 1 0 10.5 10.5z'],
    pin: ['M12 21s-7-6.2-7-11a7 7 0 0 1 14 0c0 4.8-7 11-7 11z'],
    cap: ['M3 7l9-4 9 4-9 4-9-4z', 'M7 9v5c0 1.7 2.2 3 5 3s5-1.3 5-3V9'],
    github: [
        'M9 19c-4.3 1.4-4.3-2.5-6-3m12 5v-3.5c0-1 .1-1.4-.5-2 2.8-.3 5.5-1.4 5.5-6a4.6 4.6 0 0 0-1.3-3.2 4.2 4.2 0 0 0-.1-3.2s-1.1-.3-3.5 1.3a12.3 12.3 0 0 0-6.2 0C6.5 2.8 5.4 3.1 5.4 3.1a4.2 4.2 0 0 0-.1 3.2A4.6 4.6 0 0 0 4 9.5c0 4.6 2.7 5.7 5.5 6-.6.6-.6 1.2-.5 2V21',
    ],
    linkedin: ['M8 11v5', 'M8 8v.01', 'M12 16v-5', 'M16 16v-3a2 2 0 0 0-4 0'],
    mail: ['M3 7l9 6 9-6'],
    trophy: ['M8 21h8', 'M12 17v4', 'M7 4h10v5a5 5 0 0 1-10 0V4z', 'M17 5h3v2a3 3 0 0 1-3 3', 'M7 5H4v2a3 3 0 0 0 3 3'],
    external: ['M14 4h6v6', 'M20 4l-9 9', 'M18 14v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h5'],
    code: ['M8 8l-4 4 4 4', 'M16 8l4 4-4 4'],
    check: ['M5 12l5 5 9-10'],
};
