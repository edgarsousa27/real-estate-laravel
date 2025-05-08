<template>
    <div>
        <div class="bg-white">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="bg-blue-50 w-full rounded-3xl mt-6 py-20">
                    <h1
                        class="text-2xl sm:text-4xl md:text-5xl text-center mb-8 text-gray-800"
                    >
                        {{ t("carousel.title") }}
                        <span class="font-bold">{{
                            t("carousel.title-2")
                        }}</span>
                        {{ t("carousel.title-3") }}
                    </h1>
                    <InputSearch
                        :count_buy="props.count_buy"
                        :count_rent="props.count_rent"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useI18n } from "vue-i18n";
import InputSearch from "@/Components/InputSearch.vue";

const props = defineProps({
    count_buy: Number,
    count_rent: Number,
});

const { t } = useI18n();
</script>
