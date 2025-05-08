<template>
    <div class="py-16 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Services Grid -->
            <div class="flex gap-4 justify-center">
                <div
                    class="grow p-20 bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 text-center"
                >
                    <div
                        class="mx-auto h-12 w-full flex items-center justify-center font-bold rounded-full mb-4"
                    >
                        <div class="text-2xl">
                            Estamos recrutando funcionários, em nossas agências
                            e em nossa sede!
                        </div>
                    </div>
                    <button
                        class="flex justify-start bg-orange-500 text-lg rounded-xl p-3 hover:bg-orange-600 text-white font-medium mb-2"
                    >
                        Ofertas de trabalho
                    </button>
                </div>
                <div
                    class="bg-white p-2 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 text-center"
                >
                    <div
                        class="mx-auto h-12 w-12 flex items-center justify-center bg-blue-100 rounded-full mb-4"
                    >
                        <div class="text-2xl">
                            <img src="/images/" alt="" />
                        </div>
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
