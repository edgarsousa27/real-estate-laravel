<template>
    <div class="flex items-center">
        <div
            class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600"
        >
            <font-awesome-icon :icon="icon" />
        </div>
        <div class="ml-3">
            <p class="text-sm font-medium text-gray-500">{{ label }}</p>
            <p class="text-sm text-gray-900">{{ value }}</p>
        </div>
    </div>
</template>

<script setup>
defineProps({
    label: String,
    value: [String, Number],
    icon: {
        type: String,
        default: "info-circle",
    },
});
</script>
