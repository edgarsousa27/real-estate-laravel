<template>
    <h1
        class="m-8 text-center text-2xl mb-5 lg:text-left md:text-center sm:text-center font-bold text-gray-800"
    >
        Imóveis
    </h1>
    <Properties :properties="props.properties"> </Properties>
</template>

<script setup>
import Properties from "@/Components/Properties.vue";

const props = defineProps(["properties"]);
</script>
