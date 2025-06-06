<template>
    <Head>
        <title>{{ t("clients.title") }}</title>
    </Head>
    <AdminLayout :title="t('clients.title')">
        <div class="px-4 sm:px-6 py-4 bg-white rounded-lg shadow">
            <!-- Users Table -->
            <div>
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl sm:text-2xl font-semibold text-gray-800">
                        {{ t("clients.all-clients") }}
                    </h2>
                </div>

                <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <InputLabel :value="t('admin-dashboard.search')" />
                            <TextInput
                                :placeholder="t('clients.placeholder-search')"
                                type="text"
                                v-model="query"
                                @keyup.enter="search"
                            />
                        </div>
                    </div>
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
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr
                                @click="redirectsTopage(client)"
                                v-for="client in clients.data"
                                :key="client.id"
                                class="cursor-pointer hover:bg-gray-50"
                            >
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div
                                        class="text-sm font-medium text-gray-900"
                                    >
                                        {{ client.name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">
                                        {{ client.identification_number }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">
                                        {{ client.tax_number }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">
                                        {{ client.email }}
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <Pagination :links="clients.links" class="mt-4" />
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head, router } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { ref } from "vue";

const { t } = useI18n();

const props = defineProps({
    clients: [Object, Array],
    query: String,
});

const redirectsTopage = (client) => {
    return (window.location.href = route("admin.clients.show", {
        client: client.id,
    }));
};

const query = ref("");

const search = () => {
    router.get(
        route("admin.clients"),
        {
            query: query.value,
        },
        {
            preserveState: true,
            preserveScroll: true,
        }
    );
};
</script>
