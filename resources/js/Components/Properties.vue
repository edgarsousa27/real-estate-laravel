<template>
    <div class="mt-8 flex justify-center items-center m-5">
        <div class="w-full max-w-6xl max-h-4xl mx-auto">
            <ul class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                <li
                    v-for="proper in properties"
                    :key="proper.id"
                    class="bg-gray-100 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 flex flex-col p-6"
                >
                    <div class="mb-4">
                        <img
                            :src="`/storage/${proper.image_path}`"
                            :alt="proper.title"
                            class="w-full h-56 object-contain rounded-lg transition delay-50 hover:scale-105"
                        />
                    </div>
                    <div class="flex-grow">
                        <h2
                            class="line-clamp-2 text-2xl font-semibold mb-2 hover:text-blue-600"
                        >
                            {{ proper.title }}
                        </h2>
                    </div>
                    <div class="flex-grow">
                        <h2
                            class="line-clamp-2 text-lg mb-2 hover:text-blue-600"
                        >
                            {{ proper.description }}
                        </h2>
                    </div>
                    <div class="flex items-center gap-4">
                        <h2
                            class="text-md hover:text-blue-600 text-left min-w-[100px]"
                        >
                            {{ proper.city }}
                        </h2>
                        <h2
                            class="text-md hover:text-blue-600 text-center min-w-[80px]"
                        >
                            {{ proper.square_meters }} m²
                        </h2>
                        <h2
                            class="text-md hover:text-blue-600 text-center min-w-[60px]"
                        >
                            {{ proper.bedrooms }} quartos
                        </h2>
                        <h2
                            class="text-md hover:text-blue-600 text-center min-w-[60px]"
                        >
                            {{ proper.bathrooms }} WC
                        </h2>
                    </div>
                    <div class="mt-4 flex gap-5 items-center"></div>
                    <span class="text-2xl mb-1 font-bold text-blue-500">
                        {{ proper.price + " €" }}
                    </span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
const props = defineProps(["properties"]);
</script>
