<template>
    <Head>
        <title>{{ t("properties.page") }}</title>
    </Head>
    <DefaultLayout>
        <div class="py-8 px-4 sm:px-6 lg:px-8">
            <h1
                class="mb-6 text-2xl font-bold text-gray-900 sm:text-4xl lg:mb-8 lg:text-center text-center sm:text-center"
            >
                {{ t("properties.title") }}
            </h1>
            <div
                class="px-2 max-w-6xl max-h-5xl mx-auto flex justify-left items-center gap-3"
            >
                <Count
                    :count="props.count"
                    class="text-lg font-bold text-blue-500"
                />
                <Sort />
            </div>

            <Properties
                :properties="props.properties.data"
                :categories="props.categories"
            />
            <Pagination :links="props.properties.links" />
        </div>
    </DefaultLayout>
</template>

<script setup>
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import Properties from "@/Components/Properties.vue";
import Sort from "@/Components/Sort.vue";
import Count from "@/Components/Count.vue";
import Pagination from "@/Components/Pagination.vue";
import { useI18n } from "vue-i18n";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    properties: [Array, Object],
    categories: Array,
    count: Number,
});
const { t } = useI18n();
</script>
