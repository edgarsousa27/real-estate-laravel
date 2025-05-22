<template>
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">
            {{ t("admin-dashboard.quick-actions") }}
        </h3>
        <div class="space-y-4">
            <button
                class="w-full flex items-center justify-between p-4 bg-green-50 text-green-700 rounded-lg hover:bg-green-100 transition"
            >
                <span> {{ t("admin-dashboard.create-report") }}</span>
                <font-awesome-icon icon="file-export" />
            </button>
            <button
                class="w-full flex items-center justify-between p-4 bg-yellow-50 text-yellow-700 rounded-lg hover:bg-yellow-100 transition"
            >
                <span>{{ t("admin-dashboard.calendar") }}</span>
                <font-awesome-icon icon="calendar-days" />
            </button>
        </div>
    </div>
</template>

<script setup>
import { useI18n } from "vue-i18n";

const { t } = useI18n();
</script>
