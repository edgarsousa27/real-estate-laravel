<template>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl max-h-6xl mx-auto">
            <ul
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6"
            >
                <li v-for="proper in properties" :key="proper.id">
                    <div
                        class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 h-full flex flex-col"
                    >
                        <div
                            class="relative h-56 sm:h-56 md:h-72 lg:h-72 xl:h-72"
                        >
                            <img
                                :src="`/storage/${proper.image_path}`"
                                :alt="proper.title"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300 cursor-pointer"
                            />
                            <div
                                class="absolute right-1 top-1 rounded-full m-2 bg-white p-2 flex items-center justify-between hover:bg-red-600"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="gray"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="gray"
                                    class="size-6"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                                    />
                                </svg>
                            </div>
                            <div
                                class="absolute bottom-0 left-0 right-0 bg-white shadow-lg m-2 rounded-lg text-white px-4 py-2 flex items-center justify-between"
                            >
                                <span
                                    class="text-lg sm:text-xl font-bold text-blue-600"
                                >
                                    {{ "€" + formatPrice(proper.price) }}
                                </span>
                            </div>
                        </div>

                        <div class="p-4 sm:p-5 flex-grow flex flex-col">
                            <div class="flex gap-1">
                                <h1
                                    class="text-md sm:text-md font-normal text-gray-500 hover:text-blue-600 line-clamp-1 mb-1 cursor-pointer"
                                >
                                    {{ proper.title }}
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
                                    >{{ proper.square_meters + " m2" }}
                                </span>
                            </div>
                            <div class="flex-grow">
                                <h2
                                    class="text-md sm:text-md text-gray-500 mb-1 cursor-pointer"
                                >
                                    {{ proper.city }}
                                </h2>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import { useI18n } from "vue-i18n";

const props = defineProps(["properties"]);
const { t } = useI18n();

const formatPrice = (price) => {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
};
</script>
