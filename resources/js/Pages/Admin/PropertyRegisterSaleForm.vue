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
                <h3 class="text-lg font-medium text-gray-800 mb-3">
                    {{ t("purchase-form.property-info") }}
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <InputLabel :value="t('purchase-form.property')" />
                        <p class="text-gray-900">{{ property.title }}</p>
                    </div>
                    <div>
                        <InputLabel :value="t('purchase-form.address')" />
                        <p class="text-gray-900">
                            {{ property.address }}, {{ property.city }},
                            {{ property.district }}, {{ property.postal_code }}
                        </p>
                    </div>
                    <div>
                        <InputLabel :value="t('purchase-form.sale-price')" />
                        <p class="text-gray-900">
                            {{ formatPrice(property.price) }}€
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg mb-6">
                <h3 class="text-lg font-medium text-gray-800 mb-3">
                    {{ t("purchase-form.property-owner") }}
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <InputLabel :value="t('purchase-form.owner')" />
                        <p class="text-gray-900">{{ owner.name }}</p>
                    </div>
                    <div>
                        <InputLabel :value="t('purchase-form.cc-number')" />
                        <p class="text-gray-900">
                            {{ owner.identification_number }}
                        </p>
                    </div>
                    <div>
                        <InputLabel :value="t('purchase-form.nif')" />
                        <p class="text-gray-900">
                            {{ owner.tax_number }}
                        </p>
                    </div>
                    <div>
                        <InputLabel :value="t('purchase-form.email')" />
                        <p class="text-gray-900">
                            {{ owner.email }}
                        </p>
                    </div>
                    <div>
                        <InputLabel :value="t('purchase-form.phone')" />
                        <p class="text-gray-900">
                            {{ owner.phone_number }}
                        </p>
                    </div>
                    <div>
                        <InputLabel :value="t('purchase-form.date-birth')" />
                        <p class="text-gray-900">
                            {{ owner.date_of_birth }}
                        </p>
                    </div>
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
                                        "null"
                                    }}
                                </option>
                            </select>
                        </div>

                        <div
                            v-if="form.buyer_id"
                            class="bg-gray-50 rounded-lg p-4"
                        >
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <InputLabel
                                        :value="t('purchase-form.buyer-name')"
                                    />
                                    <p class="text-gray-900">
                                        {{ showBuyersInfo(form.buyer_id).name }}
                                    </p>
                                </div>
                                <div>
                                    <InputLabel
                                        :value="t('purchase-form.cc-number')"
                                    />
                                    <p class="text-gray-900">
                                        {{
                                            showBuyersInfo(form.buyer_id)
                                                .identification_number
                                        }}
                                    </p>
                                </div>
                                <div>
                                    <InputLabel
                                        :value="t('purchase-form.nif')"
                                    />
                                    <p class="text-gray-900">
                                        {{
                                            showBuyersInfo(form.buyer_id)
                                                .tax_number
                                        }}
                                    </p>
                                </div>
                                <div>
                                    <InputLabel
                                        :value="t('purchase-form.date-birth')"
                                    />
                                    <p class="text-gray-900">
                                        {{
                                            showBuyersInfo(form.buyer_id)
                                                .date_of_birth
                                        }}
                                    </p>
                                </div>
                                <div>
                                    <InputLabel
                                        :value="t('purchase-form.email')"
                                    />
                                    <p class="text-gray-900">
                                        {{
                                            showBuyersInfo(form.buyer_id).email
                                        }}
                                    </p>
                                </div>
                                <div>
                                    <InputLabel
                                        :value="t('purchase-form.phone')"
                                    />
                                    <p class="text-gray-900">
                                        {{
                                            showBuyersInfo(form.buyer_id)
                                                .phone_number
                                        }}
                                    </p>
                                </div>
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
                            <InputLabel value="Métodos de pagamento" />
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
                                <option value="bank_transfer">
                                    {{ t("purchase-form.bank-transfer") }}
                                </option>
                                <option value="cheque">
                                    {{ t("purchase-form.cheque") }}
                                </option>
                                <option value="cash">
                                    {{ t("purchase-form.cash") }}
                                </option>
                            </select>
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

const { t } = useI18n();

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
                closeModal();
            },
        }
    );
};
</script>
