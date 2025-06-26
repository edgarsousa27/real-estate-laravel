<template>
    <Head>
        <title>{{ t("purchase-form.title") }}</title>
    </Head>
    <AdminLayout title="Gestão de contratos de arrendamentos">
        <div class="px-4 sm:px-6 py-4 bg-white rounded-lg shadow">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <Link
                    :href="route('admin.properties')"
                    class="text-blue-600 hover:text-blue-800 flex items-center"
                >
                    <font-awesome-icon icon="arrow-left" class="mr-2" />
                    {{ t("purchase-form.back-to-properties") }}
                </Link>
                <h2 class="text-xl sm:text-2xl font-semibold text-gray-800">
                    {{ t("purchase-form.new-rent-contract") }}
                </h2>
            </div>

            <!-- Property Info -->
            <div class="bg-gray-50 p-4 rounded-lg mb-6">
                <h3 class="text-lg font-medium text-gray-800 mb-3">
                    {{ t("purchase-form.property-info") }}
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <DetailItem
                        :label="t('purchase-form.property')"
                        :value="property.title"
                    />
                    <DetailItem
                        :label="t('purchase-form.address')"
                        :value="`${property.address}, ${property.city}, ${property.district}, ${property.postal_code}`"
                    />
                    <DetailItem
                        :label="t('purchase-form.sale-price')"
                        :value="formatPrice(property.price + '€')"
                    />
                </div>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg mb-6">
                <h3 class="text-lg font-medium text-gray-800 mb-3">
                    {{ t("purchase-form.landlord-info") }}
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <DetailItem
                        :label="t('purchase-form.landlord')"
                        :value="landlord.name"
                    />
                    <DetailItem
                        :label="t('purchase-form.cc-number')"
                        :value="landlord.identification_number"
                    />
                    <DetailItem
                        :label="t('purchase-form.nif')"
                        :value="landlord.tax_number"
                    />
                    <DetailItem
                        :label="t('purchase-form.email')"
                        :value="landlord.email"
                    />
                    <DetailItem
                        :label="t('purchase-form.phone')"
                        :value="landlord.phone_number"
                    />
                    <DetailItem
                        :label="t('purchase-form.date-birth')"
                        :value="
                            landlord.date_of_birth ||
                            t('purchase-form.undisclosed')
                        "
                    />
                </div>
            </div>

            <!-- Purchase Form -->
            <form @submit.prevent="submitForm">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Buyer Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-800">
                            {{ t("purchase-form.tenant-info") }}
                        </h3>

                        <div>
                            <InputLabel :value="t('purchase-form.tenant')" />
                            <select
                                v-model="form.tenant_id"
                                class="w-full rounded-md border-gray-300 shadow-sm"
                                required
                            >
                                <option value="">
                                    {{ t("purchase-form.select-tenant") }}
                                </option>
                                <option
                                    v-for="tenant in tenants"
                                    :key="tenant.id"
                                    :value="tenant.id"
                                >
                                    {{ tenant.name }} -
                                    {{
                                        "NIF: " +
                                            tenant.identification_number ||
                                        t("purchase-form.undisclosed")
                                    }}
                                </option>
                            </select>
                        </div>

                        <div
                            v-if="form.tenant_id"
                            class="bg-gray-50 rounded-lg p-4"
                        >
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <DetailItem
                                    :label="t('purchase-form.buyer-name')"
                                    :value="showBuyersInfo(form.tenant_id).name"
                                />
                                <DetailItem
                                    :label="t('purchase-form.cc-number')"
                                    :value="
                                        showBuyersInfo(form.tenant_id)
                                            .identification_number
                                    "
                                />
                                <DetailItem
                                    :label="t('purchase-form.nif')"
                                    :value="
                                        showBuyersInfo(form.tenant_id)
                                            .tax_number
                                    "
                                />
                                <DetailItem
                                    :label="t('purchase-form.date-birth')"
                                    :value="
                                        showBuyersInfo(form.tenant_id)
                                            .date_of_birth ||
                                        t('purchase-form.undisclosed')
                                    "
                                />
                                <DetailItem
                                    :label="t('purchase-form.email')"
                                    :value="
                                        showBuyersInfo(form.tenant_id).email
                                    "
                                />
                                <DetailItem
                                    :label="t('purchase-form.phone')"
                                    :value="
                                        showBuyersInfo(form.tenant_id)
                                            .phone_number
                                    "
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Purchase Details -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-800">
                            {{ t("purchase-form.purchase-details") }}
                        </h3>
                        <div>
                            <InputLabel
                                :value="t('purchase-form.final-price')"
                            />
                            <TextInput
                                type="number"
                                v-model="form.price"
                                class="w-full"
                                required
                                :placeholder="props.property.price"
                            />
                        </div>
                        <div>
                            <InputLabel
                                :value="t('purchase-form.payment_methods')"
                            />
                            <select
                                v-model="form.payment_method"
                                class="w-full rounded-md border-gray-300 shadow-sm"
                                required
                            >
                                <option value="">
                                    {{
                                        t("purchase-form.select-payment-method")
                                    }}
                                </option>
                                <option value="Transferência bancária">
                                    {{ t("purchase-form.bank-transfer") }}
                                </option>
                                <option value="Cheque">
                                    {{ t("purchase-form.cheque") }}
                                </option>
                                <option value="Numerário">
                                    {{ t("purchase-form.cash") }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <InputLabel value="Início contrato" />
                            <TextInput
                                type="date"
                                v-model="form.start_contract"
                                class="w-full"
                                required
                            />
                        </div>
                        <div>
                            <InputLabel value="Final contrato" />
                            <TextInput
                                type="date"
                                v-model="form.end_contract"
                                class="w-full"
                                required
                            />
                        </div>
                        <div>
                            <InputLabel value="Comissão" />
                            <TextInput
                                type="number"
                                v-model="form.commission"
                                class="w-full"
                                required
                                placeholder="5"
                            />
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="mt-8 flex justify-end space-x-3">
                    <Link
                        :href="route('admin.properties')"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300"
                    >
                        {{ t("purchase-form.cancel") }}
                    </Link>
                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                        :disabled="form.processing"
                    >
                        <span v-if="!form.processing">
                            {{ t("purchase-form.create-contract") }}
                        </span>
                        <span v-else>
                            <font-awesome-icon
                                icon="spinner"
                                spin
                                class="mr-1"
                            />
                            {{ t("purchase-form.processing") }}
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Link, useForm, Head } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import DetailItem from "@/Components/DetailItem.vue";
import { useToast } from "vue-toastification";

const { t } = useI18n();
const toast = useToast();

const props = defineProps({
    property: Object,
    tenants: Array,
    landlord: Object,
});

const form = useForm({
    tenant_id: props.property.buyer_id,
    landlord_id: props.landlord.id,
    property_id: props.property.id,
    price: null,
    status: "rented",
    payment_method: "",
    start_contract: "",
    end_contract: "",
    commission: null,
});

const formatPrice = (price) => {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
};

const showBuyersInfo = () => {
    return props.tenants.find((b) => b.id === form.tenant_id);
};

const submitForm = () => {
    form.post(
        route("admin.properties.acceptrent", { property: props.property.slug }),
        {
            preserveScroll: true,
            onSuccess: () => {
                toast.info("Contrato de arrendamento criado!");
            },
            onError: () => {
                toast.error(t("notifications.error.rent-contract"));
            },
        }
    );
};
</script>
