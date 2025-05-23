<template>
    <Head>
        <title>Properties Management</title>
    </Head>
    <AdminLayout title="Properties Management">
        <div class="px-6 py-4 bg-white rounded-lg shadow">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Properties</h2>
            </div>

            <!-- Filters -->
            <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <InputLabel value="Pesquisar" />
                        <TextInput
                            placeholder="Address, city..."
                            type="text"
                            v-model="query"
                            @keyup.enter="search"
                        />
                    </div>
                    <div>
                        <InputLabel value="Tipo de imóvel" />
                        <select
                            class="w-full rounded-md border-gray-300 shadow-sm"
                            v-model="selectedType"
                            @change="applyFilter"
                        >
                            <option value="">All Types</option>
                            <option value="house">House</option>
                            <option value="apartment">Apartment</option>
                            <option value="land">Land</option>
                        </select>
                    </div>
                    <div>
                        <InputLabel value="Estado" />
                        <select
                            class="w-full rounded-md border-gray-300 shadow-sm"
                            v-model="selectedStatus"
                            @change="applyFilter"
                        >
                            <option value="">All Statuses</option>
                            <option value="active">Available</option>
                            <option value="sold">Sold</option>
                            <option value="pending">Pending</option>
                            <option value="rented">Rented</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button
                            @click="resetFilters"
                            class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded-md"
                        >
                            Reset Filters
                        </button>
                    </div>
                </div>
            </div>

            <!-- Properties Table -->
            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Property
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Type
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Price
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Status
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr
                            v-for="property in props.properties"
                            :key="property.id"
                        >
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img
                                            v-if="
                                                property.media &&
                                                property.media.length
                                            "
                                            :src="
                                                property.media.find(
                                                    (m) =>
                                                        m.collection_name ===
                                                        'images'
                                                )?.original_url || ''
                                            "
                                            :alt="property.title"
                                            class="h-10 w-10 rounded-md object-cover"
                                            draggable="false"
                                        />
                                    </div>
                                    <div class="ml-4">
                                        <div
                                            class="text-sm font-medium text-gray-900"
                                        >
                                            {{ property.title }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ property.district }},
                                            {{ property.city }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full capitalize"
                                    :class="{
                                        'bg-blue-100 text-blue-800':
                                            property.category_id === 1,
                                        'bg-green-100 text-green-800':
                                            property.category_id === 2,
                                        'bg-yellow-100 text-yellow-800':
                                            property.category_id === 3,
                                    }"
                                >
                                    {{ showCategories(property.category_id) }}
                                </span>
                            </td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                            >
                                {{ formatPrice(property.price) + "€" }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                    :class="{
                                        'bg-green-100 text-green-800':
                                            property.status === 'active',
                                        'bg-red-100 text-red-800':
                                            property.status === 'sold',
                                        'bg-yellow-100 text-yellow-800':
                                            property.status === 'pending',
                                        'bg-blue-100 text-blue-800':
                                            property.status === 'rented',
                                    }"
                                >
                                    {{
                                        t(`admin-dashboard.${property.status}`)
                                    }}
                                </span>
                            </td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm font-medium"
                            >
                                <Link
                                    :href="`/admin/properties/${property.id}/edit`"
                                    class="text-blue-600 hover:text-blue-900 mr-3"
                                >
                                    <font-awesome-icon icon="pen-to-square" />
                                </Link>
                                <button
                                    @click="confirmDelete(property)"
                                    class="text-red-600 hover:text-red-900"
                                >
                                    <font-awesome-icon icon="trash" />
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4 flex justify-between items-center">
                <div class="text-sm text-gray-700">
                    Showing <span class="font-medium">1</span> to
                    <span class="font-medium">10</span> of
                    <span class="font-medium">24</span> results
                </div>
                <div class="flex space-x-2">
                    <button
                        class="px-3 py-1 rounded-md bg-gray-200 text-gray-700 disabled:opacity-50"
                        disabled
                    >
                        Previous
                    </button>
                    <button class="px-3 py-1 rounded-md bg-blue-600 text-white">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref } from "vue";
import { Link, Head, router } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";

const { t } = useI18n();

const props = defineProps({
    properties: Array,
    categories: Array,
    query: String,
});

const formatPrice = (price) => {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
};

const showCategories = (category_id) => {
    const category = props.categories.find((cate) => cate.id === category_id);
    return t(`properties-form.${category.name}`);
};

const query = ref("");

const search = () => {
    router.get(
        route("admin.properties"),
        {
            query: query.value,
        },
        {
            preserveState: true,
            preserveScroll: true,
        }
    );
};

const selectedType = ref("");
const selectedStatus = ref("");

function applyFilter() {
    const filters = {};

    if (selectedType.value) {
        filters["filter[type]"] = selectedType.value;
    }

    if (selectedStatus.value) {
        filters["filter[status]"] = selectedStatus.value;
    }

    router.get(route("admin.properties"), filters, {
        preserveScroll: true,
        preserveState: true,
    });
}

const resetFilters = () => {
    router.get(route("admin.properties"));
};
</script>
