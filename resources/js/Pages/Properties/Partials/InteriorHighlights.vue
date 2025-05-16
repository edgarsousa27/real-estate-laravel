<template>
    <h1 class="text-xl font-semibold mb-4 mt-4 ml-3">Interior</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        <div
            v-if="props.properties.heating === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon
                icon="temperature-high"
                class="size-5 text-indigo-500"
            />
            <span>Aquecimento Central</span>
        </div>
        <div
            v-if="props.properties.cooling === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon
                icon="snowflake"
                class="size-5 text-indigo-500"
            />
            <span>Ar condicionado</span>
        </div>
        <div
            v-if="props.properties.kitchen_equipped === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon icon="utensils" class="size-5 text-indigo-500" />
            <span>Cozinha equipada</span>
        </div>
        <div
            v-if="props.properties.fireplace === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon
                icon="fire-burner"
                class="size-5 text-indigo-500"
            />
            <span>Lareira</span>
        </div>
        <div
            v-if="props.properties.furnished === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon icon="couch" class="size-5 text-indigo-500" />
            <span>Mobilado</span>
        </div>
        <div
            v-if="props.properties.smart_home === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon
                icon="house-signal"
                class="size-5 text-indigo-500"
            />
            <span>Casa inteligente</span>
        </div>
        <div
            v-if="props.properties.storage === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon
                icon="jar-wheat"
                class="size-5 text-indigo-500"
            />
            <span>Despensa</span>
        </div>
        <div
            v-if="props.properties.building_gym === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon icon="dumbbell" class="size-5 text-indigo-500" />
            <span>Ginásio</span>
        </div>
        <div
            v-if="props.properties.building_pool === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon
                icon="water-ladder"
                class="size-5 text-indigo-500"
            />
            <span>Piscina interior</span>
        </div>

        <div
            v-if="props.properties.wheelchair_access === true"
            class="flex items-center gap-3 p-3 rounded-lg"
        >
            <font-awesome-icon
                icon="wheelchair"
                class="size-5 text-indigo-500"
            />
            <span>Acesso para cadeirantes</span>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    properties: Object,
});
</script>
