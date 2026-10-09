<script setup>
import { Head } from '@inertiajs/vue3';
import { formatPeriod, formatYear } from '../lib/format';

defineProps({
    companies: { type: Array, required: true },
    institutes: { type: Array, required: true },
    otherPrograms: { type: Array, required: true },
    certificates: { type: Array, required: true },
    awards: { type: Array, required: true },
});
</script>

<template>
    <div class="page">
        <Head title="Experience" />
        <h1>Experience</h1>
        <section aria-labelledby="work-title">
            <h2 id="work-title">Work</h2>
            <article v-for="company in companies" :key="company.id">
                <h3>{{ company.name }}</h3>
                <p>{{ company.city }}, {{ company.country }}</p>
                <ol>
                    <li v-for="position in company.positions" :key="position.id">
                        <h4>{{ position.title }}</h4>
                        <p>{{ formatPeriod(position) }}</p>
                        <div v-html="position.descriptionHtml" />
                    </li>
                </ol>
            </article>
        </section>
        <section aria-labelledby="education-title">
            <h2 id="education-title">Education</h2>
            <article v-for="institute in institutes" :key="institute.id">
                <h3>{{ institute.name }}</h3>
                <p v-for="program in institute.programs" :key="program.id">{{ program.name }} · {{ program.period }}</p>
            </article>
            <ul>
                <li v-for="program in otherPrograms" :key="program.id">{{ program.name }}</li>
            </ul>
        </section>
        <section aria-labelledby="certificates-title">
            <h2 id="certificates-title">Certifications</h2>
            <ul>
                <li v-for="certificate in certificates" :key="certificate.id">
                    <a v-if="certificate.url" :href="certificate.url">{{ certificate.title }}</a>
                    <span v-else>{{ certificate.title }}</span>
                    · {{ certificate.issuedBy }}
                </li>
            </ul>
        </section>
        <section aria-labelledby="awards-title">
            <h2 id="awards-title">Awards</h2>
            <article v-for="award in awards" :key="award.id">
                <h3>{{ award.title }}</h3>
                <p>{{ award.subtitle }} · {{ formatYear(award.issueDate) }}</p>
            </article>
        </section>
    </div>
</template>
