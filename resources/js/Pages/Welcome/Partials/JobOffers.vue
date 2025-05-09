<template>
    <div class="pb-16 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div
                class="flex flex-col lg:flex-row gap-4 md:gap-6 justify-center items-stretch"
            >
                <div
                    class="w-full lg:w-3/5 p-6 sm:p-8 md:p-12 lg:p-16 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300"
                >
                    <div class="h-full flex flex-col justify-between gap-4">
                        <h2
                            class="text-xl sm:text-2xl md:text-3xl font-bold text-left text-gray-900 leading-tight"
                        >
                            {{ t("employees.title") }}
                        </h2>
                        <button
                            class="w-full sm:w-3/5 lg:w-3/4 bg-emerald-700 text-base sm:text-lg md:text-xl rounded-full px-4 py-3 sm:px-6 sm:py-3 md:px-8 md:py-4 hover:bg-emerald-800 text-white font-medium transition-colors duration-300"
                        >
                            {{ t("employees.button") }}
                        </button>
                    </div>
                </div>

                <div class="w-full lg:w-2/5 h-auto min-h-[200px]">
                    <div
                        class="h-full rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden"
                    >
                        <img
                            class="w-full h-full min-h-[200px] object-cover"
                            src="storage/images/persons.jpg"
                            :alt="t('employees.image_alt')"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useI18n } from "vue-i18n";
const { t } = useI18n();
</script>
