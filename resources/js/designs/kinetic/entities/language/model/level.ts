import type { Language } from '@core/entities/language';

/** "Native", else the speaking level (or what the rating means), plus the certificate level: "C1 · IELTS". */
export function languageLevel(language: Language): string {
    const level = language.isNative ? 'Native' : language.speaking || language.ratingMeaning;

    return [level, language.certificateLevel].filter(Boolean).join(' · ');
}
