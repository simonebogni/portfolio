import { describe, expect, it } from 'vitest';
import { defineComponent } from 'vue';
import { createDesignTracker, pageModuleKey, resolveLayout, resolvePage, sliceName } from './resolve';

const About = defineComponent({ name: 'About' });
const Other = defineComponent({ name: 'Other' });
const Layout = defineComponent({ name: 'Layout' });

describe('sliceName', () => {
    it('turns an Inertia component name into a kebab-case slice folder', () => {
        expect(sliceName('About')).toBe('about');
        expect(sliceName('SoftSkills')).toBe('soft-skills');
    });
});

describe('createDesignTracker', () => {
    it('follows the design of each page and keeps the last one when a call has no page', () => {
        const designOf = createDesignTracker('source');

        expect(designOf()).toBe('source');
        expect(designOf({ props: { design: 'bento' } })).toBe('bento');
        expect(designOf()).toBe('bento');
        expect(designOf({ props: {} })).toBe('bento');
    });
});

describe('resolvePage', () => {
    it("loads the default export of the design's page slice", async () => {
        const modules = {
            '../../designs/bento/pages/soft-skills/index.ts': async () => ({ default: About }),
            '../../designs/kinetic/pages/soft-skills/index.ts': async () => ({ default: Other }),
        };

        expect(pageModuleKey('bento', 'SoftSkills')).toBe('../../designs/bento/pages/soft-skills/index.ts');
        await expect(resolvePage(modules, 'bento', 'SoftSkills')).resolves.toBe(About);
        await expect(resolvePage(modules, 'kinetic', 'SoftSkills')).resolves.toBe(Other);
    });

    it('fails clearly when the design has no such page', async () => {
        await expect(resolvePage({}, 'terrain', 'Hobbies')).rejects.toThrow('Page not found: Hobbies (design "terrain")');
    });
});

describe('resolveLayout', () => {
    it("reads `Layout` from the design's app index", () => {
        expect(resolveLayout({ '../../designs/source/app/index.ts': { Layout } }, 'source')).toBe(Layout);
        expect(resolveLayout({ '../../designs/source/app/index.ts': { Layout } }, 'bento')).toBeUndefined();
    });
});
