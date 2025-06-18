<template>
    <Head>
        <title>{{ t("analytics.title") }}</title>
    </Head>
    <AdminLayout :title="t('analytics.title')">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-xl p-6 shadow h-96">
                <h2 class="text-xl font-semibold">
                    {{ t("analytics.monthly-listings") }}
                </h2>
                <BarChart
                    :chart-data="chartDataMonthlyListings"
                    :chart-options="chartOptionsMonthlyListings"
                />
            </div>
            <div class="bg-white rounded-xl p-6 shadow h-96">
                <h2 class="text-xl font-semibold mb-4">
                    {{ t("analytics.property-status") }}
                </h2>
                <DoughnutChart
                    :chart-data="chartDataStatusListing"
                    :chart-options="chartOptionsStatusListing"
                />
            </div>
            <div class="bg-white rounded-xl p-6 shadow h-96">
                <h2 class="text-xl font-semibold">
                    {{ t("analytics.category-listings") }}
                </h2>
                <BarChart
                    :chart-data="chartDataCategoryListings"
                    :chart-options="chartOptionsCategoryListings"
                />
            </div>
            <div class="bg-white rounded-xl p-6 shadow h-96">
                <h2 class="text-xl font-semibold">
                    {{ t("analytics.revenue-overtime") }}
                </h2>
                <LineChart
                    :chart-data="chartDataRevenueOverTime"
                    :chart-options="chartOptionsRevenueOverTime"
                />
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import BarChart from "@/Components/BarChart.vue";
import DoughnutChart from "@/Components/DoughnutChart.vue";
import LineChart from "@/Components/LineChart.vue";
import { usePage, Head } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";
import { computed } from "vue";

const { t } = useI18n();
const monthlyListings = usePage().props.monthlyListings;
const statusListings = usePage().props.statusListings;
const categoryListings = usePage().props.categoryListings;
const revenueOverTime = usePage().props.revenueOverTime;

// BarChart data and options for monthly listings
const chartDataMonthlyListings = computed(() => ({
    labels: Object.keys(monthlyListings).map((month) => t(`months.${month}`)),
    datasets: [
        {
            label: t("analytics.properties"),
            data: Object.values(monthlyListings),
            backgroundColor: "#3b82f6",
            borderColor: "#1d4ed8",
            borderWidth: 1,
            borderRadius: 4,
            hoverBackgroundColor: "#2563eb",
        },
    ],
}));

const chartOptionsMonthlyListings = computed(() => ({
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {
            position: "top",
            labels: {
                boxWidth: 12,
                padding: 20,
                usePointStyle: true,
            },
        },
        tooltip: {
            backgroundColor: "#1e293b",
            titleColor: "#f8fafc",
            bodyColor: "#e2e8f0",
            padding: 12,
            cornerRadius: 8,
            displayColors: false,
        },
    },
    scales: {
        x: {
            grid: {
                display: false,
            },
            title: {
                display: true,
                text: t("analytics.months"),
                color: "#64748b",
                font: {
                    weight: "bold",
                },
            },
            ticks: {
                color: "#64748b",
            },
        },
        y: {
            grid: {
                color: "#e2e8f0",
            },
            title: {
                display: true,
                text: t("analytics.properties-number"),
                color: "#64748b",
                font: {
                    weight: "bold",
                },
            },
            beginAtZero: true,
            ticks: {
                stepSize: 1,
                color: "#64748b",
            },
        },
    },
}));

// DonutChart data and options for status of listings
const chartDataStatusListing = computed(() => ({
    labels: Object.keys(statusListings).map((status) => t(`status.${status}`)),
    datasets: [
        {
            label: t("analytics.properties"),
            data: Object.values(statusListings),
            backgroundColor: ["#3b82f6", "#10b981", "#ef4444", "#f59e0b"],
            borderColor: "#ffffff",
            borderWidth: 2,
            hoverBackgroundColor: ["#2563eb", "#059669", "#dc2626", "#d97706"],
            hoverBorderColor: "#ffffff",
            hoverOffset: 5,
            spacing: 2,
        },
    ],
}));

