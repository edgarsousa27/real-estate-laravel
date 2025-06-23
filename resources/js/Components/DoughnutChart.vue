<template>
    <Doughnut :data="chartData" :options="chartOptions" />
</template>

<script setup>
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    ArcElement,
    Filler,
} from "chart.js";
import { Doughnut } from "vue-chartjs";

ChartJS.register(Title, Tooltip, Legend, ArcElement, Filler);

const props = defineProps({
    chartData: Object,
    chartOptions: Object,
});
</script>
