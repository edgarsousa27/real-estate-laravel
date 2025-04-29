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
            <Properties :properties="props.properties" />
        </div>
    </DefaultLayout>
</template>

<script setup>
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import Properties from "@/Components/Properties.vue";
import { useI18n } from "vue-i18n";
import { Head } from "@inertiajs/vue3";

const props = defineProps(["properties"]);
const { t } = useI18n();
</script>
