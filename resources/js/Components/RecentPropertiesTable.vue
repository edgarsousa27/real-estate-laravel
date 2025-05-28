<template>
    <div class="bg-white rounded-lg shadow p-6 lg:col-span-2">
        <h3 class="text-lg font-medium text-gray-900 mb-4">
            {{ t("admin-dashboard.recent-properties") }}
        </h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            {{ t("admin-dashboard.properties") }}
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            {{ t("admin-dashboard.status") }}
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            {{ t("admin-dashboard.price") }}
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            {{ t("admin-dashboard.actions") }}
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="property in props.properties" :key="property.id">
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
                                        class="h-10 w-10 rounded-md"
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
                                    'bg-red-100 text-red-800':
                                        property.status === 'refused',
                                }"
                            >
                                {{ t(`admin-dashboard.${property.status}`) }}
                            </span>
                        </td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                        >
                            {{ formatPrice(property.price) + "€" }}
                        </td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm font-medium"
                        >
                            <Link
                                :href="
                                    route('admin.properties.show', {
                                        slug: property.slug,
                                    })
                                "
                            >
                                <button
                                    class="text-blue-600 hover:text-blue-900 mr-3"
                                >
                                    {{ t("admin-dashboard.view") }}
                                </button>
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script setup>
import { useI18n } from "vue-i18n";
import { Link } from "@inertiajs/vue3";

const { t } = useI18n();

const props = defineProps({
    properties: Array,
});

const formatPrice = (price) => {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
};
</script>
