<template>
    <div class="py-4 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl max-h-6xl mx-auto">
            <ul
                class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6"
            >
                <li v-for="proper in properties" :key="proper.id">
                    <div
                        class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 h-full flex flex-col"
                    >
                        <div
                            class="relative h-56 sm:h-56 md:h-72 lg:h-72 xl:h-72"
                        >
                            <div class="absolute z-40 m-3">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full capitalize"
                                    :class="{
                                        'bg-green-100 text-green-800':
                                            proper.status === 'active',
                                        'bg-yellow-100 text-yellow-800':
                                            proper.status === 'pending',
                                        'bg-blue-100 text-blue-800':
                                            proper.status === 'rented',
                                        'bg-red-100 text-red-800':
                                            proper.status === 'refused',
                                        'bg-emerald-300 text-emerald-800':
                                            proper.status === 'sold',
                                    }"
                                >
                                    {{ t(`admin-dashboard.${proper.status}`) }}
                                </span>
                            </div>
                            <PropertySlideShow
                                :images="proper.media"
                                :property="proper"
                            ></PropertySlideShow>
                            <div
                                class="absolute right-1 top-1 rounded-full m-2 bg-white p-2 flex items-center justify-between hover:bg-blue-500 cursor-pointer transition-colors duration-150"
                            >
                                <font-awesome-icon
                                    icon="heart"
                                    class="size-5 text-neutral-300 hover:fill-white"
                                />
                            </div>
                            <div
                                class="absolute bottom-0 left-0 right-0 bg-white shadow-lg m-2 rounded-lg px-4 py-2 flex"
                            >
                                <span
                                    v-if="proper.transaction_id == 1"
                                    class="text-lg sm:text-xl font-bold text-blue-600"
                                >
                                    {{ formatPrice(proper.price) + "€" }}
                                </span>
                                <span
                                    v-if="proper.transaction_id == 2"
                                    class="text-lg sm:text-xl font-bold text-blue-600"
                                >
                                    {{ formatPrice(proper.price) + "€" }}
                                    <span
                                        class="text-xs font-bold text-gray-500"
                                        >{{ t("properties.per-month") }}</span
                                    >
                                </span>
                            </div>
                        </div>

                        <div class="p-4 sm:p-5 flex-grow flex flex-col">
                            <div
                                class="flex gap-1 justify-between items-center"
                            >
                                <div class="flex gap-1">
                                    <h1
                                        class="text-md sm:text-md font-normal text-gray-500 hover:text-blue-600 line-clamp-1 mb-1 cursor-pointer"
                                        v-if="proper.category_id === 1"
                                    >
                                        {{ t("category.house") }}
                                    </h1>
                                    <h1
                                        class="text-md sm:text-md font-normal text-gray-500 hover:text-blue-600 line-clamp-1 mb-1 cursor-pointer"
                                        v-else-if="proper.category_id === 2"
                                    >
                                        {{ t("category.apartment") }}
                                    </h1>
                                    <h1
                                        class="text-md sm:text-md font-normal text-gray-500 hover:text-blue-600 line-clamp-1 mb-1 cursor-pointer"
                                        v-else
                                    >
                                        {{ t("category.land") }}
                                    </h1>
                                    <span
                                        v-if="proper.bedrooms != null"
                                        class="text-md sm:text-md font-bold text-gray-800 mb-1 cursor-pointer"
                                    >
                                        {{
                                            proper.bedrooms +
                                            " " +
                                            t("properties.bedroom")
                                        }}
                                    </span>
                                    <span
                                        v-if="proper.bathrooms != null"
                                        class="text-md sm:text-md font-bold text-gray-800 mb-1 cursor-pointer"
                                    >
                                        {{
                                            proper.bathrooms +
                                            " " +
                                            t("properties.wc")
                                        }}
                                    </span>
                                    <span
                                        class="text-md sm:text-md font-bold text-gray-800 mb-1 cursor-pointer"
                                    >
                                        {{ proper.square_meters + "㎡" }}
                                    </span>
                                </div>
                                <div class="static">
                                    <!-- Botão de opções -->
                                    <button @click="toggleDropdown(proper.id)">
                                        <font-awesome-icon
                                            icon="ellipsis-vertical"
                                            class="size-5 text-neutral-500 cursor-pointer hover:text-blue-500"
                                        />
                                    </button>

                                    <!-- Dropdown -->
                                    <div
                                        v-if="activeDropdownId === proper.id"
                                        class="absolute mt-2 w-36 bg-white border rounded-md shadow-lg z-40"
                                    >
                                        <ul class="py-1 text-sm text-gray-700">
                                            <li
                                                v-if="
                                                    proper.status !== 'active'
                                                "
                                            >
                                                <button
                                                    @click="
                                                        openUpdateModal(proper)
                                                    "
                                                    class="w-full text-left px-4 py-2 hover:bg-gray-100"
                                                >
                                                    {{
                                                        t("update-form.update")
                                                    }}
                                                </button>
                                            </li>
                                            <li>
                                                <button
                                                    @click="
                                                        openDeleteModal(proper)
                                                    "
                                                    class="w-full text-left px-4 py-2 hover:bg-gray-100 text-red-500"
                                                >
                                                    {{
                                                        t("update-form.delete")
                                                    }}
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow">
                                <h2
                                    class="text-md sm:text-md text-gray-500 mb-1 cursor-pointer"
                                >
                                    {{ proper.city }}, {{ proper.district }}
                                </h2>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <InputModal
        :isOpen="isModalOpen"
        :title="t('update-form.properties')"
        @close="closeModal"
    >
        <form @submit.prevent="updateProperty" class="space-y-4">
            <input type="hidden" v-model="selectedProperty.id" />

            <div>
                <InputLabel :value="t('update-form.price')" />
                <TextInput
                    type="number"
                    v-model="selectedProperty.price"
                    required
                />
            </div>

            <div v-if="selectedProperty.bedrooms > 0">
                <InputLabel :value="t('update-form.bedrooms')" />
                <TextInput
                    type="number"
                    v-model="selectedProperty.bedrooms"
                    required
                />
            </div>

            <div v-if="selectedProperty.bathrooms > 0">
                <InputLabel :value="t('update-form.bathrooms')" />
                <TextInput
                    type="number"
                    v-model="selectedProperty.bathrooms"
                    required
                />
            </div>

            <div>
                <InputLabel :value="t('update-form.surface')" />
                <TextInput
                    type="number"
                    v-model="selectedProperty.square_meters"
                    required
                />
            </div>

            <div>
                <InputLabel :value="t('update-form.district')" />
                <select
                    id="district"
                    name="district"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 pl-3 pr-10"
                    v-model="selectedProperty.district"
                >
                    <option v-for="dist in district" :key="dist" :value="dist">
                        {{ dist }}
                    </option>
                </select>
            </div>

            <div>
                <InputLabel
                    v-if="selectedProperty.district"
                    :value="t('update-form.city')"
                />
                <select
                    id="district"
                    name="district"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 pl-3 pr-10"
                    v-if="selectedProperty.district"
                    v-model="selectedProperty.city"
                >
                    <option
                        v-for="city in cities[selectedProperty.district]"
                        :key="city"
                        :value="city"
                    >
                        {{ city }}
                    </option>
                </select>
            </div>

            <div v-if="selectedProperty.city">
                <InputLabel :value="t('update-form.postal_code')" />
                <input
                    v-model="selectedProperty.postal_code"
                    type="text"
                    readonly
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100"
                />
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
                    class="px-4 py-2 bg-blue-600 rounded-md text-sm font-medium text-white hover:bg-blue-700"
                >
                    {{ t("update-form.save") }}
                </button>
            </div>
        </form>
    </InputModal>

    <InputModal
        :isOpen="isModalDeleteOpen"
        :title="t('update-form.delete-properties')"
        @close="closeModal"
    >
        <form @submit.prevent="deleteProperty" class="space-y-4">
            <input type="hidden" v-model="selectedProperty.id" />

            <div>
                <h1>{{ t("update-form.delete-h1") }}</h1>
                <p class="text-sm">
                    {{ t("update-form.delete-p") }}
                </p>
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <button
                    type="button"
                    @click="closeDeleteModal"
                    class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50"
                >
                    {{ t("update-form.cancel") }}
                </button>
                <button
                    type="submit"
                    class="px-4 py-2 bg-blue-600 rounded-md text-sm font-medium text-white hover:bg-blue-700"
                >
                    {{ t("update-form.delete") }}
                </button>
            </div>
        </form>
    </InputModal>
