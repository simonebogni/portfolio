/** The Inertia page components of the public site. */
export type PageName = 'About' | 'Experience' | 'Portfolio' | 'SoftSkills' | 'Hobbies';

export interface NavigationItem {
    component: PageName;
    href: string;
    label: string;
}

/** The public pages, in navigation order. Designs may relabel them. */
export const navigationItems: readonly NavigationItem[] = [
    { component: 'About', href: '/', label: 'About' },
    { component: 'Experience', href: '/experience', label: 'Experience' },
    { component: 'Portfolio', href: '/portfolio', label: 'Portfolio' },
    { component: 'SoftSkills', href: '/softskills', label: 'Soft skills' },
    { component: 'Hobbies', href: '/hobbies', label: 'Hobbies' },
];
