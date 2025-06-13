<template>
    <Head>
        <title>{{ t("calendar.page") }}</title>
    </Head>
    <AdminLayout :title="t('calendar.page')">
        <FullCalendar />
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import FullCalendar from "@/Components/FullCalendar.vue";
import { Head } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";
const { t } = useI18n();
</script>
