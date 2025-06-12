<template>
    <div class="pb-16 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center text-2xl text-gray-900 mb-12">
                <span class="font-bold">{{ t("last-properties.title") }}</span>
                {{ t("last-properties.subtitle") }}
            </div>
            <PropertiesHorizontal
                :properties="props.properties"
                :categories="props.categories"
                :favorites="props.favorites"
            />
        </div>
    </div>
</template>

<script setup>
import { useI18n } from "vue-i18n";
import PropertiesHorizontal from "@/Components/PropertiesHorizontal.vue";
const { t } = useI18n();

const props = defineProps({
    properties: Array,
    categories: Array,
    favorites: Array,
});
</script>
