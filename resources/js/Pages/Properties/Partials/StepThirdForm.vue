<template>
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <div>
            <div class="mt-3">
                <h1 class="text-xl text-center">
                    {{ t("properties-form.files-upload") }}
                </h1>
                <InputLabel for="upload" :value="t('properties-form.image')" />
                <input
                    type="file"
                    @change="handleImageChange"
                    multiple
                    name="images[]"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                />
                <InputError :message="form.errors.images" class="mt-2" />
            </div>
            <div class="mt-3">
                <InputLabel
                    for="upload"
                    :value="t('properties-form.documents')"
                />
                <input
                    type="file"
                    @change="handleDocumentChange"
                    multiple
                    name="documents[]"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                />
                <InputError :message="form.errors.documents" class="mt-2" />
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

const handleImageChange = (e) => {
    props.form.images = Array.from(e.target.files);
};

const handleDocumentChange = (e) => {
    props.form.documents = Array.from(e.target.files);
};
</script>
