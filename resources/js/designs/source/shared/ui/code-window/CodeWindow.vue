<script setup lang="ts">
import type { CodeLine } from './types';

/**
 * Editor pane showing a few lines of syntax-coloured code. The code is
 * decorative: `label` gives the figure an accessible name, and the default
 * slot (the footer) stays readable.
 *
 * `lines` is an array of lines; each line is an array of tokens
 * `{ text, kind }` where kind is keyword | string | literal | undefined.
 */
defineProps<{ filename: string; lines: readonly CodeLine[]; label: string }>();
</script>

<template>
    <figure class="code-window" :aria-label="label">
        <div class="code-window__bar" aria-hidden="true">
            <span class="code-window__dots"><span></span><span></span><span></span></span>{{ filename }}
        </div>
        <div class="code-window__body" aria-hidden="true">
            <template v-for="(line, index) in lines" :key="index">
                <span class="code-window__ln">{{ index + 1 }}</span>
                <span><span v-for="(token, t) in line" :key="t" :class="token.kind ? `tok-${token.kind}` : null">{{ token.text }}</span></span>
            </template>
        </div>
        <figcaption v-if="$slots.default" class="code-window__footer">
            <slot></slot>
        </figcaption>
    </figure>
</template>
