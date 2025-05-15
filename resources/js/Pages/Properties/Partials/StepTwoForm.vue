<template>
    <div class="max-w-3xl mx-auto p-4 sm:p-6 bg-white rounded-lg shadow-md">
        <div v-if="form.category_id === 1 || form.category_id === 2">
            <h1 class="text-lg sm:text-xl text-center mb-4">
                {{ t("properties-form.features") }}
            </h1>

            <div
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6"
            >
                <div class="space-y-2">
                    <InputLabel
                        for="bathrooms"
                        :value="t('properties-form.bathrooms')"
                    />
                    <TextInput
                        type="number"
                        id="bathrooms"
                        v-model="form.bathrooms"
                        @input="fieldUpdated('bathrooms')"
                        class="w-full"
                    />
                    <InputError :message="form.errors.bathrooms" class="mt-1" />
                </div>

                <div class="space-y-2">
                    <InputLabel
                        for="bedrooms"
                        :value="t('properties-form.bedrooms')"
                    />
                    <TextInput
                        type="number"
                        id="bedrooms"
                        v-model="form.bedrooms"
                        @input="fieldUpdated('bedrooms')"
                        class="w-full"
                    />
                    <InputError :message="form.errors.bedrooms" class="mt-1" />
                </div>

                <div class="space-y-2">
                    <InputLabel
                        for="parking-spaces"
                        :value="t('properties-form.parking-spaces')"
                    />
                    <TextInput
                        type="number"
                        id="parking_spaces"
                        v-model="form.parking_spaces"
                        class="w-full"
                    />
                    <InputError
                        :message="form.errors.parking_spaces"
                        class="mt-1"
                    />
                </div>

                <div class="sm:col-span-2 lg:col-span-3 space-y-2">
                    <HighLightsForm :form="props.form" />
                </div>
            </div>
        </div>
        <div v-if="form.category_id === 3">
            <h1 class="text-lg sm:text-xl text-center mb-4">
                {{ t("properties-form.features") }}
            </h1>

            <div class="sm:col-span-2 lg:col-span-3 space-y-2">
                <HighLightsForm :form="props.form" />
            </div>
        </div>
    </div>
</template>

<script setup>
import { useI18n } from "vue-i18n";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import HighLightsForm from "./HighLightsForm.vue";

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
</script>
