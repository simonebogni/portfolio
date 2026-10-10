<script setup lang="ts">
import { useTerrainProfile } from '@designs/terrain/entities/profile';
import { SiteFooter } from '@designs/terrain/widgets/site-footer';
import { SiteHeader } from '@designs/terrain/widgets/site-header';

const { profile } = useTerrainProfile();
</script>

<template>
    <div class="site">
        <a class="skip-link" href="#main">Skip to main content</a>
        <SiteHeader :name="profile.name" />
        <main id="main" class="wrap site-main" tabindex="-1">
            <slot></slot>
        </main>
        <SiteFooter :profile="profile" />
    </div>
</template>
