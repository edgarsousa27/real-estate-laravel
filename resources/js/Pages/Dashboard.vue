<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg mb-10"
                >
                    <div class="p-6 text-gray-900 text-xl">
                        {{ t("authenticated.logged") }}
                        {{ $page.props.auth.user.name }}
                    </div>
                </div>

                <div class="mb-5">
                    <Link :href="route('properties.userProperties')">
                        <StatCard
                            value="Meus Imóveis"
                            icon="home"
                            iconBgColor="bg-blue-600"
                        />
                    </Link>
                </div>
                <div class="mb-5">
                    <Link :href="route('store.favorites')">
                        <StatCard
                            value="Meus Favoritos"
                            icon="heart"
                            iconBgColor="bg-red-600"
                        />
                    </Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";
import StatCard from "@/Components/StatCard.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";

const { t } = useI18n();
</script>
