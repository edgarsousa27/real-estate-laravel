<template>
    <div
        class="max-w-5xl mx-auto p-4 sm:p-6 md:p-10 bg-white rounded-2xl shadow-md"
    >
        <div v-if="form.category_id === 1 || form.category_id === 2">
            <!-- Bedrooms Section -->
            <div class="mt-3 mb-6 sm:mb-10">
                <h1 class="font-bold text-sm sm:text-base">Quantos quartos?</h1>
                <div class="mt-3 sm:mt-5">
                    <div class="flex flex-wrap gap-2 sm:gap-3">
                        <div>
                            <input
                                type="radio"
                                :value="1"
                                id="bedroom-1"
                                v-model="form.bedrooms"
                                class="hidden peer"
                            />
                            <label
                                for="bedroom-1"
                                class="inline-block px-3 sm:px-5 py-1 sm:py-2 text-sm sm:text-base border border-gray-300 rounded-lg cursor-pointer peer-checked:bg-blue-500 peer-checked:text-white"
                            >
                                1
                            </label>
                        </div>
                        <div>
                            <input
                                type="radio"
                                :value="2"
                                id="bedroom-2"
                                v-model="form.bedrooms"
                                class="hidden peer"
                            />
                            <label
                                for="bedroom-2"
                                class="inline-block px-3 sm:px-5 py-1 sm:py-2 text-sm sm:text-base border border-gray-300 rounded-lg cursor-pointer peer-checked:bg-blue-500 peer-checked:text-white"
                            >
                                2
                            </label>
                        </div>
                        <div>
                            <input
                                type="radio"
                                :value="3"
                                id="bedroom-3"
                                v-model="form.bedrooms"
                                class="hidden peer"
                            />
                            <label
                                for="bedroom-3"
                                class="inline-block px-3 sm:px-5 py-1 sm:py-2 text-sm sm:text-base border border-gray-300 rounded-lg cursor-pointer peer-checked:bg-blue-500 peer-checked:text-white"
                            >
                                3
                            </label>
                        </div>
                        <div>
                            <input
                                type="radio"
                                :value="4"
                                id="bedroom-4"
                                v-model="form.bedrooms"
                                class="hidden peer"
                            />
                            <label
                                for="bedroom-4"
                                class="inline-block px-3 sm:px-5 py-1 sm:py-2 text-sm sm:text-base border border-gray-300 rounded-lg cursor-pointer peer-checked:bg-blue-500 peer-checked:text-white"
                            >
                                4
                            </label>
                        </div>
                        <div>
                            <input
                                type="radio"
                                :value="5"
                                id="bedroom-5"
                                v-model="form.bedrooms"
                                class="hidden peer"
                            />
                            <label
                                for="bedroom-5"
                                class="inline-block px-3 sm:px-5 py-1 sm:py-2 text-sm sm:text-base border border-gray-300 rounded-lg cursor-pointer peer-checked:bg-blue-500 peer-checked:text-white"
                            >
                                5
                            </label>
                        </div>
                        <div>
                            <input
                                type="radio"
                                :value="6"
                                id="bedroom-6"
                                v-model="form.bedrooms"
                                class="hidden peer"
                            />
                            <label
                                for="bedroom-6"
                                class="inline-block px-3 sm:px-5 py-1 sm:py-2 text-sm sm:text-base border border-gray-300 rounded-lg cursor-pointer peer-checked:bg-blue-500 peer-checked:text-white"
                            >
                                6
                            </label>
                        </div>
                        <div class="w-full sm:w-auto mt-2 sm:mt-0">
                            <span
                                class="text-sm sm:text-base cursor-pointer text-blue-500 hover:text-blue-700"
                                @click="openInputBedrooms = !openInputBedrooms"
                            >
                                Personalizado
                            </span>
                        </div>
                    </div>
                    <div v-if="openInputBedrooms" class="mt-3 sm:mt-5">
                        <InputLabel value="Quantos quartos?" />
                        <TextInput
                            type="text"
                            v-model="form.bedrooms"
                            class="w-full sm:w-1/2"
                        />
                    </div>
                    <InputError :message="form.errors.bedrooms" class="mt-1" />
                </div>
            </div>

            <!-- Bathrooms Section -->
            <div class="mt-3 mb-6 sm:mb-10">
                <h1 class="font-bold text-sm sm:text-base">
                    Quantas casas de banho?
                </h1>
                <div class="mt-3 sm:mt-5">
                    <div class="flex flex-wrap gap-2 sm:gap-3">
                        <div>
                            <input
                                type="radio"
                                :value="1"
                                id="bath-1"
                                v-model="form.bathrooms"
                                class="hidden peer"
                            />
                            <label
                                for="bath-1"
                                class="inline-block px-3 sm:px-5 py-1 sm:py-2 text-sm sm:text-base border border-gray-300 rounded-lg cursor-pointer peer-checked:bg-blue-500 peer-checked:text-white"
                            >
                                1
                            </label>
                        </div>
                        <div>
                            <input
                                type="radio"
                                :value="2"
                                id="bath-2"
                                v-model="form.bathrooms"
                                class="hidden peer"
                            />
                            <label
                                for="bath-2"
                                class="inline-block px-3 sm:px-5 py-1 sm:py-2 text-sm sm:text-base border border-gray-300 rounded-lg cursor-pointer peer-checked:bg-blue-500 peer-checked:text-white"
                            >
                                2
                            </label>
                        </div>
                        <div>
                            <input
                                type="radio"
                                :value="3"
                                id="bath-3"
                                v-model="form.bathrooms"
                                class="hidden peer"
                            />
                            <label
                                for="bath-3"
                                class="inline-block px-3 sm:px-5 py-1 sm:py-2 text-sm sm:text-base border border-gray-300 rounded-lg cursor-pointer peer-checked:bg-blue-500 peer-checked:text-white"
                            >
                                3
                            </label>
                        </div>
                        <div>
                            <input
                                type="radio"
                                :value="4"
                                id="bath-4"
                                v-model="form.bathrooms"
                                class="hidden peer"
                            />
                            <label
                                for="bath-4"
                                class="inline-block px-3 sm:px-5 py-1 sm:py-2 text-sm sm:text-base border border-gray-300 rounded-lg cursor-pointer peer-checked:bg-blue-500 peer-checked:text-white"
                            >
                                4
                            </label>
                        </div>
                        <div>
                            <input
                                type="radio"
                                :value="5"
                                id="bath-5"
                                v-model="form.bathrooms"
                                class="hidden peer"
                            />
                            <label
                                for="bath-5"
                                class="inline-block px-3 sm:px-5 py-1 sm:py-2 text-sm sm:text-base border border-gray-300 rounded-lg cursor-pointer peer-checked:bg-blue-500 peer-checked:text-white"
                            >
                                5
                            </label>
                        </div>
                        <div>
                            <input
                                type="radio"
                                :value="6"
                                id="bath-6"
                                v-model="form.bathrooms"
                                class="hidden peer"
                            />
                            <label
                                for="bath-6"
                                class="inline-block px-3 sm:px-5 py-1 sm:py-2 text-sm sm:text-base border border-gray-300 rounded-lg cursor-pointer peer-checked:bg-blue-500 peer-checked:text-white"
                            >
                                6
                            </label>
                        </div>
                        <div class="w-full sm:w-auto mt-2 sm:mt-0">
                            <span
                                class="text-sm sm:text-base cursor-pointer text-blue-500 hover:text-blue-700"
                                @click="
                                    openInputBathrooms = !openInputBathrooms
                                "
                            >
                                Personalizado
                            </span>
                        </div>
                    </div>
                    <div v-if="openInputBathrooms" class="mt-3 sm:mt-5">
                        <InputLabel value="Quantas casas de banho?" />
                        <TextInput
                            type="text"
                            v-model="form.bathrooms"
                            class="w-full sm:w-1/2"
                        />
                    </div>
                    <InputError :message="form.errors.bathrooms" class="mt-1" />
                </div>
            </div>
        </div>

        <div class="mt-6 sm:mt-10 space-y-2">
            <h1 class="font-bold text-sm sm:text-base">Quais equipamentos?</h1>
            <HighLightsForm :form="props.form" />
        </div>

        <div class="mt-6 sm:mt-10 space-y-2">
            <h1 class="font-bold text-sm sm:text-base">
                Qual a eficiencia energética do imóvel?
            </h1>
            <div class="mt-3 sm:mt-5">
                <div class="flex flex-wrap gap-2 sm:gap-3">
                    <div>
                        <input
                            type="radio"
                            value="A+"
                            id="energy-1"
                            v-model="form.energy_consumption"
                            class="hidden peer"
                        />
                        <label
                            for="energy-1"
                            class="inline-block px-3 sm:px-5 py-1 sm:py-2 text-sm sm:text-base border border-gray-300 rounded-lg cursor-pointer peer-checked:bg-emerald-400 peer-checked:text-white"
                        >
                            A+
                        </label>
                    </div>
                    <div>
                        <input
                            type="radio"
                            value="A"
                            id="energy-2"
                            v-model="form.energy_consumption"
                            class="hidden peer"
                        />
                        <label
                            for="energy-2"
                            class="inline-block px-3 sm:px-5 py-1 sm:py-2 text-sm sm:text-base border border-gray-300 rounded-lg cursor-pointer peer-checked:bg-emerald-500 peer-checked:text-white"
                        >
                            A
                        </label>
                    </div>
                    <div>
                        <input
                            type="radio"
                            value="B"
                            id="energy-3"
                            v-model="form.energy_consumption"
                            class="hidden peer"
                        />
                        <label
                            for="energy-3"
                            class="inline-block px-3 sm:px-5 py-1 sm:py-2 text-sm sm:text-base border border-gray-300 rounded-lg cursor-pointer peer-checked:bg-lime-400 peer-checked:text-white"
                        >
                            B
                        </label>
                    </div>
                    <div>
                        <input
                            type="radio"
                            value="C"
                            id="energy-4"
                            v-model="form.energy_consumption"
                            class="hidden peer"
                        />
                        <label
                            for="energy-4"
                            class="inline-block px-3 sm:px-5 py-1 sm:py-2 text-sm sm:text-base border border-gray-300 rounded-lg cursor-pointer peer-checked:bg-yellow-400 peer-checked:text-white"
                        >
                            C
                        </label>
                    </div>
                    <div>
                        <input
                            type="radio"
                            value="D"
                            id="energy-5"
                            v-model="form.energy_consumption"
                            class="hidden peer"
                        />
                        <label
                            for="energy-5"
                            class="inline-block px-3 sm:px-5 py-1 sm:py-2 text-sm sm:text-base border border-gray-300 rounded-lg cursor-pointer peer-checked:bg-orange-400 peer-checked:text-white"
                        >
                            D
                        </label>
                    </div>
                    <div>
                        <input
                            type="radio"
                            value="E"
                            id="energy-6"
                            v-model="form.energy_consumption"
                            class="hidden peer"
                        />
                        <label
                            for="energy-6"
                            class="inline-block px-3 sm:px-5 py-1 sm:py-2 text-sm sm:text-base border border-gray-300 rounded-lg cursor-pointer peer-checked:bg-orange-600 peer-checked:text-white"
                        >
                            E
                        </label>
                    </div>
                    <div>
                        <input
                            type="radio"
                            value="F"
                            id="energy-7"
                            v-model="form.energy_consumption"
                            class="hidden peer"
                        />
                        <label
                            for="energy-7"
                            class="inline-block px-3 sm:px-5 py-1 sm:py-2 text-sm sm:text-base border border-gray-300 rounded-lg cursor-pointer peer-checked:bg-red-600 peer-checked:text-white"
                        >
                            F
                        </label>
                    </div>
                </div>
            </div>
            <InputError
                :message="form.errors.energy_consumption"
                class="mt-1"
            />
        </div>
    </div>
</template>

<script setup>
import { useI18n } from "vue-i18n";
import InputError from "@/Components/InputError.vue";
import HighLightsForm from "./HighLightsForm.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { ref } from "vue";

const { t } = useI18n();

const props = defineProps({
    form: Object,
    district: Array,
    cities: Object,
    postal_code: Object,
});

const openInputBedrooms = ref(false);
const openInputBathrooms = ref(false);
</script>
