<template>
    <h1 class="text-xl font-semibold mb-4 mt-4 ml-3">
        {{ t("details-page.outside") }}
    </h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        <div
            v-if="props.properties.garden === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon icon="tree" class="size-5 text-indigo-500" />
            <span>{{ t("details-page.garden") }}</span>
        </div>
        <div
            v-if="props.properties.terrace === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon icon="sun" class="size-5 text-indigo-500" />
            <span>{{ t("details-page.terrace") }}</span>
        </div>
        <div
            v-if="props.properties.swimming_pool === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon
                icon="water-ladder"
                class="size-5 text-indigo-500"
            />
            <span>{{ t("details-page.swimming_pool") }}</span>
        </div>
        <div
            v-if="props.properties.sea_view === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon icon="water" class="size-5 text-indigo-500" />
            <span>{{ t("details-page.sea_view") }}</span>
        </div>
        <div
            v-if="props.properties.mountain_view === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon
                icon="mountain-sun"
                class="size-5 text-indigo-500"
            />
            <span>{{ t("details-page.mountain_view") }}</span>
        </div>
        <div
            v-if="props.properties.solar_panels === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon
                icon="solar-panel"
                class="size-5 text-indigo-500"
            />
            <span>{{ t("details-page.solar_panels") }}</span>
        </div>

        <div
            v-if="props.properties.garage === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon
                icon="warehouse"
                class="size-5 text-indigo-500"
            />
            <span>{{ t("details-page.garage") }}</span>
        </div>

        <div
            v-if="props.properties.parking_spaces === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon
                icon="square-parking"
                class="size-5 text-indigo-500"
            />
            <span
                >{{ props.properties.parking_spaces }}
                {{ t("details-page.parking_spaces") }}</span
            >
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
