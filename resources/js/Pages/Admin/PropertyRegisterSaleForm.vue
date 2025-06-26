<template>
    <Head>
        <title>{{ t("purchase-form.title") }}</title>
    </Head>
    <AdminLayout :title="t('purchase-form.title')">
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
                    {{ t("purchase-form.new-purchase-contract") }}
                </h2>
            </div>

            <!-- Property Info -->
            <div class="bg-gray-50 p-4 rounded-lg mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">
                    <font-awesome-icon icon="home" class="mr-2" />
                    {{ t("purchase-form.property-info") }}
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <DetailItem
                        :label="t('purchase-form.property')"
                        :value="$t(property.title, property.title_params)"
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
                <h3 class="text-lg font-semibold text-gray-800 mb-3">
                    <font-awesome-icon icon="user" class="mr-2" />
                    {{ t("purchase-form.property-owner") }}
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <DetailItem
                        :label="t('purchase-form.owner')"
                        :value="owner.name"
                    />
                    <DetailItem
                        :label="t('purchase-form.cc-number')"
                        :value="owner.identification_number"
                    />
                    <DetailItem
                        :label="t('purchase-form.nif')"
                        :value="owner.tax_number"
                    />
                    <DetailItem
                        :label="t('purchase-form.email')"
                        :value="owner.email"
                    />
                    <DetailItem
                        :label="t('purchase-form.phone')"
                        :value="owner.phone_number"
                    />
                    <DetailItem
                        :label="t('purchase-form.date-birth')"
                        :value="
                            owner.date_of_birth ||
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
                            {{ t("purchase-form.buyer-info") }}
                        </h3>

                        <div>
                            <InputLabel :value="t('purchase-form.buyer')" />
                            <select
                                v-model="form.buyer_id"
                                class="w-full rounded-md border-gray-300 shadow-sm"
                                required
                            >
                                <option value="">
                                    {{ t("purchase-form.select-buyer") }}
                                </option>
                                <option
                                    v-for="buyer in buyers"
                                    :key="buyer.id"
                                    :value="buyer.id"
                                >
                                    {{ buyer.name }} -
                                    {{
                                        "NIF: " + buyer.identification_number ||
                                        t("purchase-form.undisclosed")
                                    }}
                                </option>
                            </select>
                        </div>

                        <div
                            v-if="form.buyer_id"
                            class="bg-gray-50 rounded-lg p-4"
                        >
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <DetailItem
                                    :label="t('purchase-form.buyer-name')"
                                    :value="showBuyersInfo(form.buyer_id).name"
                                />
                                <DetailItem
                                    :label="t('purchase-form.cc-number')"
                                    :value="
                                        showBuyersInfo(form.buyer_id)
                                            .identification_number
                                    "
                                />
                                <DetailItem
                                    :label="t('purchase-form.nif')"
                                    :value="
                                        showBuyersInfo(form.buyer_id).tax_number
                                    "
                                />
                                <DetailItem
                                    :label="t('purchase-form.date-birth')"
                                    :value="
                                        showBuyersInfo(form.buyer_id)
                                            .date_of_birth ||
                                        t('purchase-form.undisclosed')
                                    "
                                />
                                <DetailItem
                                    :label="t('purchase-form.email')"
                                    :value="showBuyersInfo(form.buyer_id).email"
                                />
                                <DetailItem
                                    :label="t('purchase-form.phone')"
                                    :value="
                                        showBuyersInfo(form.buyer_id)
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
                                v-model="form.final_price"
                                class="w-full"
                                required
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
    buyers: Array,
    owner: Object,
});

const form = useForm({
    buyer_id: props.property.buyer_id,
    property_id: props.property.id,
    final_price: null,
    status: "sold",
    payment_method: "",
    commission: null,
});

const formatPrice = (price) => {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
};

const showBuyersInfo = () => {
    return props.buyers.find((b) => b.id === form.buyer_id);
};

const submitForm = () => {
    form.post(
        route("admin.properties.accept", { property: props.property.slug }),
        {
            preserveScroll: true,
            onSuccess: () => {
                toast.info("Contrato de compra criado!");
            },
            onError: () => {
                toast.error(t("notifications.error.buy-contract"));
            },
        }
    );
};
</script>
