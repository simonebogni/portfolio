import type { Profile } from '@core/entities/profile';

/** The one-line introductions under each page title (empty hides one). */
export interface KineticIntros {
    experience?: string | null;
    portfolio?: string | null;
    soft_skills?: string | null;
    hobbies?: string | null;
}

/** The shared profile with Kinetic's copy from config/designs.php (`designs.kinetic.profile`). */
export interface KineticProfile extends Profile {
    /** Short introduction next to the portrait on the home page. */
    bio?: string | null;
    intros?: KineticIntros;
}
