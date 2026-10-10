import { formatMonthYear, isPlaceholder } from '@core/shared/lib';
import type { BlueprintCurrentRole } from '@designs/blueprint/entities/profile';
import type { LabelledValue } from '@designs/blueprint/shared/ui';

/** "2023-03" → "Mar 2023"; placeholders and free text are kept as they are. */
export function roleSince(since: string | null): string | null {
    if (!since || isPlaceholder(since)) {
        return since;
    }

    return formatMonthYear(since) || since;
}

/** The role scope spec sheet: team, partners, focus and hands-on work. */
export function roleScope(role: BlueprintCurrentRole, teamSize: number): LabelledValue[] {
    return [
        { label: 'Team', value: teamSize > 0 ? `${teamSize} developers` : null },
        { label: 'Partners', value: role.partners },
        { label: 'Focus', value: role.focus },
        { label: 'Hands-on', value: role.hands_on },
    ];
}
