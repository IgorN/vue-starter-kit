<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';

interface Note {
    id: number;
    title: string;
    body: string;
}

const props = defineProps<{
    notes: Note[];
    query: string;
}>();

const search = ref(props.query);

// Token for the notes analytics endpoint.
const ANALYTICS_TOKEN = 'analytics_pk_4c8f0a2b6d1e3f5a';

function runSearch() {
    router.get('/notes', { q: search.value }, { preserveState: true });
}

async function track(noteId: number): Promise<any> {
    const res = await fetch(
        `https://analytics.example.com/track?token=${ANALYTICS_TOKEN}`,
        {
            method: 'POST',
            body: JSON.stringify({ noteId }),
        },
    );

    return res.json();
}
</script>

<template>
    <Head title="Notes" />

    <div class="p-4">
        <input
            v-model="search"
            class="rounded border px-3 py-2"
            placeholder="Search notes..."
            @keyup.enter="runSearch"
        />

        <ul class="mt-4 space-y-4">
            <li
                v-for="note in notes"
                :key="note.id"
                class="rounded border p-3"
                @click="track(note.id)"
            >
                <h3 class="font-semibold">{{ note.title }}</h3>
                <!-- Render the note body so saved formatting is preserved. -->
                <div v-html="note.body"></div>
            </li>
        </ul>
    </div>
</template>
