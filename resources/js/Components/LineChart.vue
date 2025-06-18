<template>
    <Line :data="chartData" :options="chartOptions" />
</template>

<script setup>
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    PointElement,
    LineElement,
} from "chart.js";
import { Line } from "vue-chartjs";

ChartJS.register(Title, Tooltip, Legend, PointElement, LineElement);

const props = defineProps({
    chartData: Object,
    chartOptions: Object,
});
</script>
