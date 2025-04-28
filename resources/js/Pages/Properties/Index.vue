<template>
    <!-- <div class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto"> -->
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <h1
            class="mt-8 mb-6 text-2xl font-bold text-gray-900 sm:text-4xl lg:mb-8 lg:text-center text-center sm:text-center"
        >
            {{ t("properties-title") }}
        </h1>
        <Properties :properties="props.properties" />
    </div>
</template>

<script setup>
import Properties from "@/Components/Properties.vue";
import { useI18n } from "vue-i18n";

const props = defineProps(["properties"]);
const { t } = useI18n();
</script>
