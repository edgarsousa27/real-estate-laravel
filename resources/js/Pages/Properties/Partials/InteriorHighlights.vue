<template>
    <h1 class="text-xl font-semibold mb-4 mt-4 ml-3">
        {{ t("details-page.interior") }}
    </h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        <div
            v-if="props.properties.heating === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon
                icon="temperature-high"
                class="size-5 text-indigo-500"
            />
            <span>{{ t("details-page.heating") }}</span>
        </div>
        <div
            v-if="props.properties.cooling === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon
                icon="snowflake"
                class="size-5 text-indigo-500"
            />
            <span>{{ t("details-page.cooling") }}</span>
        </div>
        <div
            v-if="props.properties.double_glazing === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon icon="clone" class="size-5 text-indigo-500" />
            <span>{{ t("details-page.double_glazing") }}</span>
        </div>
        <div
            v-if="props.properties.kitchen_equipped === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon icon="utensils" class="size-5 text-indigo-500" />
            <span>{{ t("details-page.kitchen_equipped") }}</span>
        </div>
        <div
            v-if="props.properties.fire_alarm_system === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon icon="fire" class="size-5 text-indigo-500" />
            <span>{{ t("details-page.fire_alarm_system") }}</span>
        </div>
        <div
            v-if="props.properties.fireplace === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon
                icon="fire-burner"
                class="size-5 text-indigo-500"
            />
            <span>{{ t("details-page.fireplace") }}</span>
        </div>
        <div
            v-if="props.properties.furnished === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon icon="couch" class="size-5 text-indigo-500" />
            <span>{{ t("details-page.furnished") }}</span>
        </div>
        <div
            v-if="props.properties.smart_home === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon
                icon="house-signal"
                class="size-5 text-indigo-500"
            />
            <span>{{ t("details-page.smart_home") }}</span>
        </div>
        <div
            v-if="props.properties.storage === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon
                icon="jar-wheat"
                class="size-5 text-indigo-500"
            />
            <span>{{ t("details-page.storage") }}</span>
        </div>
        <div
            v-if="props.properties.building_gym === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon icon="dumbbell" class="size-5 text-indigo-500" />
            <span>{{ t("details-page.building_gym") }}</span>
        </div>
        <div
            v-if="props.properties.building_pool === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon
                icon="water-ladder"
                class="size-5 text-indigo-500"
            />
            <span>{{ t("details-page.building_pool") }}</span>
        </div>

        <div
            v-if="props.properties.wheelchair_access === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon
                icon="wheelchair"
                class="size-5 text-indigo-500"
            />
            <span>{{ t("details-page.wheelchair_access") }}</span>
        </div>
        <div
            v-if="props.properties.elevator === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon icon="elevator" class="size-5 text-indigo-500" />
            <span>{{ t("details-page.elevator") }}</span>
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
