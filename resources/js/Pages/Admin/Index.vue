<template>
    <Head>
        <title>Dashboard</title>
    </Head>
    <AdminLayout title="Dashboard">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <StatCard
                :title="t('admin-dashboard.total-properties')"
                :value="props.total_properties"
                icon="home"
            />
            <StatCard
                :title="t('admin-dashboard.active-properties')"
                :value="props.active_properties"
                icon="clipboard-list"
                iconBgColor="bg-green-500"
            />
            <StatCard
                :title="t('admin-dashboard.pending-properties')"
                :value="props.pending_properties"
                icon="handshake"
                iconBgColor="bg-yellow-500"
            />
            <StatCard
                :title="t('admin-dashboard.total-revenue')"
                :value="formatPrice(props.revenue) + '€'"
                icon="euro-sign"
                iconBgColor="bg-purple-500"
            />
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <RecentPropertiesTable :properties="props.properties" />
            <QuickActionsTable />
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import StatCard from "@/Components/StatCard.vue";
import RecentPropertiesTable from "@/Components/RecentPropertiesTable.vue";
import QuickActionsTable from "@/Components/QuickActionsTable.vue";
import { useI18n } from "vue-i18n";
import { Head } from "@inertiajs/vue3";

const { t } = useI18n();

const props = defineProps({
    properties: Array,
    total_properties: Number,
    active_properties: Number,
    pending_properties: Number,
    revenue: Number,
});

const formatPrice = (price) => {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
};
</script>
