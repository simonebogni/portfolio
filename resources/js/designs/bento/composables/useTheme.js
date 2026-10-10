import { computed, onMounted, ref } from 'vue';

const STORAGE_KEY = 'theme';

/**
 * Light/dark theme handling.
 *
 * The site follows the operating-system preference until the visitor picks a
 * theme; the choice is then stored and re-applied before the first paint by
 * the inline script in resources/views/app.blade.php.
 */
export function useTheme() {
    const theme = ref('light');

    function currentTheme() {
        const chosen = document.documentElement.dataset.theme;

        if (chosen === 'light' || chosen === 'dark') {
            return chosen;
        }

        return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    }

    onMounted(() => {
        theme.value = currentTheme();
    });

    function toggle() {
        const next = theme.value === 'dark' ? 'light' : 'dark';

        document.documentElement.dataset.theme = next;
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
