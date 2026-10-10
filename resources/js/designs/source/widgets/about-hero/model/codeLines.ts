import type { SkillCategory } from '@core/entities/skill';
import type { CodeLine, CodeToken } from '@designs/source/shared/ui';

export interface ProfileCode {
    /** The variable name: the first name in lowercase. */
    variable: string;
    role: string;
    location: string | null;
    skillCategories: readonly SkillCategory[];
    languages: number;
}

const str = (text: string): CodeToken => ({ text: `"${text}"`, kind: 'string' });
const plain = (text: string): CodeToken => ({ text });

/** The hero "source file", generated from the real profile and skills. */
export function profileCodeLines({ variable, role, location, skillCategories, languages }: ProfileCode): CodeLine[] {
    const stack = skillCategories
        .map((category) => category.name)
        .filter((name) => name.toLowerCase() !== 'more')
        .slice(0, 3);

    const stackTokens = stack.flatMap((name, index) => (index === 0 ? [str(name)] : [plain(', '), str(name)]));

    return [
        [{ text: 'const', kind: 'keyword' }, plain(` ${variable} = {`)],
        [plain('  role: '), str(role), plain(',')],
        [plain('  stack: ['), ...stackTokens, plain('],')],
        ...(location ? [[plain('  based: '), str(location), plain(',')]] : []),
        [plain('  languages: '), { text: String(languages), kind: 'literal' }, plain(',')],
        [plain('  learning: '), { text: 'Infinity', kind: 'literal' }, plain(',')],
        [plain('};')],
    ];
}
