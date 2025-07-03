<template>
    <div
        class="max-w-5xl mx-auto p-4 sm:p-6 md:p-10 bg-white rounded-2xl shadow-md"
    >
        <div class="space-y-6">
            <div class="space-y-3">
                <h1 class="font-bold text-sm sm:text-base">
                    {{ t("properties-form.submit-images") }}
                </h1>
                <div class="space-y-1">
                    <input
                        type="file"
                        @change="handleImageChange"
                        multiple
                        accept="image/*"
                        dropzone
                        name="images[]"
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg shadow-sm focus:outline-none text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 file:rounded-lg file:cursor-pointer"
                    />
                    <p class="text-xs text-gray-500">
                        {{ t("properties-form.supported-images") }}
                    </p>
                    <InputError :message="form.errors.images" class="mt-1" />
                </div>
            </div>
            <div class="space-y-3">
                <h1 class="font-bold text-sm sm:text-base">
                    {{ t("properties-form.submit-docs") }}
                </h1>
                <div class="space-y-1">
                    <input
                        type="file"
                        @change="handleDocumentChange"
                        multiple
                        accept=".pdf,.doc,.docx"
                        name="documents[]"
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg shadow-sm focus:outline-none text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 file:rounded-lg file:cursor-pointer"
                    />
                    <p class="text-xs text-gray-500">
                        {{ t("properties-form.supported-docs") }}
                    </p>
                    <InputError :message="form.errors.documents" class="mt-1" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useI18n } from "vue-i18n";
import InputError from "@/Components/InputError.vue";

const { t } = useI18n();

const props = defineProps({
    form: Object,
});

const handleImageChange = (e) => {
    props.form.images = Array.from(e.target.files);
};

const handleDocumentChange = (e) => {
    props.form.documents = Array.from(e.target.files);
};
</script>
