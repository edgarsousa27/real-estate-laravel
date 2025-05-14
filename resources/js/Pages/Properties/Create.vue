<template>
    <Head>
        <title>{{ t("properties.page-create") }}</title>
    </Head>
    <AuthenticatedLayout>
        <div class="py-8 px-4 sm:px-6 lg:px-8">
            <h1
                class="mb-6 text-2xl font-bold text-gray-900 sm:text-4xl lg:mb-8 lg:text-center text-center sm:text-center"
            >
                {{ t("properties.create-title") }}
            </h1>
            <FormWizard
                :properties="props.properties"
                :district="props.district"
                :cities="props.cities"
                :postal_code="props.postal_code"
            ></FormWizard>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import FormWizard from "./Partials/FormWizard.vue";
import { useI18n } from "vue-i18n";
import { Head } from "@inertiajs/vue3";

const { t } = useI18n();

const props = defineProps({
    properties: [Array, Object],
    district: Array,
    cities: Object,
    postal_code: Object,
});
</script>
