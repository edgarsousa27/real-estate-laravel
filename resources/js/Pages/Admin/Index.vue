<template>
    <AdminLayout title="Dashboard">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <StatCard
                :title="t('admin-dashboard.total-properties')"
                value="124"
                icon="home"
            />
            <StatCard
                :title="t('admin-dashboard.active-properties')"
                value="89"
                icon="clipboard-list"
                iconBgColor="bg-green-500"
            />
            <StatCard
                :title="t('admin-dashboard.pending-properties')"
                value="15"
                icon="handshake"
                iconBgColor="bg-yellow-500"
            />
            <StatCard
                :title="t('admin-dashboard.total-revenue')"
                value="€245,000"
                icon="euro-sign"
                iconBgColor="bg-purple-500"
            />
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <RecentPropertiesTable :recentProperties="recentProperties" />

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

const { t } = useI18n();

const recentProperties = [
    {
        id: 1,
        name: "Luxury Villa",
        location: "Miami, FL",
        image: "https://via.placeholder.com/40",
        status: "Active",
        price: "$1,250,000",
    },
    {
        id: 2,
        name: "Downtown Apartment",
        location: "New York, NY",
        image: "https://via.placeholder.com/40",
        status: "Pending",
        price: "$850,000",
    },
    {
        id: 3,
        name: "Beach House",
        location: "Malibu, CA",
        image: "https://via.placeholder.com/40",
        status: "Active",
        price: "$2,500,000",
    },
    {
        id: 4,
        name: "Mountain Cabin",
        location: "Aspen, CO",
        image: "https://via.placeholder.com/40",
        status: "Active",
        price: "$750,000",
    },
];
</script>
