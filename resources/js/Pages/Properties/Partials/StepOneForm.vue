<template>
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-xl text-center">
            {{ t("properties-form.info_property") }}
        </h1>

        <div class="mt-3">
            <InputLabel
                for="category_id"
                :value="t('properties-form.category')"
            />
            <select
                id="category_id"
                name="category_id"
                v-model="form.category_id"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                required
                @change="fieldUpdated('category_id')"
            >
                <option :value="1">{{ t("properties-form.house") }}</option>
                <option :value="2">
                    {{ t("properties-form.apartment") }}
                </option>
                <option :value="3">{{ t("properties-form.land") }}</option>
            </select>
            <InputError :message="form.errors.category_id" />
        </div>

        <div class="mt-3">
            <InputLabel
                for="transaction_id"
                :value="t('properties-form.transaction')"
            />
            <select
                id="transaction_id"
                name="transaction_id"
                v-model="form.transaction_id"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                required
                @change="fieldUpdated('transaction_id')"
            >
                <option :value="1">{{ t("properties-form.sell") }}</option>
                <option :value="2">{{ t("properties-form.rent") }}</option>
            </select>
            <InputError :message="form.errors.transaction_id" />
        </div>

        <div class="mt-3">
            <InputLabel for="title" :value="t('properties-form.title')" />
            <TextInput
                type="text"
                id="title"
                v-model="form.title"
                @input="fieldUpdated('title')"
            />
            <InputError :message="form.errors.title" class="mt-2" />
        </div>

        <div class="grid grid-cols-2 gap-4 mt-3">
            <div v-if="form.transaction_id === 2">
                <InputLabel
                    for="price"
                    :value="t('properties-form.price-rent')"
                />
                <TextInput
                    type="number"
                    id="price"
                    v-model="form.price"
                    @input="fieldUpdated('price')"
                />
                <InputError :message="form.errors.price" class="mt-2" />
            </div>
            <div v-if="form.transaction_id === 1">
                <InputLabel for="price" :value="t('properties-form.price')" />
                <TextInput
                    type="number"
                    id="price"
                    v-model="form.price"
                    @input="fieldUpdated('price')"
                />
                <InputError :message="form.errors.price" class="mt-2" />
            </div>
            <div v-if="form.transaction_id === 1 || form.transaction_id === 2">
                <InputLabel
                    for="square_meters"
                    :value="t('properties-form.surface')"
                />
                <TextInput
                    type="number"
                    id="square_meters"
                    v-model="form.square_meters"
                    @input="fieldUpdated('square_meters')"
                />
                <InputError :message="form.errors.square_meters" class="mt-2" />
            </div>
        </div>
        <div class="mt-3">
            <InputLabel
                for="description"
                :value="t('properties-form.description')"
            />
            <textarea
                id="description"
                v-model="form.description"
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                required
                @input="fieldUpdated('description')"
            ></textarea>
            <InputError :message="form.errors.description" class="mt-2" />
        </div>
    </div>
</template>

<script setup>
import InputLabel from "@/Components/InputLabel.vue";
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
</script>
