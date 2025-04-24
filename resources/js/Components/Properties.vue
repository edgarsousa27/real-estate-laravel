<template>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <ul
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"
            >
                <li v-for="proper in properties" :key="proper.id">
                    <div
                        class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 h-full flex flex-col"
                    >
                        <div
                            class="h-48 sm:h-56 md:h-48 lg:h-56 xl:h-48 overflow-hidden"
                        >
                            <img
                                :src="`/storage/${proper.image_path}`"
                                :alt="proper.title"
                                class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                            />
                        </div>
                        <div class="p-4 sm:p-5 flex-grow flex flex-col">
                            <div class="mb-3 sm:mb-4 flex-grow">
                                <h2
                                    class="text-lg sm:text-xl font-bold text-gray-800 hover:text-blue-600 line-clamp-2 mb-1"
                                >
                                    {{ proper.title }}
                                </h2>
                                <p
                                    class="text-gray-600 text-xs sm:text-sm line-clamp-2"
                                >
                                    {{ proper.description }}
                                </p>
                            </div>

                            <div
                                class="flex flex-wrap gap-2 sm:gap-3 mb-3 sm:mb-4 text-xs sm:text-sm text-gray-700"
                            >
                                <div
                                    class="flex items-center bg-gray-100 px-2 py-1 rounded"
                                >
                                    <span
                                        class="truncate max-w-[80px] sm:max-w-none"
                                        >{{ proper.city }}</span
                                    >
                                </div>
                                <div
                                    class="flex items-center bg-gray-100 px-2 py-1 rounded"
                                >
                                    {{ proper.square_meters }} m²
                                </div>
                                <div
                                    class="flex items-center bg-gray-100 px-2 py-1 rounded"
                                >
                                    {{ proper.bedrooms }} quartos
                                </div>
                                <div
                                    class="flex items-center bg-gray-100 px-2 py-1 rounded"
                                >
                                    {{ proper.bathrooms }} WC
                                </div>
                            </div>

                            <div
                                class="flex items-center justify-between pt-3 border-t border-gray-100 mt-auto"
                            >
                                <span
                                    class="text-lg sm:text-xl font-bold text-blue-600"
                                >
                                    {{ proper.price }} €
                                </span>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
const props = defineProps(["properties"]);
</script>
