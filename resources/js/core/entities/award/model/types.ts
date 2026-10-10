/** An award (ExperienceController). */
export interface Award {
    id: number;
    title: string;
    subtitle: string | null;
    description: string | null;
    /** "YYYY-MM-DD" */
    issueDate: string | null;
    tags: string[];
}
