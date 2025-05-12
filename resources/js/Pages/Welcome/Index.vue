<template>
    <Head title="Welcome" />

    <DefaultLayout>
        <Carousel :count_buy="props.count_buy" :count_rent="props.count_rent" />
        <Services />
        <JobOffers />
        <Highlights />
        <LatestProperties
            :properties="props.properties"
            :categories="props.categories"
        />
    </DefaultLayout>
</template>

<script setup>
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import Carousel from "@/Components/Carousel.vue";
import Services from "./Partials/Services.vue";
import JobOffers from "./Partials/JobOffers.vue";
import LatestProperties from "./Partials/LatestProperties.vue";
import Highlights from "./Partials/Highlights.vue";
import { Head } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";

const { t } = useI18n();

const props = defineProps({
    count_buy: Number,
    count_rent: Number,
    properties: Array,
    categories: Array,
});
</script>
