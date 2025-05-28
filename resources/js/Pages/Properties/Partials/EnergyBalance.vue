<template>
    <h1 class="text-xl font-semibold mb-4 mt-4 ml-3">
        {{ t("details-page.energy-balance") }}
    </h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <h1 class="text-lg font-semibold mt-4 ml-3">
                {{ t("details-page.energy-consumption") }}
            </h1>
            <div class="text-center gap-1 items-start mb-4 mt-4 ml-3">
                <ul class="flex text-white gap-1">
                    <li class="relative flex flex-col items-center">
                        <div
                            class="bg-emerald-400 rounded-lg w-10 h-10 flex items-center justify-center"
                            :class="{
                                'py-6':
                                    props.properties.energy_consumption <= 45,
                            }"
                        >
                            A+
                        </div>
                        <div
                            v-if="props.properties.energy_consumption <= 45"
                            class="top-full mt-1 flex flex-col items-center text-black"
                        >
                            <font-awesome-icon icon="sort-up" class="text-xs" />
                            <strong class="text-sm">
                                {{ props.properties.energy_consumption }}
                            </strong>
                            <p class="text-tiny">kWh/m²</p>
                        </div>
                    </li>

                    <li class="relative flex flex-col items-center">
                        <div
                            class="bg-emerald-500 rounded-lg w-10 h-10 flex items-center justify-center"
                            :class="{
                                'py-6':
                                    props.properties.energy_consumption > 45 &&
                                    props.properties.energy_consumption <= 80,
                            }"
                        >
                            A
                        </div>
                        <div
                            v-if="
                                props.properties.energy_consumption > 45 &&
                                props.properties.energy_consumption <= 80
                            "
                            class="top-full mt-1 flex flex-col items-center text-black"
                        >
                            <font-awesome-icon icon="sort-up" class="text-xs" />
                            <strong class="text-sm">
                                {{ props.properties.energy_consumption }}
                            </strong>
                            <p class="text-tiny">kWh/m²</p>
                        </div>
                    </li>
                    <li class="relative flex flex-col items-center">
                        <div
                            class="bg-lime-400 rounded-lg w-10 h-10 flex items-center justify-center"
                            :class="{
                                'py-6':
                                    props.properties.energy_consumption > 80 &&
                                    props.properties.energy_consumption <= 130,
                            }"
                        >
                            B
                        </div>
                        <div
                            v-if="
                                props.properties.energy_consumption > 80 &&
                                props.properties.energy_consumption <= 130
                            "
                            class="top-full mt-1 flex flex-col items-center text-black"
                        >
                            <font-awesome-icon icon="sort-up" class="text-xs" />
                            <strong class="text-sm">
                                {{ props.properties.energy_consumption }}
                            </strong>
                            <p class="text-tiny">kWh/m²</p>
                        </div>
                    </li>
                    <li class="relative flex flex-col items-center">
                        <div
                            class="bg-yellow-400 rounded-lg w-10 h-10 flex items-center justify-center"
                            :class="{
                                'py-6':
                                    props.properties.energy_consumption > 130 &&
                                    props.properties.energy_consumption <= 200,
                            }"
                        >
                            C
                        </div>
                        <div
                            v-if="
                                props.properties.energy_consumption > 130 &&
                                props.properties.energy_consumption <= 200
                            "
                            class="top-full mt-1 flex flex-col items-center text-black"
                        >
                            <font-awesome-icon icon="sort-up" class="text-xs" />
                            <strong class="text-sm">
                                {{ props.properties.energy_consumption }}
                            </strong>
                            <p class="text-tiny">kWh/m²</p>
                        </div>
                    </li>
                    <li class="relative flex flex-col items-center">
                        <div
                            class="bg-orange-400 rounded-lg w-10 h-10 flex items-center justify-center"
                            :class="{
                                'py-6':
                                    props.properties.energy_consumption > 200 &&
                                    props.properties.energy_consumption <= 260,
                            }"
                        >
                            D
                        </div>
                        <div
                            v-if="
                                props.properties.energy_consumption > 200 &&
                                props.properties.energy_consumption <= 260
                            "
                            class="top-full mt-1 flex flex-col items-center text-black"
                        >
                            <font-awesome-icon icon="sort-up" class="text-xs" />
                            <strong class="text-sm">
                                {{ props.properties.energy_consumption }}
                            </strong>
                            <p class="text-tiny">kWh/m²</p>
                        </div>
                    </li>
                    <li class="relative flex flex-col items-center">
                        <div
                            class="bg-orange-600 rounded-lg w-10 h-10 flex items-center justify-center"
                            :class="{
                                'py-6':
                                    props.properties.energy_consumption > 260 &&
                                    props.properties.energy_consumption <= 320,
                            }"
                        >
                            E
                        </div>
                        <div
                            v-if="
                                props.properties.energy_consumption > 260 &&
                                props.properties.energy_consumption <= 320
                            "
                            class="top-full mt-1 flex flex-col items-center text-black"
                        >
                            <font-awesome-icon icon="sort-up" class="text-xs" />
                            <strong class="text-sm">
                                {{ props.properties.energy_consumption }}
                            </strong>
                            <p class="text-tiny">kWh/m²</p>
                        </div>
                    </li>
                    <li class="relative flex flex-col items-center">
                        <div
                            class="bg-red-600 rounded-lg w-10 h-10 flex items-center justify-center"
                            :class="{
                                'py-6':
                                    props.properties.energy_consumption > 320,
                            }"
                        >
                            F
                        </div>
                        <div
                            v-if="props.properties.energy_consumption > 320"
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

        <div>
            <h1 class="text-lg font-semibold mb-4 mt-4 ml-3">
                {{ t("details-page.gas-emission") }}
            </h1>
            <div class="flex text-center gap-1 items-start mb-4 mt-4 ml-3">
                <ul class="flex text-white gap-1">
                    <li class="relative flex flex-col items-center">
                        <div
                            class="bg-emerald-400 rounded-lg w-10 h-10 flex items-center justify-center"
                            :class="{
                                'py-6': props.properties.gas_emission <= 4,
                            }"
                        >
                            A+
                        </div>
                        <div
                            v-if="props.properties.gas_emission <= 4"
                            class="top-full mt-1 flex flex-col items-center text-black"
                        >
                            <font-awesome-icon icon="sort-up" class="text-xs" />
                            <strong class="text-sm">
                                {{ props.properties.gas_emission }}
                            </strong>
                            <p class="text-tiny">kgCO₂/m²</p>
                        </div>
                    </li>
                    <li class="relative flex flex-col items-center">
                        <div
                            class="bg-emerald-500 rounded-lg w-10 h-10 flex items-center justify-center"
                            :class="{
                                'py-6':
                                    props.properties.gas_emission > 4 &&
                                    props.properties.gas_emission <= 6,
                            }"
                        >
                            A
                        </div>
                        <div
                            v-if="
                                props.properties.gas_emission > 4 &&
                                props.properties.gas_emission <= 6
                            "
                            class="top-full mt-1 flex flex-col items-center text-black"
                        >
                            <font-awesome-icon icon="sort-up" class="text-xs" />
                            <strong class="text-sm">
                                {{ props.properties.gas_emission }}
                            </strong>
                            <p class="text-tiny">kgCO₂/m²</p>
                        </div>
                    </li>
                    <li class="relative flex flex-col items-center">
                        <div
                            class="bg-lime-400 rounded-lg w-10 h-10 flex items-center justify-center"
                            :class="{
                                'py-6':
                                    props.properties.gas_emission > 6 &&
                                    props.properties.gas_emission <= 10,
                            }"
                        >
                            B
                        </div>
                        <div
                            v-if="
                                props.properties.gas_emission > 6 &&
                                props.properties.gas_emission <= 10
                            "
                            class="top-full mt-1 flex flex-col items-center text-black"
                        >
                            <font-awesome-icon icon="sort-up" class="text-xs" />
                            <strong class="text-sm">
                                {{ props.properties.gas_emission }}
                            </strong>
                            <p class="text-tiny">kgCO₂/m²</p>
                        </div>
                    </li>
                    <li class="relative flex flex-col items-center">
                        <div
                            class="bg-yellow-400 rounded-lg w-10 h-10 flex items-center justify-center"
                            :class="{
                                'py-6':
                                    props.properties.gas_emission > 10 &&
                                    props.properties.gas_emission <= 15,
                            }"
                        >
                            C
                        </div>
                        <div
                            v-if="
                                props.properties.gas_emission > 10 &&
                                props.properties.gas_emission <= 15
                            "
                            class="top-full mt-1 flex flex-col items-center text-black"
                        >
                            <font-awesome-icon icon="sort-up" class="text-xs" />
                            <strong class="text-sm">
                                {{ props.properties.gas_emission }}
                            </strong>
                            <p class="text-tiny">kgCO₂/m²</p>
                        </div>
                    </li>
                    <li class="relative flex flex-col items-center">
                        <div
                            class="bg-orange-400 rounded-lg w-10 h-10 flex items-center justify-center"
                            :class="{
                                'py-6':
                                    props.properties.gas_emission > 15 &&
                                    props.properties.gas_emission <= 25,
                            }"
                        >
                            D
                        </div>
                        <div
                            v-if="
                                props.properties.gas_emission > 15 &&
                                props.properties.gas_emission <= 25
                            "
                            class="top-full mt-1 flex flex-col items-center text-black"
                        >
                            <font-awesome-icon icon="sort-up" class="text-xs" />
                            <strong class="text-sm">
                                {{ props.properties.gas_emission }}
                            </strong>
                            <p class="text-tiny">kgCO₂/m²</p>
                        </div>
                    </li>
                    <li class="relative flex flex-col items-center">
                        <div
                            class="bg-orange-600 rounded-lg w-10 h-10 flex items-center justify-center"
                            :class="{
                                'py-6':
                                    props.properties.gas_emission > 25 &&
                                    props.properties.gas_emission <= 35,
                            }"
                        >
                            E
                        </div>
                        <div
                            v-if="
                                props.properties.gas_emission > 25 &&
                                props.properties.gas_emission <= 35
                            "
                            class="top-full mt-1 flex flex-col items-center text-black"
                        >
                            <font-awesome-icon icon="sort-up" class="text-xs" />
                            <strong class="text-sm">
                                {{ props.properties.gas_emission }}
                            </strong>
                            <p class="text-tiny">kgCO₂/m²</p>
                        </div>
                    </li>
                    <li class="relative flex flex-col items-center">
                        <div
                            class="bg-red-600 rounded-lg w-10 h-10 flex items-center justify-center"
                            :class="{
                                'py-6':
                                    props.properties.gas_emission > 35 &&
                                    props.properties.gas_emission <= 55,
                            }"
                        >
                            F
                        </div>
                        <div
                            v-if="
                                props.properties.gas_emission > 35 &&
                                props.properties.gas_emission <= 55
                            "
                            class="top-full mt-1 flex flex-col items-center text-black"
                        >
                            <font-awesome-icon icon="sort-up" class="text-xs" />
                            <strong class="text-sm">
                                {{ props.properties.gas_emission }}
                            </strong>
                            <p class="text-tiny">kgCO₂/m²</p>
                        </div>
                    </li>
                    <li class="relative flex flex-col items-center">
                        <div
                            class="bg-red-800 rounded-lg w-10 h-10 flex items-center justify-center"
                            :class="{
                                'py-6': props.properties.gas_emission > 55,
                            }"
                        >
                            G
                        </div>
                        <div
                            v-if="props.properties.gas_emission > 55"
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
</script>
