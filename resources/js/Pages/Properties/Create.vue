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
            <CreatePropertyForm :properties="properties"></CreatePropertyForm>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/layouts/AuthenticatedLayout.vue";
import CreatePropertyForm from "./Partials/CreatePropertyForm.vue";
import { useI18n } from "vue-i18n";
import { Head } from "@inertiajs/vue3";

const { t } = useI18n();

defineProps({
    properties: [Array, Object],
});
</script>
