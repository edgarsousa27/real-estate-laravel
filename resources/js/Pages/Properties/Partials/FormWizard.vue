<template>
    <div>
        <div v-if="step === 1">
            <StepOneForm
                :form="form"
                @field-updated="clearError"
                :district="props.district"
                :cities="props.cities"
                :postal_code="props.postal_code"
            />
        </div>

        <div v-if="step === 2 && form.category_id !== 3">
            <StepTwoForm
                :form="form"
                :district="props.district"
                :cities="props.cities"
                :postal_code="props.postal_code"
                @field-updated="clearError"
            />
        </div>

        <div
            v-if="
                (step === 2 && form.category_id === 3) ||
                (step === 3 && form.category_id !== 3)
            "
        >
            <StepThirdForm :form="form" @field-updated="clearError" />
        </div>

        <div class="flex justify-center mt-4 space-x-4">
            <button
                @click="prevStep"
                v-if="step > 1"
                class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
            >
                {{ t("properties-form.back") }}
            </button>
            <button
                @click="nextStep"
                type="submit"
                class="px-6 py-2 border border-transparent rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
            >
                {{
                    isLastStep
                        ? t("properties-form.submit")
                        : t("properties-form.next")
                }}
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, watch } from "vue";
import StepOneForm from "./StepOneForm.vue";
import StepTwoForm from "./StepTwoForm.vue";
import StepThirdForm from "./StepThirdForm.vue";
import { useForm } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";
import { useToast } from "vue-toastification";

const { t } = useI18n();
const toast = useToast();

const props = defineProps({
    properties: Array,
    district: Array,
    cities: Object,
    postal_code: Object,
});

const step = ref(1);

const totalSteps = computed(() => {
    return form.category_id === 3 ? 2 : 3;
});

const isLastStep = computed(() => {
    return step.value === totalSteps.value;
});

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
    documents: [],

    heating: false,
    cooling: false,
    kitchen_equipped: false,
    double_glazing: false,
    security_alarm_system: false,
    fire_alarm_system: false,
    garden: false,
    balcony: false,
    terrace: false,
    solar_panels: false,
    thermal_insulation: false,
    fireplace: false,
    storage: false,
    swimming_pool: false,
    sea_view: false,
    mountain_view: false,
    open_plan_kitchen: false,
    smart_home: false,
    furnished: false,
    building_pool: false,
    building_gym: false,
    wheelchair_access: false,
    elevator: false,
    garage: false,
    kitchen: false,
    well_water: false,
    electricity: false,
    energy_consumption: null,
});

const validateStepOne = () => {
    form.clearErrors();

    if (!form.category_id)
        form.setError("category_id", t("form-errors.category"));
    if (!form.transaction_id)
        form.setError("transaction_id", t("form-errors.transaction"));
    if (!form.price) form.setError("price", t("form-errors.price"));
    if (!form.square_meters)
        form.setError("square_meters", t("form-errors.square_meters"));
    if (!form.description)
        form.setError("description", t("form-errors.description"));
    if (!form.address) form.setError("address", t("form-errors.address"));
    if (!form.district) form.setError("district", t("form-errors.district"));
    if (!form.city) form.setError("city", t("form-errors.city"));

    return Object.keys(form.errors).length === 0;
};

const validateSecondStep = () => {
    form.clearErrors();

    if (!form.bathrooms) form.setError("bathrooms", t("form-errors.bathrooms"));
    if (!form.bedrooms) form.setError("bedrooms", t("form-errors.bedrooms"));
    if (!form.energy_consumption)
        form.setError(
            "energy_consumption",
            t("form-errors.energy_consumption")
        );

    return Object.keys(form.errors).length === 0;
};

const validateThirdStep = () => {
    form.clearErrors();

    if (form.images.length <= 0)
        form.setError("images", t("form-errors.images"));
    if (form.documents.length <= 0)
        form.setError("documents", t("form-errors.documents"));

    return Object.keys(form.errors).length === 0;
};

const clearError = (fieldName) => {
    if (form.errors[fieldName]) {
        form.clearErrors(fieldName);
    }
};

const nextStep = () => {
    if (step.value === 1 && !validateStepOne()) return;
    if (step.value === 2) {
        if (form.category_id === 3) {
            if (!validateThirdStep()) return;
        } else {
            if (!validateSecondStep()) return;
        }
    }

    if (step.value === 3 && form.category_id !== 3 && !validateThirdStep())
        return;

    if (isLastStep.value) {
        form.post(route("properties.store"), {
            forceFormData: true,
            onSuccess: () => {
                toast.success(t("notifications.property.add"));
                form.reset();
                step.value = 1;
            },
            onError: () => {
                toast.error(t("notifications.error.create-property"));
            },
        });
    } else {
        step.value++;
        form.clearErrors();
    }
};

const prevStep = () => {
    if (step.value > 1) {
        step.value--;
        form.clearErrors();
    }
};

watch(
    () => form.category_id,
    (newCategory, oldCategory) => {
        if (newCategory !== oldCategory && step.value > 1) {
            step.value = 1;
            form.clearErrors();
        }
    }
);

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
