/** The current role, from config/profile.php (`current_role`). */
export interface CurrentRole {
    title: string;
    company: string | null;
    /** "YYYY-MM" or free text. */
    since: string | null;
    team_size: number;
    summary: string | null;
}

/**
 * The shared `profile` prop: config/profile.php, with the active design's copy from
 * config/designs.php merged on top. Designs describe their own copy by extending this type.
 */
export interface Profile {
    name: string;
    roles: string[];
    location: string | null;
    email: string | null;
    github_url: string | null;
    linkedin_url: string | null;
    current_role: CurrentRole;
    availability: string | null;
}

/** Set while the signed-in admin previews a design that visitors don't see. */
export interface DesignPreview {
    label: string;
    live: string;
}

/** Props the server shares with every page (HandleInertiaRequests). */
export interface SharedProps {
    design: string;
    designPreview: DesignPreview | null;
    profile: Profile;
}
