<template>
    <Head title="Dashboard" />

    <AdminLayout title="Dashboard">
        <div class="mb-10">
            <StatCard
                :title="t('authenticated.welcome')"
                :value="$page.props.auth.user.name"
                icon="hands-clapping"
            />
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <Link :href="route('properties.userProperties')">
                <StatCard
                    :title="t('authenticated.announce-text')"
                    :value="t('authenticated.announce')"
                    icon="home"
                    icon-bg-color="bg-green-500"
                />
            </Link>
            <Link :href="route('properties.userProperties')">
                <StatCard
                    :title="t('authenticated.my-properties-text')"
                    :value="t('authenticated.my-properties')"
                    icon="home"
                />
            </Link>
            <Link :href="route('store.favorites')">
                <StatCard
                    :title="t('authenticated.favorites-text')"
                    :value="t('authenticated.favorites')"
                    icon="heart"
                    iconBgColor="bg-red-600"
                />
            </Link>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";
import StatCard from "@/Components/StatCard.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";

const { t } = useI18n();
</script>
A
