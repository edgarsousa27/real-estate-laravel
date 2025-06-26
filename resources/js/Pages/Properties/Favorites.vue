<template>
    <Head>
        <title>{{ t("favorites.title") }}</title>
    </Head>
    <AuthenticatedLayout>
        <div class="py-8 px-4 sm:px-6 lg:px-8">
            <h1
                class="mb-6 text-2xl font-bold text-gray-900 sm:text-4xl lg:mb-8 lg:text-center text-center sm:text-center"
            >
                {{ t("favorites.title") }} ({{ props.favorites.length }})
            </h1>
            <p class="text-gray-500 text-center" v-if="!props.favorites.length">
                {{ t("favorites.text") }}
            </p>
            <h1
                v-if="props.favorites.length"
                class="px-4 sm:px-4 lg:px-4 max-w-6xl max-h-6xl mx-auto text-xl"
            >
                {{ t("properties.page") }}
            </h1>
            <Properties
                :properties="props.properties.data"
                :categories="props.categories"
                :favorites="props.favorites"
            />
            <Pagination
                v-if="props.favorites.length"
                :links="props.properties.links"
            />
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import Properties from "@/Components/Properties.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";

const { t } = useI18n();

const props = defineProps({
    properties: [Array, Object],
    categories: Array,
    favorites: Array,
});
</script>
