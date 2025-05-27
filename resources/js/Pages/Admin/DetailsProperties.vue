<template>
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
                    <form @submit.prevent="updateProperty" class="flex gap-5">
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
                            @click="showRejectionModal = true"
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md flex items-center"
                        >
                            <font-awesome-icon icon="times" class="mr-2" />
                            {{ t("admin-dashboard.refuse") }}
                        </button>
                    </form>
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

                    <!-- Property Details -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-800 mb-4">
                            {{ t("admin-dashboard.property-details") }}
                        </h3>
                        <div class="grid grid-cols-2 gap-4">
                            <DetailItem
                                :label="t('admin-dashboard.property-type')"
                                :value="
                                    showCategories(props.property.category_id)
                                "
                                icon="home"
                            />
                            <DetailItem
                                :label="t('admin-dashboard.price')"
                                :value="formatPrice(props.property.price)"
                                icon="euro-sign"
                            />
                            <DetailItem
                                v-if="
                                    props.property.category_id === 1 ||
                                    props.property.category_id === 2
                                "
                                :label="t('admin-dashboard.bedrooms')"
                                :value="props.property.bedrooms"
                                icon="bed"
                            />
                            <DetailItem
                                v-if="
                                    props.property.category_id === 1 ||
                                    props.property.category_id === 2
                                "
                                :label="t('admin-dashboard.bathrooms')"
                                :value="props.property.bathrooms"
                                icon="bath"
                            />
                            <DetailItem
                                :label="t('admin-dashboard.square-meters')"
                                :value="props.property.square_meters + ' m2'"
                                icon="ruler-combined"
                            />
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-800 mb-2">
                            {{ t("admin-dashboard.description") }}
                        </h3>
                        <p class="text-gray-600 whitespace-pre-line">
                            {{ props.property.description }}
                        </p>
                    </div>

                    <!-- Amenities -->
                    <!-- <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-800 mb-2">
                            Amenities
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            <span
                                v-for="amenity in property.amenities"
                                :key="amenity"
                                class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-800 text-sm"
                            >
                                <font-awesome-icon
                                    :icon="amenityIcons[amenity] || 'check'"
                                    class="mr-1"
                                />
                                {{ amenity }}
                            </span>
                        </div>
                    </div> -->
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
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PropertiesShow from "@/Components/PropertiesShow.vue";
import DetailItem from "@/Components/DetailItem.vue";
import { format } from "date-fns";
import { pt } from "date-fns/locale";
import { enUS } from "date-fns/locale";
import { useI18n } from "vue-i18n";
import { useForm } from "@inertiajs/vue3";

const { locale, t } = useI18n();

const props = defineProps({
    property: Object,
    categories: Array,
    downloads: Array,
});

const formatPrice = (price) => {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
};

const formatDate = (dateStr) => {
    if (locale.value === "en")
        return format(new Date(dateStr), "yyyy/MM/dd HH:mm", { locale: enUS });
    if (locale.value === "pt")
        return format(new Date(dateStr), "dd/MM/yyyy HH:mm", { locale: pt });
};

const showCategories = (category_id) => {
    const category = props.categories.find((cate) => cate.id === category_id);
    return t(`properties-form.${category.name}`);
};

const form = useForm({
    status: props.property.status,
});

const updateProperty = () => {
    form.patch(
        route("admin.properties.accept", { property: props.property.slug }),
        {
            preserveScroll: true,
            onSuccess: () => {
                console.log(props.property.status);
            },
        }
    );
};
</script>
