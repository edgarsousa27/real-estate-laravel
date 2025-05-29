<template>
    <Head>
        <title>{{ t("admin-dashboard.property-details") }}</title>
    </Head>
    <AdminLayout title="Property Details">
        <div class="px-6 py-4 bg-white rounded-lg shadow">
            <!-- Approval Status Banner -->
            <div
                v-if="props.property.status === 'pending'"
                class="mb-6 p-4 bg-yellow-50 border-l-4 border-yellow-400"
            >
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <font-awesome-icon
                            icon="exclamation-triangle"
                            class="h-5 w-5 text-yellow-400"
                        />
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            {{ t("admin-dashboard.property-details-text") }}
                            <span class="font-bold">{{
                                t("admin-dashboard.property-details-text2")
                            }}</span
                            >. {{ t("admin-dashboard.property-details-text3") }}
                        </p>
                    </div>
                </div>
            </div>
            <div
                v-if="props.property.status === 'active'"
                class="mb-6 p-4 bg-green-50 border-l-4 border-green-400"
            >
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <font-awesome-icon
                            icon="check"
                            class="h-5 w-5 text-green-400"
                        />
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">
                            {{ t("admin-dashboard.property-details-text") }}
                            <span class="font-bold">{{
                                t("admin-dashboard.active")
                            }}</span
                            >.
                        </p>
                    </div>
                </div>
            </div>
            <div
                v-if="props.property.status === 'refused'"
                class="mb-6 p-4 bg-red-50 border-l-4 border-red-400"
            >
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <font-awesome-icon
                            icon="xmark"
                            class="h-5 w-5 text-red-400"
                        />
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">
                            {{ t("admin-dashboard.refused-text") }}
                            <span class="font-bold"> {{ t("admin-dashboard.refused") }}.</span>
                             {{ t("admin-dashboard.refused-owner") }}
                            <p class="text-lg text-red-700">{{ t("admin-dashboard.reason") }} {{ props.property.reason_for_refusal }}
                            </p>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Property Header -->
            <div
                class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6"
            >
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">
                        {{ props.property.title }}
                    </h2>
                    <p class="text-gray-600">
                        {{ props.property.address }}, {{ props.property.city }},
                        {{ props.property.district }} -
                        {{ props.property.postal_code }}
                    </p>
                </div>

                <div
                    class="flex space-x-3 mt-4 md:mt-0"
                    v-if="props.property.status === 'pending'"
                >
                    <form @submit.prevent="activeProperty" class="flex gap-5">
                        <button
                            type="submit"
                            @click="form.status = 'active'"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md flex items-center"
                        >
                            <font-awesome-icon icon="check" class="mr-2" />
                            {{ t("admin-dashboard.accept") }}
                        </button>    
                        <button
                            type="button"
                            @click="openUpdateModal(property)"
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md flex items-center"
                        >
                            <font-awesome-icon icon="times" class="mr-2" />
                            {{ t("admin-dashboard.refuse") }}
                        </button>
                    </form>
                </div>

                <div
                    class="flex space-x-3 mt-4 md:mt-0"
                    v-if="props.property.status === 'active'"
                >
                        <button
                            type="button"
                            @click="openUpdateStatusModal(property)"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center"
                        >
                            <font-awesome-icon icon="pen-to-square" class="mr-2" />
                            Editar
                        </button> 
                </div>
            </div>

            <!-- Property Details Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Main Property Info -->
                <div class="md:col-span-2">
                    <!-- Image Gallery -->
                    <div class="mb-6">
                        <div
                            class="w-full sm:rounded-lg md:rounded-xl overflow-hidden"
                        >
                            <PropertiesShow
                                :images="props.property.media"
                                :properties="props.property"
                            />
                        </div>
                        <div class="grid grid-cols-4 gap-2 mt-2"></div>
                    </div>

                    <EssentialsHighlights :properties="props.property" />
                    <hr
                        class="my-8"
                        v-if="
                            props.property.category_id === 1 ||
                            props.property.category_id === 2
                        "
                    />
                    <InteriorHighlights
                        v-if="
                            props.property.category_id === 1 ||
                            props.property.category_id === 2
                        "
                        :properties="props.property"
                    />
                    <hr
                        class="my-8"
                        v-if="
                            props.property.category_id === 1 ||
                            props.property.category_id === 2
                        "
                    />
                    <OutdoorHighlights
                        v-if="
                            props.property.category_id === 1 ||
                            props.property.category_id === 2
                        "
                        :properties="props.property"
                    />
                    <hr class="my-8" />

                    <!-- Description -->
                    <div class="mt-6">
                        <h3 class="text-xl font-semibold mb-4 mt-4 ml-3">
                            {{ t("admin-dashboard.description") }}
                        </h3>
                        <p class="mb-4 mt-4 ml-3 text-gray-600 whitespace-pre-line">
                            {{ props.property.description }}
                        </p>
                    </div>

                    <hr class="my-8" />

                    <EnergyBalance  :properties="props.property" v-if="
                            props.property.category_id === 1 ||
                            props.property.category_id === 2
                        "/>
                </div>

                <!-- User Info and Sidebar -->
                <div class="space-y-6">
                    <!-- Owner/Agent Info -->
                    <div
                        class="bg-white border border-gray-200 rounded-lg shadow p-4"
                    >
                        <h3 class="text-lg font-medium text-gray-800 mb-4">
                            {{ t("admin-dashboard.submitted-by") }}
                        </h3>
                        <div class="flex items-center space-x-4 mb-4">
                            <div>
                                <p class="font-medium text-gray-900">
                                    {{ props.property.user.name }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ props.property.user.role }}
                                </p>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div
                                class="flex items-center text-sm text-gray-600"
                            >
                                <font-awesome-icon
                                    icon="envelope"
                                    class="mr-2 text-gray-400"
                                />
                                {{ props.property.user.email }}
                            </div>
                            <div
                                class="flex items-center text-sm text-gray-600"
                            >
                                <font-awesome-icon
                                    icon="map"
                                    class="mr-2 text-gray-400"
                                />
                                {{
                                    props.property.user.nationality ||
                                    t("admin-dashboard.not-provided")
                                }}
                            </div>
                            <div
                                class="flex items-center text-sm text-gray-600"
                            >
                                <font-awesome-icon
                                    icon="id-card"
                                    class="mr-2 text-gray-400"
                                />
                                {{
                                    "ID: " +
                                        props.property.user
                                            .identification_number ||
                                    t("admin-dashboard.not-provided")
                                }}
                            </div>
                            <div
                                class="flex items-center text-sm text-gray-600"
                            >
                                <font-awesome-icon
                                    icon="id-card"
                                    class="mr-2 text-gray-400"
                                />
                                {{
                                    "NIF: " + props.property.user.tax_number ||
                                    t("admin-dashboard.not-provided")
                                }}
                            </div>
                            <div
                                class="flex items-center text-sm text-gray-600"
                            >
                                <font-awesome-icon
                                    icon="phone"
                                    class="mr-2 text-gray-400"
                                />
                                {{
                                    props.property.user.phone_number ||
                                    t("admin-dashboard.not-provided")
                                }}
                            </div>
                            <div
                                class="flex items-center text-sm text-gray-600"
                            >
                                <font-awesome-icon
                                    icon="clock"
                                    class="mr-2 text-gray-400"
                                />
                                {{ t("admin-dashboard.submitted-in") }}:
                                {{ formatDate(props.property.created_at) }}
                            </div>
                            <div
                                v-if="props.property.status === 'active'"
                                class="flex items-center text-sm text-gray-600"
                            >
                                <font-awesome-icon
                                    icon="clock"
                                    class="mr-2 text-gray-400"
                                />
                                {{ t("admin-dashboard.active-in") }}:
                                {{ formatDate(props.property.updated_at) }}
                            </div>
                            <div
                                v-if="props.property.status === 'refused'"
                                class="flex items-center text-sm text-gray-600"
                            >
                                <font-awesome-icon
                                    icon="clock"
                                    class="mr-2 text-gray-400"
                                />
                                {{ t("admin-dashboard.refused-in") }}:
                                {{ formatDate(props.property.updated_at) }}
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-white border border-gray-200 rounded-lg shadow p-4"
                    >
                        <h3 class="text-lg font-medium text-gray-800 mb-4">
                            {{ t("admin-dashboard.documents") }}:
                        </h3>
                        <div class="flex items-center space-x-4 mb-4">
                            <div>
                                <a
                                    :href="
                                        route('admin.properties.documents', {
                                            slug: property.slug,
                                        })
                                    "
                                >
                                    <p>{{ t("admin-dashboard.download") }}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <InputModal
            :isOpen="isModalOpen"
            title="Recusar imóvel"
            @close="closeModal"
        >
            <form @submit.prevent="refuseProperty" class="space-y-4">
                <div>
                    <h1>Motivo da rescisão</h1>
                    <InputLabel value="Motivo" />
                    <TextInput  v-model="selectedProperty.reason_for_refusal" />
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <button
                        type="button"
                        @click="closeModal"
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50"
                    >
                        {{ t("update-form.cancel") }}
                    </button>
                    <button
                        type="submit"
                        @click="form.status = 'refused'"
                        class="px-4 py-2 bg-red-600 rounded-md text-sm font-medium text-white hover:bg-red-700"
                    >
                        {{ t("admin-dashboard.refused") }}
                    </button>
                </div>
            </form>
        </InputModal>


        <InputModal
            :isOpen="isUpdateStatusModalOpen"
            title="Atualizar Imóvel"
            @close="closeUpdateStatusModal"
        >
            <form @submit.prevent="updateProperty" class="space-y-4">
                <div>
                    <InputLabel value="Estado do imóvel" />
                    <select v-model="selectedProperty.status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" >
                        <option value="sold">Vendido</option>
                        <option value="rented">Alugado</option>
                        <option value="refused">Recusado</option>
                        <option value="pending">Pendente</option>
                    </select>
                </div>

                <div v-if="selectedProperty.status === 'sold'">
                    <div class="mt-2">
                        <InputLabel value="Cliente" />
                        <select v-model="selectedProperty.sold_to_user_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option v-for="user in users" :key="user.id" :value="user.id">
                                {{ user.name }}
                            </option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <button
                        type="button"
                        @click="closeUpdateStatusModal"
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50"
                    >
                        {{ t("update-form.cancel") }}
                    </button>
                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-600 rounded-md text-sm font-medium text-white hover:bg-blue-700"
                    >
                        Atualizar
                    </button>
                </div>
            </form>
        </InputModal>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PropertiesShow from "@/Components/PropertiesShow.vue";
