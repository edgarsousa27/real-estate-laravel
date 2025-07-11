<template>
    <Head>
        <title>{{ t("properties.page") }}</title>
    </Head>
    <DefaultLayout>
        <div>
            <div class="bg-white">
                <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
                    <div class="bg-blue-50 w-full rounded-3xl mt-6 py-20">
                        <h1
                            class="text-xl sm:text-2xl md:text-3xl text-center mb-3 text-gray-800"
                        >
                            <div class="text-9xl mb-5">🥲</div>
                            {{ t("noresults.title") }}
                        </h1>
                        <p
                            v-if="count == 0"
                            class="text-center text-lg text-gray-900 mb-3"
                        >
                            {{ count }} {{ t("noresults.count") }}
                        </p>

                        <p class="text-center text-lg text-gray-600">
                            {{ t("noresults.search") }}
                        </p>
                        <div class="pt-4 text-center">
                            <a
                                :href="route('welcome')"
                                class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200"
                            >
                                {{ t("noresults.button") }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";

const { t } = useI18n();

const props = defineProps({
    count: Number,
});
</script>
