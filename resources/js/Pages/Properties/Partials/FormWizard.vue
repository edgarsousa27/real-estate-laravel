<template>
    <div>
        <div v-if="step === 1">
            <StepOneForm :form="form" @field-updated="clearError" />
        </div>

        <div v-if="step === 2">
            <StepTwoForm
                :form="form"
                :district="props.district"
                :cities="props.cities"
                :postal_code="props.postal_code"
                @field-updated="clearError"
            />
        </div>

        <div v-if="step === 3">
            <StepThirdForm
                :form="form"
                :district="props.district"
                :cities="props.cities"
                :postal_code="props.postal_code"
                @field-updated="clearError"
            />
        </div>

        <div class="flex justify-center mt-4 space-x-4">
            <button
                @click="prevStep"
                v-if="step > 1"
                class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
            >
                Back
            </button>
            <button
                @click="nextStep"
                type="submit"
                class="px-6 py-2 border border-transparent rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
            >
                {{ step === totalSteps ? "Submit" : "Next" }}
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref, watch } from "vue";
import StepOneForm from "./StepOneForm.vue";
import StepTwoForm from "./StepTwoForm.vue";
import StepThirdForm from "./StepThirdForm.vue";
import { useForm } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";

const { t } = useI18n();

const props = defineProps({
    properties: Array,
    district: Array,
    cities: Object,
    postal_code: Object,
});

const step = ref(1);
const totalSteps = 3;

const form = useForm({
    category_id: null,
    transaction_id: null,
    title: "",
    description: "",
    address: "",
    price: null,
    square_meters: null,
    city: "",
    district: "",
    postal_code: "",
    bathrooms: null,
    bedrooms: null,
    parking_spaces: null,
    images: [],
});

const validateStepOne = () => {
    form.clearErrors();

    if (!form.category_id)
        form.setError("category_id", t("form-errors.category"));
    if (!form.transaction_id)
        form.setError("transaction_id", t("form-errors.transaction"));
    if (!form.title) form.setError("title", t("form-errors.title"));
    if (!form.price) form.setError("price", t("form-errors.price"));
    if (!form.square_meters)
        form.setError("square_meters", t("form-errors.square_meters"));
    if (!form.description)
        form.setError("description", t("form-errors.description"));

    return Object.keys(form.errors).length === 0;
};

const validateStepTwo = () => {
    form.clearErrors();

    if (!form.bathrooms) form.setError("bathrooms", t("form-errors.bathrooms"));
    if (!form.bedrooms) form.setError("bedrooms", t("form-errors.bedrooms"));

    return Object.keys(form.errors).length === 0;
};

const validateThirdStep = () => {
    if (!form.address) form.setError("address", t("form-errors.address"));
    if (!form.district) form.setError("district", t("form-errors.district"));
    if (!form.city) form.setError("city", t("form-errors.city"));
    if (!form.images) form.setError("images", t("form-errors.images"));

    return Object.keys(form.errors).length === 0;
};

const clearError = (fieldName) => {
    if (form.errors[fieldName]) {
        form.clearErrors(fieldName);
    }
};

const nextStep = () => {
    if (step.value === 1 && !validateStepOne()) return;
    if (step.value === 2 && !validateStepTwo()) return;
    if (step.value === 3 && !validateThirdStep()) return;

    if (step.value < totalSteps) {
        step.value++;
        form.clearErrors();
    } else {
        form.post(route("properties.store"), {
            forceFormData: true,
            onSuccess: () => {
                form.reset();
            },
        });
    }
};

const prevStep = () => {
    if (step.value > 1) {
        step.value--;
        form.clearErrors();
    }
};

watch(
    () => form.city,
    (newCity) => {
        if (newCity && form.district) {
            const key = `${form.district}|${newCity}`;
            if (props.postal_code[key]) {
                form.postal_code = props.postal_code[key];
            } else {
                form.postal_code = "";
            }
        }
    }
);

watch(
    () => form.district,
    () => {
        form.city = "";
        form.postal_code = "";
    }
);
</script>
