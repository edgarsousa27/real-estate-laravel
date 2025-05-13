<template>
    <Head title="My Properties" />

    <AuthenticatedLayout>
        <div class="py-8 px-4 sm:px-6 lg:px-8">
            <h1
                class="mb-6 text-2xl font-bold text-gray-900 sm:text-4xl lg:mb-8 lg:text-center text-center sm:text-center"
            >
                {{ t("authenticated.my-properties") }}
            </h1>
            <MyProperties
                :properties="props.properties.data"
                :categories="props.categories"
                :district="props.district"
                :cities="props.cities"
                :postal_code="props.postal_code"
            />
            <Pagination :links="props.properties.links" />
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import MyProperties from "@/Components/MyProperties.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import { useI18n } from "vue-i18n";
import { Head } from "@inertiajs/vue3";

const { t } = useI18n();

const props = defineProps({
    properties: [Array, Object],
    categories: Array,
    district: Array,
    cities: Object,
    postal_code: Object,
});
</script>
