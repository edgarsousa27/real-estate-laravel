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
            <h1 class="text-md font-bold">Você quer?</h1>
            <div class="flex flex-wrap items-center gap-4">
                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input
                        type="radio"
                        :value="1"
                        v-model="form.transaction_id"
                        class="h-5 w-5 text-blue-500 focus:ring-blue-500"
                    />
                    <span>{{ t("properties-form.sell") }}</span>
                </label>
                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input
                        type="radio"
                        :value="2"
                        v-model="form.transaction_id"
                        class="h-5 w-5 text-blue-500 focus:ring-blue-500"
                    />
                    <span>{{ t("properties-form.rent") }}</span>
                </label>
            </div>
            <InputError :message="form.errors.transaction_id" />
        </div>
        <div class="mt-6 md:mt-8 space-y-2">
            <h1 class="text-md font-bold">Tipo de imóvel?</h1>
            <div class="flex flex-wrap items-center gap-4">
                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input
                        type="radio"
                        :value="1"
                        v-model="form.category_id"
                        class="h-5 w-5 text-blue-500 focus:ring-blue-500"
                    />
                    <span>{{ t("properties-form.house") }}</span>
                </label>
                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input
                        type="radio"
                        :value="2"
                        v-model="form.category_id"
                        class="h-5 w-5 text-blue-500 focus:ring-blue-500"
                    />
                    <span>{{ t("properties-form.apartment") }}</span>
                </label>
                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input
                        type="radio"
                        :value="3"
                        v-model="form.category_id"
                        class="h-5 w-5 text-blue-500 focus:ring-blue-500"
                    />
                    <span>{{ t("properties-form.land") }}</span>
                </label>
            </div>
            <InputError :message="form.errors.category_id" />
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6 md:mt-8">
            <div v-if="form.transaction_id === 2" class="space-y-2">
                <h1 class="text-md font-bold">
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
                <h1 class="text-md font-bold">Qual o valor do imóvel?</h1>
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
                <h1 class="text-md font-bold">Qual a área de superfície?</h1>
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

        <div
            class="mt-6 md:mt-8 space-y-2"
            v-if="form.transaction_id === 1 || form.transaction_id === 2"
        >
            <h1 class="text-md font-bold">Qual a morada do imóvel?</h1>
            <TextInput
                type="text"
                id="address"
                v-model="form.address"
                @input="fieldUpdated('address')"
            />
            <InputError :message="form.errors.address" class="mt-2" />
        </div>

        <div
            class="mt-6 md:mt-8 space-y-2"
            v-if="form.transaction_id === 1 || form.transaction_id === 2"
        >
            <h1 class="text-md font-bold">
                Qual distrito está localizado o imóvel?
            </h1>
            <select
                id="district"
                name="district"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm py-2 pl-3 pr-10"
                v-model="form.district"
                @change="fieldUpdated('district')"
            >
                <option v-for="dist in district" :key="dist" :value="dist">
                    {{ dist }}
                </option>
            </select>
            <InputError :message="form.errors.district" class="mt-2" />
        </div>

        <div class="mt-6 md:mt-8 space-y-2" v-if="form.district">
            <h1 class="text-md font-bold">
                Qual cidade está localizado o imóvel no distrito selecionado?
            </h1>
            <select
                id="district"
                name="district"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm py-2 pl-3 pr-10"
                v-if="form.district"
                v-model="form.city"
                @change="fieldUpdated('city')"
            >
                <option
                    v-for="city in cities[form.district]"
                    :key="city"
                    :value="city"
                >
                    {{ city }}
                </option>
            </select>
            <InputError :message="form.errors.city" class="mt-2" />
        </div>

        <div v-if="form.city" class="mt-4 mb-4">
            <h1 class="text-md font-bold">
                {{ t("properties-form.postalcode") }}
            </h1>
            <TextInput
                type="text"
                id="postal_code"
                readonly
                class="bg-gray-100"
                v-model="form.postal_code"
            />
        </div>

        <!-- Description -->
        <div class="mt-6 md:mt-8 space-y-2">
            <h1 class="text-md font-bold">
                {{ t("properties-form.description") }}
            </h1>
            <textarea
                id="description"
                v-model="form.description"
                class="w-full min-h-[120px] px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-black transition"
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
    district: Array,
    cities: Object,
    postal_code: Object,
});

const emit = defineEmits(["field-updated"]);

const fieldUpdated = (fieldName) => {
    emit("field-updated", fieldName);
};

const resetForm = () => {
    return props.form.reset();
};
</script>
