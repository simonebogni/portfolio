import type { Profile } from '@core/entities/profile';

/** The shared profile with Terrain's copy from config/designs.php (`designs.terrain.profile`). */
export interface TerrainProfile extends Profile {
    /** Follows "I’m <first name>, " in the home hero (PROFILE_HEADLINE). */
    headline?: string | null;
    /** Short introduction under the hero title (PROFILE_BIO). */
    bio?: string | null;
}
