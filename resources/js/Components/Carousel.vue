<template>
    <div>
        <div class="min-h-screen bg-white">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="bg-blue-50 w-full rounded-3xl my-12 py-20">
                    <h1
                        class="text-2xl sm:text-4xl md:text-5xl text-center mb-8 text-gray-800"
                    >
                        {{ t("carousel.title") }}
                        <span class="text-blue-600 font-bold">{{
                            t("carousel.title-2")
                        }}</span>
                        {{ t("carousel.title-3") }}
                    </h1>
                    <div class="flex space-x-2 mb-8 justify-center">
                        <button
                            v-for="tab in tabs"
                            :key="tab"
                            @click="activeTab = tab"
                            class="px-6 py-3 rounded-full text-sm font-medium transition-colors"
                            :class="{
                                'bg-blue-600 text-white shadow-md':
                                    activeTab === tab,
                                'bg-white text-gray-700 hover:bg-gray-100':
                                    activeTab !== tab,
                            }"
                        >
                            {{ t(`carousel.tab-${tab}`) }}
                        </button>
                    </div>

                    <div
                        class="max-w-sm md:max-w-lg lg:max-w-xl mx-auto space-y-6"
                    >
                        <div>
                            <div>
                                <h1
                                    v-if="activeTab == 'buy'"
                                    class="font-semibold mb-2 text-xl"
                                >
                                    {{ count_buy }}
                                    {{ t("carousel.properties-sale") }}
                                </h1>
                                <h1
                                    v-if="activeTab == 'rent'"
                                    class="font-semibold mb-2 text-xl"
                                >
                                    {{ count_rent }}
                                    {{ t("carousel.properties-rent") }}
                                </h1>
                            </div>
                            <label
                                class="block text-gray-700 text-sm font-medium mb-2"
                            >
                                {{ t("carousel.localization") }}
                            </label>
                            <input
                                type="text"
                                :placeholder="t('carousel.placeholder')"
                                class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                            />
                        </div>

                        <button
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded-lg transition-colors shadow-md hover:shadow-lg"
                        >
                            {{ t("carousel.search") }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useI18n } from "vue-i18n";
import { ref } from "vue";

const { t } = useI18n();

const props = defineProps({
    count_buy: Number,
    count_rent: Number,
});

const tabs = ["buy", "rent"];

const activeTab = ref("buy");
</script>
