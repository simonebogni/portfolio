import js from '@eslint/js';
import boundaries from 'eslint-plugin-boundaries';
import vue from 'eslint-plugin-vue';
import globals from 'globals';
import tseslint from 'typescript-eslint';

/*
 * Feature-Sliced Design (docs/frontend.md)
 *
 * resources/js/app       Inertia bootstrap
 * resources/js/core      logic shared by every design, no markup or CSS:
 *                        shared → entities → features
 * resources/js/designs   one UI per design, each its own FSD tree:
 *                        shared → entities → features → widgets → pages → app
 *
 * A layer imports only from the layers below it, never from another slice of
 * its own layer, never from another design, and only through a slice's
 * public API (its index.ts). core never imports a design.
 */

/**
 * Code not yet moved into the FSD layers. Each design leaves this list when it is migrated.
 * TODO(fsd): empty this list, then delete it.
 */
const LEGACY = [
    ...['source', 'bento', 'terrain', 'kinetic', 'blueprint'].flatMap((design) =>
        ['components', 'composables', 'lib', 'layouts', 'pages'].map((folder) => `resources/js/designs/${design}/${folder}/**`),
    ),
];

const LAYERS = ['shared', 'entities', 'features', 'widgets', 'pages', 'app'];

/** Every layer below `layer` in a design, in FSD order. */
const below = (layer) => LAYERS.slice(0, LAYERS.indexOf(layer));

/** The core layers a design layer may use. */
const CORE_FOR = {
    shared: ['core-shared'],
    entities: ['core-shared', 'core-entities'],
    features: ['core-shared', 'core-entities', 'core-features'],
    widgets: ['core-shared', 'core-entities', 'core-features'],
    pages: ['core-shared', 'core-entities', 'core-features'],
    app: ['core-shared', 'core-entities', 'core-features'],
};

/** Element types made of slices, which other elements use through their index.ts only. */
const SLICED = new Set(['core-entities', 'core-features', 'design-entities', 'design-features', 'design-widgets', 'design-pages']);

/**
 * A target another element may import: the whole element for non-sliced types, the slice's
 * index.ts for sliced ones. Imports inside one element (a slice's own files) are not checked.
 */
function target(type, captured) {
    return {
        type,
        ...(captured ? { captured } : {}),
        ...(SLICED.has(type) ? { fileInternalPath: 'index.ts' } : {}),
    };
}

const SAME_DESIGN = { design: '{{ from.captured.design }}' };

/** A design layer may import the lower layers of its own design and the core layers listed in CORE_FOR. */
function designLayerPolicy(layer) {
    return {
        from: { element: { type: `design-${layer}` } },
        allow: {
            to: {
                element: [
                    ...below(layer).map((lower) => target(`design-${lower}`, SAME_DESIGN)),
                    ...CORE_FOR[layer].map((type) => target(type)),
                ],
            },
        },
    };
}

export default tseslint.config(
    {
        ignores: ['public/**', 'vendor/**', 'bootstrap/ssr/**', 'node_modules/**', 'storage/**', ...LEGACY],
    },
    js.configs.recommended,
    ...tseslint.configs.recommended,
    ...vue.configs['flat/recommended'],
    {
        files: ['**/*.vue'],
        languageOptions: {
            parserOptions: { parser: tseslint.parser, extraFileExtensions: ['.vue'] },
        },
    },
    {
        files: ['resources/js/**/*.{ts,vue}'],
        languageOptions: {
            globals: globals.browser,
        },
        rules: {
            // Prettier-like formatting is not enforced; the templates follow their own readable layout.
            'vue/max-attributes-per-line': 'off',
            'vue/singleline-html-element-content-newline': 'off',
            'vue/html-self-closing': ['warn', { html: { void: 'always', normal: 'never', component: 'always' } }],
            // Design components are namespaced by their folder (e.g. shared/ui/Icon.vue).
            'vue/multi-word-component-names': 'off',
            // Rich text written by the site owner in the admin panel is rendered as HTML on purpose.
            'vue/no-v-html': 'off',
            '@typescript-eslint/consistent-type-imports': ['error', { fixStyle: 'inline-type-imports' }],
        },
    },
    {
        files: ['resources/js/**/*.{ts,vue}'],
        plugins: { boundaries },
        settings: {
            'import/resolver': {
                typescript: { project: './tsconfig.json' },
            },
            'boundaries/include': ['resources/js/**/*'],
            'boundaries/elements': [
                { type: 'app', pattern: 'resources/js/app' },
                { type: 'core-shared', pattern: 'resources/js/core/shared' },
                { type: 'core-entities', pattern: 'resources/js/core/entities/*', capture: ['slice'] },
                { type: 'core-features', pattern: 'resources/js/core/features/*', capture: ['slice'] },
                { type: 'design-shared', pattern: 'resources/js/designs/*/shared', capture: ['design'] },
                { type: 'design-app', pattern: 'resources/js/designs/*/app', capture: ['design'] },
                ...['entities', 'features', 'widgets', 'pages'].map((layer) => ({
                    type: `design-${layer}`,
                    pattern: `resources/js/designs/*/${layer}/*`,
                    capture: ['design', 'slice'],
                })),
            ],
        },
        rules: {
            'boundaries/dependencies': [
                'error',
                {
                    default: 'disallow',
                    policies: [
                        // The bootstrap resolves the pages and layouts of every design.
                        {
                            from: { element: { type: 'app' } },
                            allow: { to: { element: [...SLICED, 'core-shared', 'design-shared', 'design-app'].map((type) => target(type)) } },
                        },
                        { from: { element: { type: 'core-entities' } }, allow: { to: { element: [target('core-shared')] } } },
                        {
                            from: { element: { type: 'core-features' } },
                            allow: { to: { element: [target('core-shared'), target('core-entities')] } },
                        },
                        ...LAYERS.map(designLayerPolicy),
                    ],
                },
            ],
            // Every file belongs to a layer.
            'boundaries/no-unknown-files': 'error',
        },
    },
    {
        files: ['resources/js/**/*.test.ts'],
        rules: {
            // Tests define small throwaway components inline.
            'vue/one-component-per-file': 'off',
        },
    },
    {
        files: ['*.{js,ts}'],
        languageOptions: { globals: globals.node },
    },
);
