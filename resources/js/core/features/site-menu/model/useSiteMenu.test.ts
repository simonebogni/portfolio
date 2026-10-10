import { mount } from '@vue/test-utils';
import { describe, expect, it, vi } from 'vitest';
import { defineComponent, h } from 'vue';
import { type UseSiteMenu, useSiteMenu } from './useSiteMenu';

const listeners: Array<() => void> = [];

vi.mock('@inertiajs/vue3', () => ({
    usePage: () => ({ component: 'Portfolio' }),
    router: {
        on: (_event: string, callback: () => void) => {
            listeners.push(callback);

            return () => listeners.splice(listeners.indexOf(callback), 1);
        },
    },
}));

function mountMenu(labels = {}): UseSiteMenu {
    let state: UseSiteMenu | undefined;
    mount(defineComponent({ setup: () => ((state = useSiteMenu(labels)), () => h('nav')) }));

    return state!;
}

describe('useSiteMenu', () => {
    it('marks the current page and applies custom labels', () => {
        const menu = mountMenu({ Portfolio: 'Case studies' });

        expect(menu.items.value.map((item) => item.label)).toEqual(['About', 'Experience', 'Case studies', 'Soft skills', 'Hobbies']);
        expect(menu.items.value.filter((item) => item.current).map((item) => item.component)).toEqual(['Portfolio']);
    });

    it('opens and closes the menu, with Escape and on navigation', () => {
        const menu = mountMenu();

        menu.toggleMenu();
        expect(menu.menuOpen.value).toBe(true);
        menu.onMenuKeydown(new KeyboardEvent('keydown', { key: 'Escape' }));
        expect(menu.menuOpen.value).toBe(false);

        menu.toggleMenu();
        listeners.forEach((listener) => listener());
        expect(menu.menuOpen.value).toBe(false);
    });
});
