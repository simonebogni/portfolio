import type { Language } from '@core/entities/language';

/** "Native", or how well it is spoken, plus any certificate level: "Fluent · C1". */
export function languageLevel(language: Language): string {
    return [language.isNative ? 'Native' : language.speaking || language.ratingMeaning, language.certificateLevel].filter(Boolean).join(' · ');
}
