import { computed, type ComputedRef, onMounted, type Ref, ref } from 'vue';

export type Theme = 'light' | 'dark';

const STORAGE_KEY = 'theme';

export interface UseTheme {
    theme: Ref<Theme>;
    isDark: ComputedRef<boolean>;
    toggle: () => void;
    toggleLabel: ComputedRef<string>;
}

/** The theme on screen: the visitor's saved choice, else the operating-system preference. */
function currentTheme(): Theme {
    const chosen = document.documentElement.dataset['theme'];

    if (chosen === 'light' || chosen === 'dark') {
        return chosen;
    }

    return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
}

/**
 * Light/dark theme handling.
 *
 * The site follows the operating-system preference until the visitor picks a theme; the choice is
 * then stored and re-applied before the first paint by the inline script in
 * resources/views/app.blade.php. On the server the theme is "light" until the page mounts.
 */
export function useTheme(): UseTheme {
    const theme = ref<Theme>('light');

    onMounted(() => {
        theme.value = currentTheme();
    });

    function toggle(): void {
        const next: Theme = theme.value === 'dark' ? 'light' : 'dark';

        document.documentElement.dataset['theme'] = next;
        theme.value = next;

        try {
            localStorage.setItem(STORAGE_KEY, next);
        } catch {
            // Storage can be unavailable (private mode); the choice then lasts for this page only.
        }
    }

    const isDark = computed(() => theme.value === 'dark');
    const toggleLabel = computed(() => (isDark.value ? 'Switch to light theme' : 'Switch to dark theme'));

    return { theme, isDark, toggle, toggleLabel };
}
