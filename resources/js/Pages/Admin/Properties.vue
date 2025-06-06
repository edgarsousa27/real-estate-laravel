<template>
    <Head>
        <title>{{ t("admin-dashboard.properties-admin") }}</title>
    </Head>
    <AdminLayout :title="t('admin-dashboard.properties-admin')">
        <div class="px-6 py-4 bg-white rounded-lg shadow">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">
                    {{ t("admin-dashboard.properties") }}
                </h2>
            </div>

            <!-- Filters -->
            <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <InputLabel :value="t('admin-dashboard.search')" />
                        <TextInput
                            :placeholder="
                                t('admin-dashboard.placeholder-search')
                            "
                            type="text"
                            v-model="query"
                            @keyup.enter="search"
                        />
                    </div>
                    <div>
                        <InputLabel
                            :value="t('admin-dashboard.type-property')"
                        />
                        <select
                            class="w-full rounded-md border-gray-300 shadow-sm"
                            v-model="selectedType"
                            @change="applyFilter"
                        >
                            <option value="">
                                {{ t("admin-dashboard.type-all") }}
                            </option>
                            <option value="house">
                                {{ t("admin-dashboard.type-house") }}
                            </option>
                            <option value="apartment">
                                {{ t("admin-dashboard.type-apartment") }}
                            </option>
                            <option value="land">
                                {{ t("admin-dashboard.type-land") }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <InputLabel :value="t('admin-dashboard.status')" />
                        <select
                            class="w-full rounded-md border-gray-300 shadow-sm"
                            v-model="selectedStatus"
                            @change="applyFilter"
                        >
                            <option value="">
                                {{ t("admin-dashboard.status-all") }}
                            </option>
                            <option value="active">
                                {{ t("admin-dashboard.status-available") }}
                            </option>
                            <option value="sold">
                                {{ t("admin-dashboard.status-sold") }}
                            </option>
                            <option value="pending">
                                {{ t("admin-dashboard.status-pending") }}
                            </option>
                            <option value="rented">
                                {{ t("admin-dashboard.status-rented") }}
                            </option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button
                            @click="resetFilters"
                            class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded-md"
                        >
                            {{ t("admin-dashboard.reset-filters") }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Properties Table -->
            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <PropertyTable
                    :properties="props.properties.data"
                    :categories="props.categories"
                    :headers="[
                        t('admin-dashboard.properties'),
                        t('admin-dashboard.type'),
                        t('admin-dashboard.price'),
                        t('admin-dashboard.status'),
                        t('admin-dashboard.actions'),
                    ]"
                    :action-url="
                        (property) =>
                            route('admin.properties.show', {
                                slug: property.slug,
                            })
                    "
                >
                </PropertyTable>
            </div>
            <!-- Pagination -->
            <Pagination :links="props.properties.links" />
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
import Pagination from "@/Components/Pagination.vue";
import PropertyTable from "@/Components/PropertiesTable.vue";

const { t } = useI18n();

const props = defineProps({
    properties: [Array, Object],
    categories: Array,
    query: String,
});

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