</template>

<script setup>
import { useI18n } from "vue-i18n";
import PropertySlideShow from "@/Components/PropertySlideShow.vue";
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";
import InputModal from "./InputModal.vue";
import TextInput from "./TextInput.vue";
import InputLabel from "./InputLabel.vue";
import { useToast } from "vue-toastification";

const props = defineProps({
    properties: [Array, Object],
    categories: Array,
    district: Array,
    cities: Object,
    postal_code: Object,
});

const isModalOpen = ref(false);
const isModalDeleteOpen = ref(false);

const closeModal = () => {
    isModalOpen.value = false;
};

const closeDeleteModal = () => {
    isModalDeleteOpen.value = false;
};

const selectedProperty = ref({
    id: null,
    price: "",
    bedrooms: "",
    bathrooms: "",
    square_meters: "",
    city: "",
    district: "",
    postal_code: "",
});

const { t } = useI18n();
const toast = useToast();

const formatPrice = (price) => {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
};

const openUpdateModal = (proper) => {
    selectedProperty.value = { ...proper };
    isModalOpen.value = true;
};

const openDeleteModal = (proper) => {
    selectedProperty.value = { ...proper };
    isModalDeleteOpen.value = true;
};

watch(
    () => selectedProperty.value.city,
    (newCity) => {
        if (newCity && selectedProperty.value.district) {
            const key = `${selectedProperty.value.district}|${newCity}`;
            if (props.postal_code[key]) {
                selectedProperty.value.postal_code = props.postal_code[key];
            } else {
                selectedProperty.value.postal_code = "";
            }
        }
    }
);

watch(
    () => selectedProperty.value.district,
    () => {
        selectedProperty.value.city = "";
        selectedProperty.value.postal_code = "";
    }
);

const updateProperty = () => {
    router.patch(
        route("properties.update", selectedProperty.value.id),
        { ...selectedProperty.value },
        {
            onSuccess: () => {
                toast.success(t("notifications.property.update"));
                closeModal();
            },
            onError: () => {
                toast.error("Ocorreu um erro ao atualizar o imóvel");
            },
        }
    );
};

const deleteProperty = () => {
    router.delete(route("properties.destroy", selectedProperty.value.id), {
        onSuccess: () => {
            toast.success(t("notifications.property.delete"));
            closeDeleteModal();
        },
        onError: () => {
            toast.error(t("notifications.error.update-property"));
        },
    });
};

const activeDropdownId = ref(null);

const toggleDropdown = (id) => {
    activeDropdownId.value = activeDropdownId.value === id ? null : id;
};
</script>
