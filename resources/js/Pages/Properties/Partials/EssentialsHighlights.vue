<template>
    <h1 class="text-xl font-semibold mb-4 mt-4 ml-3">
        {{ t("details-page.essential") }}
    </h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        <div
            v-if="
                props.properties.category_id === 1 ||
                props.properties.category_id === 2
            "
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon
                icon="ruler-combined"
                class="size-5 text-indigo-500"
            />
            <span class="text-gray-700"
                >{{ t("details-page.area") }}
                {{ props.properties.square_meters + " ㎡" }}</span
            >
        </div>
        <div
            v-if="props.properties.category_id === 3"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon icon="mountain" class="size-5 text-indigo-500" />
            <span class="text-gray-700"
                >{{ t("details-page.land") }}
                {{ props.properties.square_meters + " ㎡" }}</span
            >
        </div>
        <div
            v-if="
                props.properties.category_id === 1 ||
                props.properties.category_id === 2
            "
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon icon="bed" class="size-5 text-indigo-500" />

            <span class="text-gray-700" v-if="props.properties.bedrooms == 1">
                {{ props.properties.bedrooms }}
                {{ t("details-page.bedroom") }}</span
            >
            <span class="text-gray-700" v-else>
                {{ props.properties.bedrooms }}
                {{ t("details-page.bedrooms") }}</span
            >
        </div>

        <div
            v-if="
                props.properties.category_id === 1 ||
                props.properties.category_id === 2
            "
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon icon="bath" class="size-5 text-indigo-500" />
            <span class="text-gray-700" v-if="props.properties.bathrooms == 1">
                {{ props.properties.bathrooms }}
                {{ t("details-page.bathroom") }}</span
            >
            <span class="text-gray-700" v-else>
                {{ props.properties.bathrooms }}
                {{ t("details-page.bathrooms") }}</span
            >
        </div>

        <div
            v-if="props.properties.well_water === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon icon="droplet" class="size-5 text-indigo-500" />
            <span class="text-gray-700">{{
                t("details-page.well-water")
            }}</span>
        </div>
        <div
            v-if="props.properties.electricity === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon icon="plug" class="size-5 text-indigo-500" />
            <span class="text-gray-700">{{
                t("details-page.eletricity")
            }}</span>
        </div>
    </div>
</template>

<script setup>
import { useI18n } from "vue-i18n";
const { t } = useI18n();

const props = defineProps({
    properties: Object,
});
</script>
