import { mount } from '@vue/test-utils';
import { beforeEach, describe, expect, it, vi } from 'vitest';
import { defineComponent, h } from 'vue';
import { type UseTheme, useTheme } from './useTheme';

function mountTheme(): UseTheme {
    let state: UseTheme | undefined;
    mount(defineComponent({ setup: () => ((state = useTheme()), () => h('div')) }));

    return state!;
}

describe('useTheme', () => {
    beforeEach(() => {
        delete document.documentElement.dataset['theme'];
        localStorage.clear();
        vi.stubGlobal('matchMedia', (query: string) => ({ matches: query === '(prefers-color-scheme: dark)' }));
    });

    it('follows the system preference until the visitor chooses', () => {
        expect(mountTheme().isDark.value).toBe(true);
    });

    it('applies and remembers the chosen theme', () => {
        const theme = mountTheme();

        theme.toggle();

        expect(theme.theme.value).toBe('light');
        expect(document.documentElement.dataset['theme']).toBe('light');
        expect(localStorage.getItem('theme')).toBe('light');
        expect(theme.toggleLabel.value).toBe('Switch to dark theme');
    });

    it('starts from a theme chosen earlier', () => {
        document.documentElement.dataset['theme'] = 'light';

        expect(mountTheme().theme.value).toBe('light');
    });
});
