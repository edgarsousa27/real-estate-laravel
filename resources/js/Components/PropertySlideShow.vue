<template>
    <div class="relative h-56 sm:h-56 md:h-72 lg:h-72 xl:h-72 overflow-hidden">
        <!-- Slideshow Images -->
        <div class="relative h-full w-full">
            <a :href="route('properties.show', { slug: property.slug })">
                <img
                    v-for="(media, index) in images"
                    :key="media.id"
                    :src="media.original_url"
                    :alt="'Property image ' + (index + 1)"
                    class="absolute inset-0 hover:scale-105 transition-all duration-400 ease-in-out w-full h-full object-cover"
                    draggable="false"
                    :class="{
                        'opacity-100': currentIndex === index,
                        'opacity-0': currentIndex !== index,
                    }"
                />
            </a>
        </div>

        <!-- Navigation Arrows -->
        <button
            v-if="images.length > 1"
            @click="prevImage"
            class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-1 rounded-full shadow-md z-10 transition-transform duration-150"
        >
            <font-awesome-icon
                icon="chevron-left"
                class="h-4 w-4 text-gray-500"
            />
        </button>
        <button
            v-if="images.length > 1"
            @click="nextImage"
            class="absolute right-2 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-1 rounded-full shadow-md z-10"
        >
            <font-awesome-icon
                icon="chevron-right"
                class="h-4 w-4 text-gray-500"
            />
        </button>

        <!-- Image Indicator -->
        <div
            v-if="images.length > 1"
            class="absolute bottom-2 left-0 right-0 flex justify-center space-x-1"
        >
            <button
                v-for="(_, index) in images"
                :key="index"
                @click="goToImage(index)"
                class="h-1.5 w-1.5 rounded-full"
                :class="{
                    'bg-white': currentIndex === index,
                    'bg-white/50': currentIndex !== index,
                }"
            ></button>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useI18n } from "vue-i18n";

const props = defineProps({
    images: {
        type: Array,
        required: true,
    },
    property: {
        type: Object,
        required: true,
    },
});

const { t } = useI18n();
const currentIndex = ref(0);

const nextImage = () => {
    currentIndex.value = (currentIndex.value + 1) % props.images.length;
};

const prevImage = () => {
    currentIndex.value =
        (currentIndex.value - 1 + props.images.length) % props.images.length;
};

const goToImage = (index) => {
    currentIndex.value = index;
};
</script>
