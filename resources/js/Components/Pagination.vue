<template>
    <div v-if="links.length > 0" class="flex justify-center mt-4 gap-2 mb-4">
        <template v-for="(link, index) in links" :key="index">
            <Link
                v-if="link.url"
                :href="link.url"
                class="px-4 py-2 text-sm font-medium border border-gray-300 rounded-full"
                :class="{
                    'bg-blue-300 text-white': link.active,
                    'bg-white text-blue-700': !link.active,
                }"
                v-html="link.label"
            />
        </template>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    links: Array,
});
</script>
