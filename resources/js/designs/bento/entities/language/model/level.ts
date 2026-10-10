import type { Language } from '@core/entities/language';

/** "Native", or the rating in words, followed by the certificate level when there is one. */
export function languageLevel(language: Pick<Language, 'isNative' | 'ratingMeaning' | 'certificateLevel'>): string {
    const level = language.isNative ? 'Native' : language.ratingMeaning;

    return language.certificateLevel ? `${level} · ${language.certificateLevel}` : level;
}
