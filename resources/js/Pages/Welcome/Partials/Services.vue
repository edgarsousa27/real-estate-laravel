<template>
    <div class="py-12 px-6 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-5xl mx-auto">
            <!-- Title -->
            <h2 class="text-center text-2xl text-gray-900 mb-12">
                {{ t("services.services") }}
                <span class="font-bold">{{ t("services.popular") }}</span>
                {{ t("services.accessible") }}
            </h2>

            <!-- Services Grid -->
            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div
                    class="bg-white p-2 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 text-center"
                >
                    <div
                        class="mx-auto h-12 w-12 flex items-center justify-center bg-blue-100 rounded-full mb-4"
                    >
                        <div class="text-2xl">🔎</div>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">
                        {{ t("services.search") }}
                    </h3>
                </div>
                <div
                    class="bg-white p-2 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 text-center"
                >
                    <div
                        class="mx-auto h-12 w-12 flex items-center justify-center bg-blue-100 rounded-full mb-4"
                    >
                        <div class="text-2xl">🏠</div>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">
                        {{ t("services.tour") }}
                    </h3>
                </div>
                <div
                    class="bg-white p-2 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 text-center"
                >
                    <div
                        class="mx-auto h-12 w-12 flex items-center justify-center bg-blue-100 rounded-full mb-4"
                    >
                        <div class="text-2xl">💸</div>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">
                        {{ t("services.finance") }}
                    </h3>
                </div>
                <div
                    class="bg-white p-2 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 text-center"
                >
                    <div
                        class="mx-auto h-12 w-12 flex items-center justify-center bg-blue-100 rounded-full mb-4"
                    >
                        <div class="text-2xl">🔔</div>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">
                        {{ t("services.alerts") }}
                    </h3>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useI18n } from "vue-i18n";
const { t } = useI18n();
</script>
