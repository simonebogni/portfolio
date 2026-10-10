import { describe, expect, it } from 'vitest';
import { defineComponent } from 'vue';
import { createDesignTracker, pageModuleKeys, resolveLayout, resolvePage, sliceName } from './resolve';

const About = defineComponent({ name: 'About' });
const Legacy = defineComponent({ name: 'Legacy' });
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
    it('prefers the FSD slice over the pre-FSD page file', async () => {
        const modules = {
            '../../designs/bento/pages/soft-skills/index.ts': async () => ({ default: About }),
            '../../designs/bento/pages/SoftSkills.vue': async () => ({ default: Legacy }),
        };

        expect(pageModuleKeys('bento', 'SoftSkills')[0]).toBe('../../designs/bento/pages/soft-skills/index.ts');
        await expect(resolvePage(modules, 'bento', 'SoftSkills')).resolves.toBe(About);
    });

    it('falls back to the pre-FSD page file', async () => {
        const modules = { '../../designs/kinetic/pages/About.vue': async () => ({ default: Legacy }) };

        await expect(resolvePage(modules, 'kinetic', 'About')).resolves.toBe(Legacy);
    });

    it('fails clearly when the design has no such page', async () => {
        await expect(resolvePage({}, 'terrain', 'Hobbies')).rejects.toThrow('Page not found: Hobbies (design "terrain")');
    });
});

describe('resolveLayout', () => {
    it('reads `Layout` from an FSD app index, or the default export of a pre-FSD layout', () => {
        expect(resolveLayout({ '../../designs/source/app/index.ts': { Layout } }, 'source')).toBe(Layout);
        expect(resolveLayout({ '../../designs/source/layouts/SiteLayout.vue': { default: Legacy } }, 'source')).toBe(Legacy);
        expect(resolveLayout({}, 'source')).toBeUndefined();
    });
});
