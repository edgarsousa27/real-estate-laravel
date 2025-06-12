<template>
    <div class="py-4 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl max-h-6xl mx-auto">
            <ul
                class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6"
            >
                <li v-for="proper in properties" :key="proper.id">
                    <div
                        class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 h-full flex flex-col"
                    >
                        <div
                            class="relative h-56 sm:h-56 md:h-72 lg:h-72 xl:h-72"
                        >
                            <PropertySlideShow
                                :images="proper.media"
                                :property="proper"
                            ></PropertySlideShow>

                            <FavoriteButton
                                :favorites="props.favorites"
                                :properties="proper"
                            />

                            <div
                                class="absolute bottom-0 left-0 right-0 bg-white shadow-lg m-2 rounded-lg px-4 py-2 flex"
                            >
                                <span
                                    v-if="proper.transaction_id == 1"
                                    class="text-lg sm:text-xl font-bold text-blue-600"
                                >
                                    {{ formatPrice(proper.price) + "€" }}
                                </span>
                                <span
                                    v-if="proper.transaction_id == 2"
                                    class="text-lg sm:text-xl font-bold text-blue-600"
                                >
                                    {{ formatPrice(proper.price) + "€" }}
                                    <span
                                        class="text-xs font-bold text-gray-500"
                                        >{{ t("properties.per-month") }}</span
                                    >
                                </span>
                            </div>
                        </div>

                        <a
                            :href="
                                route('properties.show', { slug: proper.slug })
                            "
                        >
                            <div class="p-4 sm:p-5 flex-grow flex flex-col">
                                <div
                                    class="flex gap-1 justify-between items-center"
                                >
                                    <div class="flex gap-1">
                                        <h1
                                            class="text-md sm:text-md font-normal text-gray-500 hover:text-blue-600 line-clamp-1 mb-1 cursor-pointer"
                                            v-if="proper.category_id === 1"
                                        >
                                            {{ t("category.house") }}
                                        </h1>
                                        <h1
                                            class="text-md sm:text-md font-normal text-gray-500 hover:text-blue-600 line-clamp-1 mb-1 cursor-pointer"
                                            v-else-if="proper.category_id === 2"
                                        >
                                            {{ t("category.apartment") }}
                                        </h1>
                                        <h1
                                            class="text-md sm:text-md font-normal text-gray-500 hover:text-blue-600 line-clamp-1 mb-1 cursor-pointer"
                                            v-else
                                        >
                                            {{ t("category.land") }}
                                        </h1>
                                        <span
                                            v-if="proper.bedrooms != null"
                                            class="text-md sm:text-md font-bold text-gray-800 mb-1 cursor-pointer"
                                        >
                                            {{
                                                proper.bedrooms +
                                                " " +
                                                t("properties.bedroom")
                                            }}
                                        </span>
                                        <span
                                            v-if="proper.bathrooms != null"
                                            class="text-md sm:text-md font-bold text-gray-800 mb-1 cursor-pointer"
                                        >
                                            {{
                                                proper.bathrooms +
                                                " " +
                                                t("properties.wc")
                                            }}
                                        </span>
                                        <span
                                            class="text-md sm:text-md font-bold text-gray-800 mb-1 cursor-pointer"
                                        >
                                            {{ proper.square_meters + "㎡" }}
                                        </span>
                                    </div>
                                    <!-- Envelope icon moved here -->
                                    <font-awesome-icon
                                        icon="envelope"
                                        class="w-6 h-6 text-neutral-300 hover:text-blue-500 cursor-pointer"
                                    />
                                </div>
                                <div class="flex-grow">
                                    <h2
                                        class="text-md sm:text-md text-gray-500 mb-1 cursor-pointer"
                                    >
                                        {{ proper.city }}, {{ proper.district }}
                                    </h2>
                                </div>
                            </div>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import { useI18n } from "vue-i18n";
import PropertySlideShow from "@/Components/PropertySlideShow.vue";
import FavoriteButton from "./FavoriteButton.vue";

const props = defineProps({
    properties: Array,
    categories: Array,
    favorites: Array,
});

const { t } = useI18n();

const formatPrice = (price) => {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
};
</script>
