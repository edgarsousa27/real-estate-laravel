<template>
    <Head title="Dashboard" />

    <AdminLayout title="Dashboard">
        <div class="mb-10">
            <StatCard
                :title="
                    t('authenticated.welcome') + ', ' + formatDate(lastLogin)
                "
                :value="$page.props.auth.user.name"
                icon="hands-clapping"
            />
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <Link :href="route('profile.edit')">
                <StatCard
                    :title="t('authenticated.edit-profile-text')"
                    :value="t('authenticated.edit-profile')"
                    icon="user"
                    icon-bg-color="bg-blue-700"
                />
            </Link>
            <Link :href="route('properties.create')">
                <StatCard
                    :title="t('authenticated.announce-text')"
                    :value="t('authenticated.announce')"
                    icon="house-circle-check"
                    icon-bg-color="bg-green-500"
                />
            </Link>
            <Link :href="route('properties.userProperties')">
                <StatCard
                    :title="t('authenticated.my-properties-text')"
                    :value="t('authenticated.my-properties')"
                    icon="house-user"
                />
            </Link>
            <Link :href="route('show.favorites')">
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
import { Head, Link, usePage } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";
import StatCard from "@/Components/StatCard.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { format } from "date-fns";
import { pt, enUS } from "date-fns/locale";

const { t, locale } = useI18n();
const page = usePage();
const lastLogin = page.props.auth.user.last_login_at;

const formatDate = (lastLogin) => {
    if (locale.value === "en")
        return format(
            new Date(lastLogin),
            "'last login on' dd 'of' MMMM 'of' yyyy 'at' HH'h'mm",
            { locale: enUS }
        );
    if (locale.value === "pt")
        return format(
            new Date(lastLogin),
            "'último login em' dd 'de' MMMM 'de' yyyy 'às' HH'h'mm",
            { locale: pt }
        );
};
</script>
