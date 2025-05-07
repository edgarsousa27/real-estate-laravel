<template>
    <Head title="Welcome" />

    <DefaultLayout>
        <Carousel :count_buy="props.count_buy" :count_rent="props.count_rent" />
    </DefaultLayout>
</template>

<script setup>
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import Carousel from "@/Components/Carousel.vue";
import { Head } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";

const { t } = useI18n();

const props = defineProps({
    count_buy: Number,
    count_rent: Number,
});
</script>
