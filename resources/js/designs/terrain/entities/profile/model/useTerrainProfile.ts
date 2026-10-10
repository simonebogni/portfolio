import { type UseProfile, useProfile } from '@core/entities/profile';
import type { TerrainProfile } from './types';

/** The shared profile, typed with Terrain's copy. */
export function useTerrainProfile(): UseProfile<TerrainProfile> {
    return useProfile<TerrainProfile>();
}
