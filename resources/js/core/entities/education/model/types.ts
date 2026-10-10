/** Education and online learning (ExperienceController). */
export interface Course {
    id: number;
    name: string;
    score: number | null;
    scoreMax: number | null;
    cumLaude: boolean;
}

export interface Program {
    id: number;
    name: string;
    period: string | null;
    current: boolean;
    description: string | null;
    institute: string | null;
    onlinePlatform: string | null;
    tags: string[];
    courses: Course[];
}

export interface Institute {
    id: number;
    name: string;
    website: string | null;
    programs: Program[];
}
