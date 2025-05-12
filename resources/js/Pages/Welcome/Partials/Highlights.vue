<template>
    <div>
        <div class="bg-blue-50 py-8 md:py-12 lg:h-48 mb-16">
            <div
                class="grid grid-cols-1 md:grid-cols-3 lg:gap-8 container mx-auto px-4"
            >
                <div class="flex items-center justify-center">
                    <h1 class="text-center">
                        <span class="text-3xl block mb-1">😃</span
                        ><span class="text-xl">
                            <span class="font-semibold">{{
                                t("highlights.clients")
                            }}</span>
                            {{ t("highlights.clients-satisfied") }}
                        </span>
                        <br />
                        <span class="text-sm text-gray-600">
                            {{ t("highlights.clients-text") }}</span
                        >
                    </h1>
                </div>
                <div class="flex items-center justify-center">
                    <h1 class="text-center">
                        <span class="text-3xl block mb-1">🏠</span>
                        <span class="text-xl">
                            <span class="font-semibold">{{
                                t("highlights.house-million")
                            }}</span>
                            {{ t("highlights.house-clients") }}
                        </span>
                        <br />
                        <span class="text-sm text-gray-600">{{
                            t("highlights.since")
                        }}</span>
                    </h1>
                </div>
                <div class="flex items-center justify-center">
                    <h1 class="text-center">
                        <span class="text-3xl block mb-1">📈</span>
                        <span class="text-xl">
                            <span class="font-semibold">{{
                                t("highlights.leaders")
                            }}</span>
                            {{ t("highlights.sales") }}
                        </span>
                        <br />
                        <span class="text-sm text-gray-600">{{
                            t("highlights.sales-portugal")
                        }}</span>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useI18n } from "vue-i18n";
const { t } = useI18n();
</script>
