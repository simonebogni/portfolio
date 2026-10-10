import type { Language } from '@core/entities/language';

/** "Native", or the speaking level, with the certificate level: "Fluent · C1". */
export function languageLevel(language: Language): string {
    const level = language.isNative ? 'Native' : language.speaking || language.ratingMeaning;

    return [level, language.certificateLevel].filter(Boolean).join(' · ');
}
