import type { Profile } from '@core/entities/profile';

/** The shared profile with the Bento copy from config/designs.php (`designs.bento.profile`). */
export interface BentoProfile extends Profile {
    /** Home page headline; its last word takes the accent colour. */
    headline: string | null;
    bio: string | null;
    /** Final grade of the main degree (e.g. "95%"), the big figure of the education card. */
    education_score: string | null;
}
