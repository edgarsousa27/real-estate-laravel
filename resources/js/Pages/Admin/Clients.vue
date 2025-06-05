<template>
    <Head>
        <title>{{ t("clients.title") }}</title>
    </Head>
    <AdminLayout :title="t('clients.title')">
        <div class="px-4 sm:px-6 py-4 bg-white rounded-lg shadow">
            <!-- Users Table -->
            <div v-if="!selectedUser">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl sm:text-2xl font-semibold text-gray-800">
                        {{ t("clients.all-clients") }}
                    </h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    {{ t("clients.name") }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    {{ t("clients.id-number") }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    {{ t("clients.tax-number") }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    {{ t("clients.email") }}
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    {{ t("clients.actions") }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="user in users.data" :key="user.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div
                                        class="text-sm font-medium text-gray-900"
                                    >
                                        {{ user.name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">
                                        {{ user.identification_number }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">
                                        {{ user.tax_number }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">
                                        {{ user.email }}
                                    </div>
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium"
                                >
                                    <button
                                        @click="selectUser(user)"
                                        class="text-blue-600 hover:text-blue-900 mr-3"
                                    >
                                        {{ t("clients.view-properties") }}
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <Pagination :links="users.links" class="mt-4" />
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Pagination from "@/Components/Pagination.vue";

const { t } = useI18n();

const props = defineProps({
    users: [Object, Array],
});
</script>
