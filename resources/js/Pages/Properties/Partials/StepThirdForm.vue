<template>
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <div>
            <h1 class="text-xl text-center">
                {{ t("properties-form.localization") }}
            </h1>
            <div class="mt-3">
                <InputLabel
                    for="address"
                    :value="t('properties-form.address')"
                />
                <TextInput
                    type="text"
                    id="address"
                    v-model="form.address"
                    @input="fieldUpdated('address')"
                />
                <InputError :message="form.errors.address" class="mt-2" />
            </div>
            <div class="mt-3">
                <InputLabel
                    for="district"
                    :value="t('properties-form.district')"
                />
                <select
                    id="district"
                    name="district"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 pl-3 pr-10"
                    v-model="form.district"
                    @change="fieldUpdated('district')"
                >
                    <option v-for="dist in district" :key="dist" :value="dist">
                        {{ dist }}
                    </option>
                </select>
                <InputError :message="form.errors.district" class="mt-2" />
            </div>
            <div class="mt-3" v-if="form.district">
                <InputLabel for="city" :value="t('properties-form.city')" />
                <select
                    id="district"
                    name="district"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 pl-3 pr-10"
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
                <InputLabel
                    for="postal_code"
                    :value="t('properties-form.postalcode')"
                />
                <TextInput
                    type="text"
                    id="postal_code"
                    readonly
                    class="bg-gray-100"
                    v-model="form.postal_code"
                />
            </div>
        </div>
        <div class="mt-3">
            <h1 class="text-xl text-center">
                {{ t("properties-form.image") }}
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
</script>
