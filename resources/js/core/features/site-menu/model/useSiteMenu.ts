import { navigationItems, type NavigationItem, type PageName } from '@core/shared/config';
import { router, usePage } from '@inertiajs/vue3';
import { computed, type ComputedRef, onBeforeUnmount, type Ref, ref } from 'vue';

export interface SiteMenuItem extends NavigationItem {
    current: boolean;
}

export interface UseSiteMenu {
    items: ComputedRef<SiteMenuItem[]>;
    menuOpen: Ref<boolean>;
    toggleMenu: () => void;
    closeMenu: () => void;
    onMenuKeydown: (event: KeyboardEvent) => void;
}

/**
 * Navigation state: which page is current, and the open/closed state of the mobile menu
 * (closed again on every navigation and with the Escape key). `labels` relabels pages.
 */
export function useSiteMenu(labels: Partial<Record<PageName, string>> = {}): UseSiteMenu {
    const page = usePage();
    const menuOpen = ref(false);

    const items = computed(() =>
        navigationItems.map((item) => ({
            ...item,
            label: labels[item.component] ?? item.label,
            current: page.component === item.component,
        })),
    );

    function toggleMenu(): void {
        menuOpen.value = !menuOpen.value;
    }

    function closeMenu(): void {
        menuOpen.value = false;
    }

    function onMenuKeydown(event: KeyboardEvent): void {
        if (event.key === 'Escape') {
            closeMenu();
        }
    }

    const stopListening = router.on('navigate', closeMenu);
    onBeforeUnmount(stopListening);

    return { items, menuOpen, toggleMenu, closeMenu, onMenuKeydown };
}
