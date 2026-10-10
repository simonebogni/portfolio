/** A label/value row of a spec sheet or a stat; empty values (null, undefined, '') are skipped. */
export interface LabelledValue {
    label: string;
    value: string | number | null | undefined;
}

/** One option of a single-choice filter. */
export interface FilterChoice {
    value: string;
    label: string;
}

/** True when a value should be shown: not null, undefined or ''. */
export function hasValue(item: LabelledValue): boolean {
    return item.value !== null && item.value !== undefined && item.value !== '';
}
