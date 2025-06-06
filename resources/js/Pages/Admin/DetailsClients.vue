<template>
    <Head>
        <title>{{ t("clients-details.title") + ` | ${client.name}` }}</title>
    </Head>
    <AdminLayout :title="t('clients-details.title')">
        <div class="px-4 sm:px-6 py-4 bg-white rounded-lg shadow">
            <!-- Back Button -->
            <div class="mb-6">
                <Link
                    :href="route('admin.clients')"
                    class="text-blue-600 hover:text-blue-800 flex items-center"
                >
                    <font-awesome-icon icon="arrow-left" class="mr-2" />
                    {{ t("clients-details.back-to-clients") }}
                </Link>
            </div>

            <!-- User Profile Header -->
            <div
                class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8"
            >
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        {{ client.name }}
                    </h1>
                </div>
            </div>

            <!-- User Details Sections -->
            <div class="space-y-8">
                <!-- Personal Information -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">
                        <font-awesome-icon icon="user" class="mr-2" />
                        {{ t("clients-details.client-info") }}
                    </h2>
                    <div
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
                    >
                        <DetailItem
                            :label="t('clients-details.name')"
                            :value="client.name"
                        />
                        <DetailItem
                            :label="t('clients-details.email')"
                            :value="client.email"
                        />
                        <DetailItem
                            :label="t('clients-details.phone')"
                            :value="client.phone_number"
                        />
                        <DetailItem
                            :label="t('clients-details.date_of_birth')"
                            :value="
                                client.date_of_birth ||
                                t('purchase-form.undisclosed')
                            "
                        />
                        <DetailItem
                            :label="t('clients-details.id-number')"
                            :value="client.identification_number"
                        />
                        <DetailItem
                            :label="t('clients-details.tax-number')"
                            :value="client.tax_number"
                        />
                    </div>
                </div>

                <!-- User Properties -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">
                            <font-awesome-icon icon="home" class="mr-2" />
                            {{ t("clients-details.properties") }}
                        </h2>
                    </div>

                    <div>
                        <div class="overflow-x-auto">
                            <PropertyTable
                                :properties="client.property"
                                :categories="categories"
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
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Link, Head } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import DetailItem from "@/Components/DetailItem.vue";
import PropertyTable from "@/Components/PropertiesTable.vue";

const { t } = useI18n();

const props = defineProps({
    client: [Object, Array],
    categories: Array,
});
</script>
