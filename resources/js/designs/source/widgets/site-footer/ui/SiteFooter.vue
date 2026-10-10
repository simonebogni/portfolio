<script setup lang="ts">
import { useSourceProfile } from '@designs/source/entities/profile';
import { IconButton } from '@designs/source/shared/ui';

const { profile } = useSourceProfile();
</script>

<template>
    <footer class="site-footer">
        <div class="container site-footer__inner">
            <p class="site-footer__text">
                <strong>{{ profile.name }}</strong> — {{ profile.roles.slice(0, 2).join(', ') }}
                <template v-if="profile.location"> · {{ profile.location }}</template>
            </p>
            <ul class="bare-list site-footer__links">
                <li v-if="profile.github_url"><IconButton icon="github" label="GitHub profile" :href="profile.github_url" /></li>
                <li v-if="profile.linkedin_url"><IconButton icon="linkedin" label="LinkedIn profile" :href="profile.linkedin_url" /></li>
                <li v-if="profile.email"><IconButton icon="mail" label="Send an email" :href="`mailto:${profile.email}`" /></li>
            </ul>
        </div>
    </footer>
</template>
