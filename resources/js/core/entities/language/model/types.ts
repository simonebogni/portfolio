/** A spoken language (AboutController). */
export interface Language {
    id: number;
    name: string;
    /** Rounded to the nearest half point, 0–5. */
    rating: number;
    ratingMeaning: string;
    speaking: string;
    isNative: boolean;
    certificateLevel: string | null;
}
