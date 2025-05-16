<template>
    <h1 class="text-xl font-semibold mb-4 mt-4 ml-3">O essencial</h1>
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
                >Área útil {{ props.properties.square_meters + " ㎡" }}</span
            >
        </div>
        <div
            v-if="props.properties.category_id === 3"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon icon="mountain" class="size-5 text-indigo-500" />
            <span class="text-gray-700"
                >Terreno {{ props.properties.square_meters + " ㎡" }}</span
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
            <span class="text-gray-700">
                {{ props.properties.bedrooms }} quartos</span
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
            <span class="text-gray-700">
                {{ props.properties.bathrooms }} casas de banho</span
            >
        </div>

        <div
            v-if="props.properties.well_water === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon icon="droplet" class="size-5 text-indigo-500" />
            <span class="text-gray-700">Água do poço</span>
        </div>
        <div
            v-if="props.properties.electricity === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon icon="plug" class="size-5 text-indigo-500" />
            <span class="text-gray-700">Eletricidade</span>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    properties: Object,
});
</script>
