<template>
    <div class="max-w-7xl mx-auto">
        <hr class="my-8" />
        <h1 class="text-xl font-semibold mb-4 mt-4">
            {{ t("details-page.map") }}
        </h1>
        <div
            ref="mapContainer"
            class="h-[400px] max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 rounded-xl bg-gray-200 border-2 border-gray-300"
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

    const key = import.meta.env.VITE_MAPTILER_API_KEY;

    try {
        map = L.map(mapContainer.value, {
            center: [lat.value, long.value],
            zoom: 15,
            scrollWheelZoom: true,
        });

        L.tileLayer(
            `https://api.maptiler.com/maps/basic-v2/{z}/{x}/{y}.png?key=${key}`,
            {
                tileSize: 512,
                zoomOffset: -1,
                minZoom: 1,
                attribution:
                    ' \u003ca href="https://www.openstreetmap.org/copyright" target="_blank"\u003e\u0026copy; OpenStreetMap contributors\u003c/a\u003e',
                crossOrigin: true,
            }
        ).addTo(map);

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
