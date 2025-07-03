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
                                {{ grade.label }}
                            </strong>
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
    { label: "A+", bgColor: "bg-emerald-400" },
    { label: "A", bgColor: "bg-emerald-500" },
    { label: "B", bgColor: "bg-lime-400" },
    { label: "C", bgColor: "bg-yellow-400" },
    { label: "D", bgColor: "bg-orange-400" },
    { label: "E", bgColor: "bg-orange-600" },
    { label: "F", bgColor: "bg-red-600" },
];

const isEnergyGradeActive = (index) => {
    const value = props.properties.energy_consumption;
    const grade = energyGrades[index];

    return grade.label === value;
};
</script>
