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
                            class="ml-3 text-xl sm:text-2xl font-bold text-gray-800 break-words max-w-sm"
                        >
                            {{ props.properties.title }}
                        </h1>
                        <h1
                            class="ml-3 text-xl sm:text-2xl font-bold text-blue-500"
                        >
                            {{ formatPrice(props.properties.price) + "€" }}
                        </h1>
                    </div>

                    <div
                        class="flex items-center gap-2 mt-3 ml-3 mb-10 text-gray-600 text-lg"
                    >
                        <font-awesome-icon
                            icon="location-dot"
                            class="size-5 text-red-600"
                        />

                        <span
                            >{{ props.properties.district }},
                            {{ props.properties.city }}</span
                        >
                    </div>
                    <EssentialsHighlights :properties="props.properties" />
                    <hr class="my-8" />
                    <InteriorHighlights
                        v-if="
                            props.properties.category_id === 1 ||
                            props.properties.category_id === 2
                        "
                        :properties="props.properties"
                    />
                    <hr class="my-8" />
                    <OutdoorHighlights
                        v-if="
                            props.properties.category_id === 1 ||
                            props.properties.category_id === 2
                        "
                        :properties="props.properties"
                    />
                    <hr class="my-8" />
                    <div class="gap-2 mt-3 ml-3 mb-10 text-gray-600 text-lg">
                        <h1 class="text-xl font-semibold mb-4 mt-4">
                            Descrição
                        </h1>
                        <p>{{ props.properties.description }}</p>
                    </div>
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
import OutdoorHighlights from "./Partials/OutdoorHighlights.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    properties: Object,
    media: Array,
});

const formatPrice = (price) => {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
};
</script>
