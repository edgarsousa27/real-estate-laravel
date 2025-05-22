<template>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full" :class="iconBgColor">
                <font-awesome-icon :icon="icon" class="text-white text-lg" />
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">{{ title }}</p>
                <p class="text-2xl font-semibold text-gray-900">{{ value }}</p>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    title: String,
    value: [String, Number],
    icon: String,
    iconBgColor: {
        type: String,
        default: "bg-blue-500",
    },
});
</script>
