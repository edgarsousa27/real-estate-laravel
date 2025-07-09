<template>
    <!-- Desktop Table View -->
    <div class="hidden lg:block">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th
                            v-for="(header, index) in headers"
                            :key="index"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            {{ header }}
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="property in properties" :key="property.id">
                        <td class="py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <div
                                        class="text-sm font-medium text-gray-900"
                                    >
                                        {{
                                            $t(
                                                property.title,
                                                property.title_params
                                            )
                                        }}
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
                            {{ formatPriceText(property) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                :class="{
                                    'bg-green-100 text-green-800':
                                        property.status === 'active',
                                    'bg-yellow-100 text-yellow-800':
                                        property.status === 'pending',
                                    'bg-blue-100 text-blue-800':
                                        property.status === 'rented',
                                    'bg-red-100 text-red-800':
                                        property.status === 'refused',
                                    'bg-emerald-200 text-emerald-800':
                                        property.status === 'sold',
                                }"
                            >
                                {{ t(`admin-dashboard.${property.status}`) }}
                            </span>
                        </td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm font-medium"
                        >
                            <slot name="actions" :property="property">
                                <Link
                                    :href="
                                        route('admin.properties.show', {
                                            slug: property.slug,
                                        })
                                    "
                                    class="text-blue-500 hover:text-blue-600"
                                >
                                    <font-awesome-icon
                                        icon="pen-to-square"
                                        class="size-5"
                                    />
                                </Link>
                            </slot>
                        </td>
                    </tr>
                    <tr v-if="props.properties.length === 0">
                        <td
                            class="px-6 py-4 whitespace-nowrap text-center"
                            colspan="5"
                        >
                            <h1>{{ t("clients-details.no-property") }}</h1>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Mobile Card View -->
    <div class="lg:hidden">
        <div v-if="properties.length === 0" class="text-center py-8">
            <h1 class="text-gray-500">
                {{ t("clients-details.no-property") }}
            </h1>
        </div>

        <div v-else class="space-y-4">
            <div
                v-for="property in properties"
                :key="property.id"
                class="bg-white rounded-lg shadow-sm border border-gray-200 p-4"
            >
                <!-- Property Title and Location -->
                <div class="mb-3">
                    <h3 class="text-sm font-medium text-gray-900 mb-1">
                        {{ $t(property.title, property.title_params) }}
                    </h3>
                    <p class="text-sm text-gray-500">
                        {{ property.district }}, {{ property.city }}
                    </p>
                </div>

                <!-- Property Details Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-4">
                    <!-- Category -->
                    <div class="flex items-center justify-between sm:block">
                        <span
                            class="text-xs text-gray-500 uppercase tracking-wide block sm:mb-1"
                        >
                            {{ headers[1] }}
                        </span>
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
                    </div>

                    <!-- Price -->
                    <div class="flex items-center justify-between sm:block">
                        <span
                            class="text-xs text-gray-500 uppercase tracking-wide block sm:mb-1"
                        >
                            {{ headers[2] }}
                        </span>
                        <span class="text-sm text-gray-900 font-medium">
                            {{ formatPriceText(property) }}
                        </span>
                    </div>

                    <!-- Status -->
                    <div class="flex items-center justify-between sm:block">
                        <span
                            class="text-xs text-gray-500 uppercase tracking-wide block sm:mb-1"
                        >
                            {{ headers[3] }}
                        </span>
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                            :class="{
                                'bg-green-100 text-green-800':
                                    property.status === 'active',
                                'bg-yellow-100 text-yellow-800':
                                    property.status === 'pending',
                                'bg-blue-100 text-blue-800':
                                    property.status === 'rented',
                                'bg-red-100 text-red-800':
                                    property.status === 'refused',
                                'bg-emerald-200 text-emerald-800':
                                    property.status === 'sold',
                            }"
                        >
                            {{ t(`admin-dashboard.${property.status}`) }}
                        </span>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-between sm:block">
                        <span
                            class="text-xs text-gray-500 uppercase tracking-wide block sm:mb-1"
                        >
                            {{ headers[4] }}
                        </span>
                        <div class="flex items-center">
                            <slot name="actions" :property="property">
                                <Link
                                    :href="
                                        route('admin.properties.show', {
                                            slug: property.slug,
                                        })
                                    "
                                    class="text-blue-500 hover:text-blue-600 p-1"
                                >
                                    <font-awesome-icon
                                        icon="pen-to-square"
                                        class="size-5"
                                    />
                                </Link>
                            </slot>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";

const { t } = useI18n();

const props = defineProps({
    properties: Array,
    headers: {
        type: Array,
        default: () => ["Properties", "Type", "Price", "Status", "Actions"],
    },
    categories: Array,
});

const showCategories = (category_id) => {
    const category = props.categories.find((cate) => cate.id === category_id);
    return t(`properties-form.${category.name}`);
};

const formatPrice = (price) => {
    return new Intl.NumberFormat("en-US").format(price);
};

const formatPriceText = (property) => {
    if (property.status === "sold") {
        return `Vendido por: ${formatPrice(property.final_price)}€`;
    }

    if (property.status === "rented") {
        return `${formatPrice(property.final_price)}€ ${t(
            "properties.per-month"
        )}`;
    }

    if (
        (property.status === "active" || property.status === "pending") &&
        property.transaction_id === 2
    ) {
        return `${formatPrice(property.price)}€ ${t("properties.per-month")}`;
    }

    return `${formatPrice(property.price)}€`;
};
</script>
