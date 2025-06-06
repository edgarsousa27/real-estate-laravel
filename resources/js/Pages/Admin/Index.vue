<template>
    <Head>
        <title>Dashboard</title>
    </Head>
    <AdminLayout title="Dashboard">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <Link :href="route('admin.properties')">
                <StatCard
                    :title="t('admin-dashboard.total-properties')"
                    :value="props.total_properties"
                    icon="home"
                />
            </Link>
            <Link
                :href="
                    route('admin.properties', {
                        'filter[status]': 'active',
                    })
                "
            >
                <StatCard
                    :title="t('admin-dashboard.active-properties')"
                    :value="props.active_properties"
                    icon="clipboard-list"
                    iconBgColor="bg-green-500"
                />
            </Link>
            <Link
                :href="
                    route('admin.properties', {
                        'filter[status]': 'pending',
                    })
                "
            >
                <StatCard
                    :title="t('admin-dashboard.pending-properties')"
                    :value="props.pending_properties"
                    icon="handshake"
                    iconBgColor="bg-yellow-500"
                />
            </Link>

            <Link
                :href="
                    route('admin.properties', {
                        'filter[status]': 'sold',
                    })
                "
            >
                <StatCard
                    :title="t('admin-dashboard.sold-properties')"
                    :value="props.sold_properties"
                    icon="house-circle-check"
                    iconBgColor="bg-emerald-500"
                />
            </Link>
            <Link
                :href="
                    route('admin.properties', {
                        'filter[status]': 'rented',
                    })
                "
            >
                <StatCard
                    :title="t('admin-dashboard.rented-properties')"
                    :value="props.rented_properties"
                    icon="house-user"
                    iconBgColor="bg-blue-400"
                />
            </Link>
            <StatCard
                :title="t('admin-dashboard.total-revenue')"
                :value="formatPrice(props.revenue) + '€'"
                icon="euro-sign"
                iconBgColor="bg-purple-500"
            />
        </div>

        <h3 class="text-lg font-medium text-gray-900 mb-4">
            {{ t("admin-dashboard.recent-properties") }}
        </h3>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <div
                class="lg:col-span-2 bg-white rounded-lg shadow overflow-hidden"
            >
                <div class="overflow-x-auto">
                    <PropertyTable
                        :properties="props.properties"
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
            </div>
            <QuickActionsTable />
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import StatCard from "@/Components/StatCard.vue";
import QuickActionsTable from "@/Components/QuickActionsTable.vue";
import { useI18n } from "vue-i18n";
import { Head, Link } from "@inertiajs/vue3";
import PropertyTable from "@/Components/PropertiesTable.vue";

const { t } = useI18n();

const props = defineProps({
    properties: Array,
    total_properties: Number,
    active_properties: Number,
    pending_properties: Number,
    sold_properties: Number,
    rented_properties: Number,
    revenue: Number,
    categories: Array,
});

const formatPrice = (price) => {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
};
</script>
