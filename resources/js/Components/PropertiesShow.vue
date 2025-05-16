<template>
    <div
        class="relative h-60 sm:h-[350px] md:h-[400px] lg:h-[600px] overflow-hidden aspect-w-16 aspect-h-10 md:aspect-w-16 md:aspect-h-9 sm:rounded-xl md:rounded-2xl"
    >
        <!-- Slideshow Images -->
        <div class="relative h-full w-full">
            <img
                v-for="(media, index) in images"
                :key="media.id"
                :src="media.original_url"
                :alt="properties.title + (index + 1)"
                class="absolute inset-0 w-full h-full object-cover transition-opacity duration-500 ease-in-out"
                draggable="false"
                :class="{
                    'opacity-100': currentIndex === index,
                    'opacity-0': currentIndex !== index,
                }"
            />
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
    properties: {
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
