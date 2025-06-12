<template>
    <div
        @click.prevent="addToFavorites(props.properties.id)"
        class="absolute right-1 top-1 m-2 p-2 flex items-center justify-center cursor-pointer transition-colors duration-150 rounded-full bg-white hover:bg-gray-150 hover:bg-gray-50"
    >
        <font-awesome-icon
            icon="heart"
            class="size-5 border-1 border-white transition delay-150 duration-300 ease-in-out hover:scale-105"
            :class="[
                props.favorites.includes(props.properties.id)
                    ? 'text-red-500'
                    : 'text-neutral-300',
            ]"
        />
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    properties: Object,
    favorites: Array,
});

const form = useForm({
    property_id: null,
});

const addToFavorites = (propertyId) => {
    form.property_id = propertyId;

    if (props.favorites.includes(propertyId)) {
        form.delete(route("destroy.favorites", { id: propertyId }), {
            preserveScroll: true,
        });
    } else {
        form.post(route("store.favorites"), {
            preserveScroll: true,
        });
    }
};
</script>
