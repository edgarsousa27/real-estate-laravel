<template>
    <div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-md">
        <form @submit.prevent="submit" class="space-y-4">
            <div>
                <label
                    for="category_id"
                    class="block text-sm font-medium text-gray-700 mb-1"
                    >{{ t("properties-form.category") }}</label
                >
                <select
                    id="category_id"
                    name="category_id"
                    v-model="form.category_id"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    required
                >
                    <option :value="1">{{ t("properties-form.house") }}</option>
                    <option :value="2">
                        {{ t("properties-form.apartment") }}
                    </option>
                    <option :value="3">{{ t("properties-form.land") }}</option>
                </select>
            </div>

            <div>
                <label
                    for="transaction_id"
                    class="block text-sm font-medium text-gray-700 mb-1"
                    >{{ t("properties-form.transaction") }}</label
                >
                <select
                    id="transaction_id"
                    name="transaction_id"
                    v-model="form.transaction_id"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    required
                >
                    <option :value="1">{{ t("properties-form.sell") }}</option>
                    <option :value="2">{{ t("properties-form.rent") }}</option>
                </select>
            </div>

            <div>
                <label
                    for="description"
                    class="block text-sm font-medium text-gray-700 mb-1"
                    >{{ t("properties-form.description") }}</label
                >
                <input
                    type="text"
                    id="description"
                    v-model="form.description"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    required
                />
            </div>

            <div>
                <label
                    for="address"
                    class="block text-sm font-medium text-gray-700 mb-1"
                    >{{ t("properties-form.address") }}</label
                >
                <input
                    type="text"
                    id="address"
                    v-model="form.address"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                />
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div v-if="form.transaction_id === 2">
                    <label
                        for="price"
                        class="block text-sm font-medium text-gray-700 mb-1"
                        >{{ t("properties-form.price-rent") }}</label
                    >
                    <input
                        type="number"
                        id="price"
                        v-model="form.price"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    />
                </div>
                <div v-if="form.transaction_id === 1">
                    <label
                        for="price"
                        class="block text-sm font-medium text-gray-700 mb-1"
                        >{{ t("properties-form.price") }}</label
                    >
                    <input
                        type="number"
                        id="price"
                        v-model="form.price"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    />
                </div>
                <div>
                    <label
                        for="square_meters"
                        class="block text-sm font-medium text-gray-700 mb-1"
                        >{{ t("properties-form.surface") }}</label
                    >
                    <input
                        type="number"
                        id="square_meters"
                        v-model="form.square_meters"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    />
                </div>
            </div>

            <div
                class="grid grid-cols-2 gap-4"
                v-if="form.category_id === 1 || form.category_id === 2"
            >
                <div>
                    <label
                        for="price"
                        class="block text-sm font-medium text-gray-700 mb-1"
                        >{{ t("properties-form.bathrooms") }}</label
                    >
                    <input
                        type="number"
                        id="bathrooms"
                        v-model="form.bathrooms"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    />
                </div>
                <div>
                    <label
                        for="price"
                        class="block text-sm font-medium text-gray-700 mb-1"
                        >{{ t("properties-form.bedrooms") }}</label
                    >
                    <input
                        type="number"
                        id="bedrooms"
                        v-model="form.bedrooms"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    />
                </div>
                <div>
                    <label
                        for="price"
                        class="block text-sm font-medium text-gray-700 mb-1"
                        >{{ t("properties-form.parking-spaces") }}</label
                    >
                    <input
                        type="number"
                        id="parking_spaces"
                        v-model="form.parking_spaces"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    />
                </div>
                <div>
                    <label
                        for="price"
                        class="block text-sm font-medium text-gray-700 mb-1"
                        >{{ t("properties-form.floors") }}</label
                    >
                    <input
                        type="number"
                        id="floors"
                        v-model="form.floors"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    />
                </div>
            </div>

            <div>
                <label
                    for="city"
                    class="block text-sm font-medium text-gray-700 mb-1"
                    >{{ t("properties-form.district") }}</label
                >
                <select
                    id="district"
                    name="district"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 pl-3 pr-10"
                    v-model="form.district"
                >
                    <option v-for="dist in district" :key="dist" :value="dist">
                        {{ dist }}
                    </option>
                </select>
            </div>

            <div>
                <label
                    for="city"
                    class="block text-sm font-medium text-gray-700 mb-1"
                    v-if="form.district"
                    >{{ t("properties-form.city") }}</label
                >
                <select
                    id="district"
                    name="district"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 pl-3 pr-10"
                    v-if="form.district"
                    v-model="form.city"
                >
                    <option
                        v-for="city in cities[form.district]"
                        :key="city"
                        :value="city"
                    >
                        {{ city }}
                    </option>
                </select>
            </div>

            <div v-if="form.city" class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    {{ t("properties-form.postalcode") }}
                </label>
                <input
                    v-model="form.postal_code"
                    type="text"
                    readonly
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100"
                />
            </div>

            <div>
                <label
                    for="upload"
                    class="block text-sm font-medium text-gray-700 mb-1"
                    >{{ t("properties-form.image") }}</label
                >
                <input
                    type="file"
                    @change="handleImageChange"
                    multiple
                    name="images[]"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                />
            </div>

            <button
                type="submit"
                :disabled="form.processing"
                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed"
            >
                <span v-if="form.processing">Processing...</span>
                <span v-else>{{ t("properties-form.submit") }}</span>
            </button>
        </form>
    </div>
</template>

<script setup>
import { reactive } from "vue";
import { router } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";
import { useForm } from "@inertiajs/vue3";
import { watch } from "vue";

const { t } = useI18n();

const props = defineProps({
    properties: [Array, Object],
    district: Array,
    cities: Object,
    postal_code: Object,
});

const form = useForm({
    category_id: null,
    transaction_id: null,
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
    floors: null,
    images: [],
});

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

const handleImageChange = (e) => {
    form.images = Array.from(e.target.files);
};

const submit = () => {
    form.post(route("properties.store"), {
        forceFormData: true,
        onSuccess: () => form.reset(),
    });
};
</script>
