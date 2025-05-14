<template>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <div v-if="form.category_id === 1 || form.category_id === 2">
            <h1 class="text-xl text-center mb-3">Características do Imóvel</h1>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <InputLabel
                        for="bathrooms"
                        :value="t('properties-form.bathrooms')"
                    />
                    <TextInput
                        type="number"
                        id="bathrooms"
                        v-model="form.bathrooms"
                        @input="fieldUpdated('bathrooms')"
                    />
                    <InputError :message="form.errors.bathrooms" class="mt-2" />
                </div>
                <div>
                    <InputLabel
                        for="bedrooms"
                        :value="t('properties-form.bedrooms')"
                    />
                    <TextInput
                        type="number"
                        id="bedrooms"
                        v-model="form.bedrooms"
                        @input="fieldUpdated('bedrooms')"
                    />
                    <InputError :message="form.errors.bedrooms" class="mt-2" />
                </div>
                <div>
                    <InputLabel
                        for="parking-spaces"
                        :value="t('properties-form.parking-spaces')"
                    />
                    <TextInput
                        type="number"
                        id="parking_spaces"
                        v-model="form.parking_spaces"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useI18n } from "vue-i18n";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";

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
