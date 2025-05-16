<template>
    <h1 class="text-xl font-semibold mb-4 mt-4 ml-3">Fora</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        <div
            v-if="props.properties.garden === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon icon="tree" class="size-5 text-indigo-500" />
            <span>Jardim</span>
        </div>
        <div
            v-if="props.properties.terrace === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon icon="sun" class="size-5 text-indigo-500" />
            <span>Terraço</span>
        </div>
        <div
            v-if="props.properties.swimming_pool === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon
                icon="water-ladder"
                class="size-5 text-indigo-500"
            />
            <span>Piscina</span>
        </div>
        <div
            v-if="props.properties.sea_view === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon icon="water" class="size-5 text-indigo-500" />
            <span>Vista para o mar</span>
        </div>
        <div
            v-if="props.properties.mountain_view === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon
                icon="mountain-sun"
                class="size-5 text-indigo-500"
            />
            <span>Vista para a montanha</span>
        </div>
        <div
            v-if="props.properties.solar_panels === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon
                icon="solar-panel"
                class="size-5 text-indigo-500"
            />
            <span>Painéis solares</span>
        </div>

        <div
            v-if="props.properties.parking_spaces"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon
                icon="square-parking"
                class="size-5 text-indigo-500"
            />
            <span
                >{{ props.properties.parking_spaces }} vaga de
                estacionamento</span
            >
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    properties: Object,
});
</script>
