<template>
    <div class="max-w-6xl mx-auto">
        <hr class="my-8" />
        <h1 class="text-xl font-semibold mb-4 mt-4">
            {{ t("details-page.map") }}
        </h1>
        <div
            ref="mapContainer"
            class="h-[400px] max-w-6xl mx-auto rounded-xl bg-gray-200 border-2 border-gray-300"
        ></div>
    </div>
</template>

<script setup>
import { computed, onMounted, nextTick, ref } from "vue";
import L from "leaflet";
import "leaflet/dist/leaflet.css";
import { useI18n } from "vue-i18n";

const { t } = useI18n();

const props = defineProps({
    properties: Object,
});

const mapContainer = ref(null);
let map = null;

const lat = computed(() => {
    const lat = props.properties.latitude;
    return lat;
});

const long = computed(() => {
    const long = props.properties.longitude;
    return long;
});

const initializeMap = async () => {
    await nextTick();

    try {
        map = L.map(mapContainer.value, {
            center: [lat.value, long.value],
            zoom: 15,
            scrollWheelZoom: true,
        });

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution:
                '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            maxZoom: 19,
        }).addTo(map);

        L.circle([lat.value, long.value], {
            color: "#77c648",
            fillColor: "#e3edde",
            fillOpacity: 0.6,
            radius: 500,
        }).addTo(map);

        console.log("Map initialized successfully");
    } catch (error) {
        console.error("Error initializing map:", error);
    }
};

onMounted(() => {
    console.log("Component mounted, initializing map...");
    initializeMap();
});
</script>
