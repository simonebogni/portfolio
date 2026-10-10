import { describe, expect, it } from 'vitest';
import { nameParts } from './name';

describe('nameParts', () => {
    it('ends the name with an orange last word and a full stop', () => {
        expect(nameParts('Simone Bogni')).toEqual({ first: 'Simone', last: 'Bogni.' });
        expect(nameParts(' Anna Maria Rossi ')).toEqual({ first: 'Anna Maria', last: 'Rossi.' });
        expect(nameParts('Cher')).toEqual({ first: '', last: 'Cher.' });
    });
});
