/** Portfolio projects, grouped by category (PortfolioController). */
export interface ProjectImage {
    id: number;
    url: string;
    alt: string | null;
}

export interface Project {
    id: number;
    slug: string;
    title: string;
    subtitle: string | null;
    description: string | null;
    liveUrl: string | null;
    gitRepoUrl: string | null;
    coverImgUrl: string | null;
    /** "YYYY-MM-DD" */
    date: string | null;
    images: ProjectImage[];
    tags: string[];
}

export interface ProjectCategory {
    id: number;
    /** Machine name, e.g. "webapps". */
    name: string;
    /** Display title, e.g. "Web applications". */
    title: string;
    items: Project[];
}

/** A project together with the category it belongs to. */
export interface ProjectInCategory {
    project: Project;
    category: ProjectCategory;
}
