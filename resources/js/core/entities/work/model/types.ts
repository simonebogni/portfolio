/** A role at a company (ExperienceController). */
export interface WorkPosition {
    id: number;
    title: string;
    period: string | null;
    startDate: string | null;
    endDate: string | null;
    current: boolean;
    /** Rich text written by the site owner in the admin panel. */
    descriptionHtml: string | null;
    tags: string[];
}

export interface Company {
    id: number;
    name: string;
    city: string | null;
    country: string | null;
    description: string | null;
    website: string | null;
    positions: WorkPosition[];
}