import EssentialsHighlights from "../Properties/Partials/EssentialsHighlights.vue";
import InteriorHighlights from "../Properties/Partials/InteriorHighlights.vue";
import OutdoorHighlights from "../Properties/Partials/OutdoorHighlights.vue";
import InputModal from "@/Components/InputModal.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import EnergyBalance from "../Properties/Partials/EnergyBalance.vue";
import { format } from "date-fns";
import { pt } from "date-fns/locale";
import { enUS } from "date-fns/locale";
import { useI18n } from "vue-i18n";
import { useForm, Head } from "@inertiajs/vue3";
import { ref } from "vue";

const { locale, t } = useI18n();

const props = defineProps({
    property: Object,
    categories: Array,
    downloads: Array,
    users: Array
});

const isModalOpen = ref(false);
const isUpdateStatusModalOpen = ref(false);

const closeModal = () => {
    isModalOpen.value = false;
};

const closeUpdateStatusModal = () => {
    isUpdateStatusModalOpen.value = false;
};

const openUpdateStatusModal = (property) => {
    selectedProperty.value = { ...property };
    isUpdateStatusModalOpen.value = true;
};

const openUpdateModal = (property) => {
    selectedProperty.value = { ...property };
    isModalOpen.value = true;
};

const selectedProperty = ref({
    reason_for_refusal: null,
    sold_to_user_id: props.property.sold_to_user_id,
});

const formatDate = (dateStr) => {
    if (locale.value === "en")
        return format(new Date(dateStr), "MM/dd/yyyy HH:mm", { locale: enUS });
    if (locale.value === "pt")
        return format(new Date(dateStr), "dd/MM/yyyy HH:mm", { locale: pt });
};

const form = useForm({
    status: props.property.status,
    reason_for_refusal: null,
    sold_to_user_id: props.property.sold_to_user_id,
});

const activeProperty = () => {
    form.status = 'active';

    form.patch(
        route("admin.properties.accept", { property: props.property.slug }),
        {
            preserveScroll: true,
        },
    );
};

const refuseProperty = () => {
    form.status = 'refused';
    form.reason_for_refusal = selectedProperty.value.reason_for_refusal;

    form.patch(
        route("admin.properties.accept", { property: props.property.slug }),
        {
            preserveScroll: true,
            onSuccess: () => {
                closeModal();
            },
        }
    );
};

const updateProperty = () => {
    form.status = selectedProperty.value.status;
    form.sold_to_user_id = selectedProperty.value.sold_to_user_id;
    form.sold_at = selectedProperty.value.sold_at;

    form.patch(
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
