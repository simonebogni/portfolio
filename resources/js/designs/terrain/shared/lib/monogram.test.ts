import { describe, expect, it } from 'vitest';
import { monogram } from './monogram';

describe('monogram', () => {
    it('takes the initials of up to three words, skipping small words', () => {
        expect(monogram('Interactive CV and Portfolio')).toBe('ICP');
        expect(monogram('the art of the web')).toBe('AW');
        expect(monogram('Snake – Java edition')).toBe('SJE');
        expect(monogram('my_cool/project-name')).toBe('MCP');
        expect(monogram('e-Commerce Platform For Shoes')).toBe('ECP');
        expect(monogram('über cool')).toBe('ÜC');
        expect(monogram('123 go')).toBe('1G');
    });

    it('honours a smaller maximum', () => {
        expect(monogram('Interactive CV and Portfolio', 2)).toBe('IC');
        expect(monogram('Snake – Java edition', 2)).toBe('SJ');
    });

    it('uses the capitals of a single word, else its first two letters', () => {
        expect(monogram('FaceDoor')).toBe('FD');
        expect(monogram('WatchNeighbors')).toBe('WN');
        expect(monogram('Treemap')).toBe('Tr');
        expect(monogram('x')).toBe('X');
    });

    it('is empty when no word is left', () => {
        expect(monogram('')).toBe('');
        expect(monogram('a')).toBe('');
    });
});
