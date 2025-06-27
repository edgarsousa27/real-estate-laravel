<template>
    <Head :title="`${t('favorites.title')} (${props.favorites.length})`" />
    <AdminLayout :title="t('favorites.title')">
        <div class="py-8 px-4 sm:px-6 lg:px-8">
            <h1
                class="mb-6 text-2xl font-bold text-gray-900 sm:text-3xl lg:mb-8 lg:text-center text-center sm:text-center"
            >
                {{ t("favorites.title") }} ({{ props.favorites.length }})
            </h1>
            <div class="text-center" v-if="!props.favorites.length">
                <p class="font-bold">
                    {{ t("favorites.text") }}
                </p>
                <p class="text-gray-500">
                    {{ t("favorites.text2") }}
                </p>
                <Link :href="route('welcome')">
                    <PrimaryButton
                        class="mt-5 bg-green-500 hover:bg-green-600"
                        >{{ t("carousel.search") }}</PrimaryButton
                    >
                </Link>
            </div>
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
    </AdminLayout>
</template>

<script setup>
import Properties from "@/Components/Properties.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, Link } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const { t } = useI18n();

const props = defineProps({
    properties: [Array, Object],
    categories: Array,
    favorites: Array,
});
</script>
