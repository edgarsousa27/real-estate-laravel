<template>
    <div class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <h1
            class="mt-8 mb-6 text-2xl font-bold text-gray-900 sm:text-4xl lg:mb-8 lg:text-left text-center sm:text-center"
        >
            Imóveis Disponíveis
        </h1>
        <Properties :properties="props.properties" />
    </div>
</template>

<script setup>
import Properties from "@/Components/Properties.vue";

const props = defineProps(["properties"]);
</script>
