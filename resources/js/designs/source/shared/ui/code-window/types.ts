/** A piece of a code line; `kind` picks its syntax colour. */
export interface CodeToken {
    text: string;
    kind?: 'keyword' | 'string' | 'literal';
}

export type CodeLine = CodeToken[];
