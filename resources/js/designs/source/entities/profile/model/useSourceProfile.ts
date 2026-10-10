import { type UseProfile, useProfile } from '@core/entities/profile';
import type { SourceProfile } from './types';

/** The shared profile prop, typed with the Source copy. */
export function useSourceProfile(): UseProfile<SourceProfile> {
    return useProfile<SourceProfile>();
}
