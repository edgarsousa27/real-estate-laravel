<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    href: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Link
        :href="href"
        class="block w-full px-4 py-2 text-start text-md leading-5 text-gray-700 transition duration-150 ease-in-out hover:text-blue-500 focus:bg-gray-100 focus:outline-none cursor-pointer"
    >
        <slot />
    </Link>
</template>
