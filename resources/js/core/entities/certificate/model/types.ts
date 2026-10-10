/** A certificate (ExperienceController). */
export interface Certificate {
    id: number;
    title: string;
    description: string | null;
    issuedBy: string | null;
    /** "YYYY-MM-DD" */
    issueDate: string | null;
    url: string | null;
    tags: string[];
}