const chartOptionsStatusListing = {
    responsive: true,
    maintainAspectRatio: false,
    cutout: "65%",
    plugins: {
        legend: {
            position: "right",
            labels: {
                padding: 16,
                usePointStyle: true,
                pointStyle: "circle",
                boxWidth: 8,
                boxHeight: 8,
                color: "#334155",
                font: {
                    size: 13,
                    family: "'Inter', sans-serif",
                },
            },
        },
        tooltip: {
            backgroundColor: "#1e293b",
            titleColor: "#f8fafc",
            bodyColor: "#e2e8f0",
            borderColor: "#334155",
            borderWidth: 1,
            padding: 12,
            cornerRadius: 8,
            displayColors: true,
            usePointStyle: true,
        },
    },
};

// BarChart data and options for category listings
const chartDataCategoryListings = computed(() => ({
    labels: Object.keys(categoryListings).map((cate) => t(`category.${cate}`)),
    datasets: [
        {
            label: t("analytics.properties"),
            data: Object.values(categoryListings),
            backgroundColor: "#3b82f6",
            borderColor: "#1d4ed8",
            borderWidth: 1,
            borderRadius: 4,
            hoverBackgroundColor: "#2563eb",
        },
    ],
}));

const chartOptionsCategoryListings = computed(() => ({
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {
            position: "top",
            labels: {
                boxWidth: 12,
                padding: 20,
                usePointStyle: true,
            },
        },
        tooltip: {
            backgroundColor: "#1e293b",
            titleColor: "#f8fafc",
            bodyColor: "#e2e8f0",
            padding: 12,
            cornerRadius: 8,
            displayColors: false,
        },
    },
    scales: {
        x: {
            grid: {
                display: false,
            },
            title: {
                display: true,
                text: t("analytics.categories"),
                color: "#64748b",
                font: {
                    weight: "bold",
                },
            },
            ticks: {
                color: "#64748b",
            },
        },
        y: {
            grid: {
                color: "#e2e8f0",
            },
            title: {
                display: true,
                text: t("analytics.properties-number"),
                color: "#64748b",
                font: {
                    weight: "bold",
                },
            },
            beginAtZero: true,
            ticks: {
                stepSize: 1,
                color: "#64748b",
            },
        },
    },
}));

// LineChart data and options for revenue over time
const chartDataRevenueOverTime = computed(() => ({
    labels: Object.keys(revenueOverTime).map((months) => t(`months.${months}`)),

    datasets: [
        {
            label: t("analytics.monthly-revenue"),
            data: Object.values(revenueOverTime),
            fill: true,
            backgroundColor: (context) => {
                const ctx = context.chart.ctx;
                const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                gradient.addColorStop(0, "rgba(59, 130, 246, 0.3)");
                gradient.addColorStop(1, "rgba(59, 130, 246, 0.05)");
                return gradient;
            },
            borderColor: "#3b82f6",
            borderWidth: 2,
            tension: 0.01,
            pointBackgroundColor: "#ffffff",
            pointBorderColor: "#3b82f6",
            pointRadius: 4,
            pointHoverRadius: 8,
            pointHitRadius: 15,
            pointBorderWidth: 2,
        },
    ],
}));

const chartOptionsRevenueOverTime = computed(() => ({
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {
            position: "top",
            labels: {
                boxWidth: 12,
                padding: 20,
                usePointStyle: true,
                color: "#334155",
                font: {
                    size: 13,
                    family: "'Inter', sans-serif",
                },
            },
        },
        tooltip: {
            backgroundColor: "#1e293b",
            titleColor: "#f8fafc",
            bodyColor: "#e2e8f0",
            padding: 12,
            cornerRadius: 8,
            borderColor: "#334155",
            borderWidth: 1,
        },
    },
    scales: {
        x: {
            grid: {
                display: false,
            },
            title: {
                display: true,
                text: t("analytics.months"),
                color: "#64748b",
                font: {
                    weight: "bold",
                    size: 13,
                },
                padding: { top: 10 },
            },
            ticks: {
                color: "#64748b",
                font: {
                    size: 12,
                },
            },
        },
        y: {
            grid: {
                color: "#e2e8f0",
                drawBorder: false,
                tickLength: 0,
            },
            title: {
                display: true,
                text: t("analytics.revenue"),
                color: "#64748b",
                font: {
                    weight: "bold",
                    size: 13,
                },
                padding: { bottom: 10 },
            },
            beginAtZero: true,
            ticks: {
                color: "#64748b",
                font: {
                    size: 12,
                },
                callback: (value) => {
                    if (value >= 1000) {
                        return `€ ${(value / 1000).toFixed(
                            value % 1000 === 0 ? 0 : 1
                        )}k`;
                    }
                    return `€ ${value}`;
                },
            },
        },
    },
}));
</script>
