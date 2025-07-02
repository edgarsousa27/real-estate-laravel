<template>
    <div
        class="max-w-5xl mx-auto p-4 sm:p-6 md:p-8 lg:p-10 bg-white rounded-xl md:rounded-2xl shadow-md"
    >
        <div class="relative">
            <div class="absolute top-0 right-0">
                <h1
                    class="text-md font-semibold cursor-pointer hover:text-blue-500"
                    @click="resetForm()"
                >
                    <span class="mr-2"
                        ><font-awesome-icon icon="arrow-rotate-left" /></span
                    >Reiniciar
                </h1>
            </div>
        </div>

        <!-- Transaction Type -->
        <div class="mt-3 space-y-2">
            <h1 class="text-lg font-bold">Você quer?</h1>
            <div class="flex flex-wrap items-center gap-4">
                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input
                        type="radio"
                        :value="1"
                        v-model="form.transaction_id"
                        class="h-5 w-5 text-blue-600 focus:ring-blue-500"
                    />
                    <span>{{ t("properties-form.sell") }}</span>
                </label>
                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input
                        type="radio"
                        :value="2"
                        v-model="form.transaction_id"
                        class="h-5 w-5 text-blue-600 focus:ring-blue-500"
                    />
                    <span>{{ t("properties-form.rent") }}</span>
                </label>
            </div>
            <InputError :message="form.errors.transaction_id" />
        </div>
        <div class="mt-6 md:mt-8 space-y-2">
            <h1 class="text-lg font-bold">Tipo de imóvel?</h1>
            <div class="flex flex-wrap items-center gap-4">
                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input
                        type="radio"
                        :value="1"
                        v-model="form.category_id"
                        class="h-5 w-5 text-blue-600 focus:ring-blue-500"
                    />
                    <span>{{ t("properties-form.house") }}</span>
                </label>
                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input
                        type="radio"
                        :value="2"
                        v-model="form.category_id"
                        class="h-5 w-5 text-blue-600 focus:ring-blue-500"
                    />
                    <span>{{ t("properties-form.apartment") }}</span>
                </label>
                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input
                        type="radio"
                        :value="3"
                        v-model="form.category_id"
                        class="h-5 w-5 text-blue-600 focus:ring-blue-500"
                    />
                    <span>{{ t("properties-form.land") }}</span>
                </label>
            </div>
            <InputError :message="form.errors.category_id" />
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6 md:mt-8">
            <div v-if="form.transaction_id === 2" class="space-y-2">
                <h1 class="text-lg font-bold">
                    {{ t("properties-form.price-rent") }}
                </h1>
                <div class="relative">
                    <TextInput
                        type="number"
                        id="price"
                        v-model="form.price"
                        @input="fieldUpdated('price')"
                        class="w-full pl-4 pr-16"
                    />
                    <span
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500"
                    >
                        € / por mês
                    </span>
                </div>
                <InputError :message="form.errors.price" />
            </div>

            <div v-if="form.transaction_id === 1" class="space-y-2">
                <h1 class="text-lg font-bold">Preço?</h1>
                <div class="relative">
                    <TextInput
                        type="number"
                        id="price"
                        v-model="form.price"
                        @input="fieldUpdated('price')"
                        class="w-full pl-4 pr-12"
                    />
                    <span
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500"
                    >
                        €
                    </span>
                </div>
                <InputError :message="form.errors.price" />
            </div>

            <div
                v-if="form.transaction_id === 1 || form.transaction_id === 2"
                class="space-y-2"
            >
                <h1 class="text-lg font-bold">Qual a área de superfície?</h1>
                <div class="relative">
                    <TextInput
                        type="number"
                        id="square_meters"
                        v-model="form.square_meters"
                        @input="fieldUpdated('square_meters')"
                        class="w-full pl-4 pr-12"
                    />
                    <span
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500"
                    >
                        m²
                    </span>
                </div>
                <InputError :message="form.errors.square_meters" />
            </div>
        </div>

        <!-- Description -->
        <div class="mt-6 md:mt-8 space-y-2">
            <h1 class="text-lg font-bold">
                {{ t("properties-form.description") }}
            </h1>
            <textarea
                id="description"
                v-model="form.description"
                class="w-full min-h-[120px] px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                required
                @input="fieldUpdated('description')"
            ></textarea>
            <InputError :message="form.errors.description" />
        </div>
    </div>
</template>

<script setup>
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import { useI18n } from "vue-i18n";

const { t } = useI18n();

const props = defineProps({
    form: Object,
});

const emit = defineEmits(["field-updated"]);

const fieldUpdated = (fieldName) => {
    emit("field-updated", fieldName);
};

// const resetFrom = computed(() => {
//     return props.form.reset();
// });

const resetForm = () => {
    return props.form.reset();
};
</script>
