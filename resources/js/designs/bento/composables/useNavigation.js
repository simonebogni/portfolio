import { router, usePage } from '@inertiajs/vue3';
import { computed, onBeforeUnmount, ref } from 'vue';

/** The public pages, in navigation order. Designs may relabel them. */
export const navigationItems = [
    { component: 'About', href: '/', label: 'About' },
    { component: 'Experience', href: '/experience', label: 'Experience' },
    { component: 'Portfolio', href: '/portfolio', label: 'Portfolio' },
    { component: 'SoftSkills', href: '/softskills', label: 'Soft skills' },
    { component: 'Hobbies', href: '/hobbies', label: 'Hobbies' },
];

/**
 * Navigation state: which page is current, and the open/closed state of the
 * mobile menu (closed again on every navigation and with the Escape key).
 */
export function useNavigation(labels = {}) {
    const page = usePage();
    const menuOpen = ref(false);

    const items = computed(() =>
        navigationItems.map((item) => ({
            ...item,
            label: labels[item.component] ?? item.label,
            current: page.component === item.component,
        })),
    );

    function toggleMenu() {
        menuOpen.value = !menuOpen.value;
    }

    function closeMenu() {
        menuOpen.value = false;
    }

    function onMenuKeydown(event) {
        if (event.key === 'Escape') {
            closeMenu();
        }
    }

    const stopListening = router.on('navigate', closeMenu);
    onBeforeUnmount(stopListening);

    return { items, menuOpen, toggleMenu, closeMenu, onMenuKeydown };
}
