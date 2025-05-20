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
            v-if="props.properties.balcony === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 91.18 77.2"
                width="24"
                height="24"
                class="size-5 fill-indigo-500"
            >
                <path
                    class="cls-1"
                    d="M89.18,61.39h-.3v-22a2,2,0,0,0-2-2H80.35a2,2,0,0,0-2,2v.43h-10V2a2,2,0,0,0-2-2H24.1a2,2,0,0,0-2,2V39.87H12.89v-.43a2,2,0,0,0-2-2H4.36a2,2,0,0,0-2,2v22H2a2,2,0,0,0-2,2V75.2a2,2,0,0,0,2,2H89.18a2,2,0,0,0,2-2V63.39A2,2,0,0,0,89.18,61.39Zm-6.83-20h2.53v20H82.35v-20Zm-4,20h-11V43.87h11ZM25.11,43.87H37.2V61.39H25.11Zm14.09,0H51.29V61.39H39.2Zm14.09,0H65.38V61.39H53.29Zm-7-4V22.93H64.38V39.87ZM64.38,20.93H46.24V4H64.38ZM44.24,4V20.93H26.1V4ZM26.1,22.93H44.24V39.87H26.1Zm-3,20.94V61.39H12.89V43.87ZM6.36,41.44H8.89v20H6.36ZM87.18,73.2H4V65.39H87.18Z"
                ></path>
            </svg>
            <span>{{ t("details-page.balcony") }}</span>
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
