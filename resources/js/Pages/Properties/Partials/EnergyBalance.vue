<template>
    <h1 class="text-xl font-semibold mb-4 mt-4 ml-3">
        {{ t("details-page.energy-balance") }}
    </h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <!-- Energy Consumption -->
        <div class="overflow-x-auto">
            <h1 class="text-lg font-semibold mt-4 ml-3">
                {{ t("details-page.energy-consumption") }}
            </h1>
            <div class="text-center gap-1 items-start mb-4 mt-4 ml-3">
                <ul class="flex text-white gap-1 min-w-max">
                    <li
                        v-for="(grade, index) in energyGrades"
                        :key="index"
                        class="relative flex flex-col items-center"
                    >
                        <div
                            class="rounded-lg w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center"
                            :class="[
                                grade.bgColor,
                                {
                                    'py-6 sm:py-6': isEnergyGradeActive(index),
                                },
                            ]"
                        >
                            {{ grade.label }}
                        </div>
                        <div
                            v-if="isEnergyGradeActive(index)"
                            class="top-full mt-1 flex flex-col items-center text-black"
                        >
                            <font-awesome-icon icon="sort-up" class="text-xs" />
                            <strong class="text-sm">
                                {{ props.properties.energy_consumption }}
                            </strong>
                            <p class="text-tiny">kWh/m²</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Gas Emission -->
        <div class="overflow-x-auto">
            <h1 class="text-lg font-semibold mb-4 mt-4 ml-3">
                {{ t("details-page.gas-emission") }}
            </h1>
            <div class="flex text-center gap-1 items-start mb-4 mt-4 ml-3">
                <ul class="flex text-white gap-1 min-w-max">
                    <li
                        v-for="(grade, index) in gasGrades"
                        :key="index"
                        class="relative flex flex-col items-center"
                    >
                        <div
                            class="rounded-lg w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center"
                            :class="[
                                grade.bgColor,
                                {
                                    'py-6 sm:py-6': isGasGradeActive(index),
                                },
                            ]"
                        >
                            {{ grade.label }}
                        </div>
                        <div
                            v-if="isGasGradeActive(index)"
                            class="top-full mt-1 flex flex-col items-center text-black"
                        >
                            <font-awesome-icon icon="sort-up" class="text-xs" />
                            <strong class="text-sm">
                                {{ props.properties.gas_emission }}
                            </strong>
                            <p class="text-tiny">kgCO₂/m²</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useI18n } from "vue-i18n";

const { t } = useI18n();

const props = defineProps({
    properties: Object,
});

const energyGrades = [
    { label: "A+", max: 45, bgColor: "bg-emerald-400" },
    { label: "A", min: 45, max: 80, bgColor: "bg-emerald-500" },
    { label: "B", min: 80, max: 130, bgColor: "bg-lime-400" },
    { label: "C", min: 130, max: 200, bgColor: "bg-yellow-400" },
    { label: "D", min: 200, max: 260, bgColor: "bg-orange-400" },
    { label: "E", min: 260, max: 320, bgColor: "bg-orange-600" },
    { label: "F", min: 320, bgColor: "bg-red-600" },
];

const gasGrades = [
    { label: "A+", max: 4, bgColor: "bg-emerald-400" },
    { label: "A", min: 4, max: 6, bgColor: "bg-emerald-500" },
    { label: "B", min: 6, max: 10, bgColor: "bg-lime-400" },
    { label: "C", min: 10, max: 15, bgColor: "bg-yellow-400" },
    { label: "D", min: 15, max: 25, bgColor: "bg-orange-400" },
    { label: "E", min: 25, max: 35, bgColor: "bg-orange-600" },
    { label: "F", min: 35, max: 55, bgColor: "bg-red-600" },
    { label: "G", min: 55, bgColor: "bg-red-800" },
];

const isEnergyGradeActive = (index) => {
    const value = props.properties.energy_consumption;
    const grade = energyGrades[index];

    if (index === 0 && value <= grade.max) return true;
    if (index === energyGrades.length - 1 && value > grade.min) return true;
    return value > grade.min && value <= grade.max;
};

const isGasGradeActive = (index) => {
    const value = props.properties.gas_emission;
    const grade = gasGrades[index];

    if (index === 0 && value <= grade.max) return true;
    if (index === gasGrades.length - 1 && value > grade.min) return true;
    return value > grade.min && value <= grade.max;
};
</script>
