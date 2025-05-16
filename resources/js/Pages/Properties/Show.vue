<template>
    <Head>
        <title>{{ props.properties.title }}</title>
    </Head>
    <DefaultLayout>
        <div class="py-4 md:px-4 w-full sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div
                    class="w-full sm:w-full md:w-full lg:w-2/3 xl:w-2/3 sm:rounded-lg md:rounded-xl overflow-hidden"
                >
                    <div>
                        <PropertiesShow
                            :images="props.properties.media"
                            :properties="props.properties"
                        />
                    </div>

                    <div
                        class="flex flex-col sm:flex-row justify-between items-start sm:items-center mt-4 gap-2"
                    >
                        <h1
                            class="text-xl sm:text-2xl font-bold text-gray-800 break-words max-w-sm"
                        >
                            {{ props.properties.title }}
                        </h1>
                        <h1 class="text-xl sm:text-2xl font-bold text-blue-500">
                            {{ formatPrice(props.properties.price) + "€" }}
                        </h1>
                    </div>

                    <div
                        class="flex items-center gap-2 mt-3 mb-10 text-gray-600 text-lg"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6 text-blue-400"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                fill-rule="evenodd"
                                d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        <span
                            >{{ props.properties.district }},
                            {{ props.properties.city }}</span
                        >
                    </div>
                    <EssentialsHighlights :properties="props.properties" />
                    <hr class="my-5" />
                    <InteriorHighlights
                        v-if="
                            props.properties.category_id === 1 ||
                            props.properties.category_id === 2
                        "
                        :properties="props.properties"
                    />
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>

<script setup>
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import PropertiesShow from "@/Components/PropertiesShow.vue";
import EssentialsHighlights from "./Partials/EssentialsHighlights.vue";
import InteriorHighlights from "./Partials/InteriorHighlights.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    properties: Object,
    media: Array,
});

const formatPrice = (price) => {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
};
</script>
