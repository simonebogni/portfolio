import type { Profile } from '@core/entities/profile';

/** One-sentence introductions under the page titles (empty hides them). */
export interface SourceIntros {
    experience?: string | null;
    portfolio?: string | null;
    soft_skills?: string | null;
    hobbies?: string | null;
}

/** The shared profile with the Source copy from config/designs.php (`designs.source.profile`). */
export interface SourceProfile extends Profile {
    bio?: string | null;
    tagline?: string | null;
    intros?: SourceIntros;
}
