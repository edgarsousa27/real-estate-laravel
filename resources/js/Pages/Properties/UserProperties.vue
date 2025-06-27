<template>
    <Head :title="`${t('authenticated.my-properties')} (${props.properties.data.length})`" />

    <AdminLayout :title="t('authenticated.my-properties')">
        <div class="py-8 px-4 sm:px-6 lg:px-8">
            <h1
                class="mb-6 text-2xl font-bold text-gray-900 sm:text-3xl lg:mb-8 lg:text-center text-center sm:text-center"
            >
                {{ t("authenticated.my-properties") }} ({{ props.properties.data.length }})
            </h1>

            <MyProperties
                v-if="props.properties.data.length > 0"
                :properties="props.properties.data"
                :categories="props.categories"
                :district="props.district"
                :cities="props.cities"
                :postal_code="props.postal_code"
            />

            <div class="text-center" v-else>
                <p class="text-gray-500">
                        <p class="font-semibold">{{ t("myproperties.text") }}</p>
                        {{ t("myproperties.text2") }}</p>
                <Link :href="route('properties.create')">
                    <PrimaryButton  class="mt-5 bg-green-500 hover:bg-green-600"
                        >{{ t("authenticated.announce") }}</PrimaryButton
                    >
                </Link>
            </div>

            <Pagination
                v-if="props.properties.data.length > 0"
                :links="props.properties.links"
            />
        </div>
    </AdminLayout>
</template>

<script setup>
import MyProperties from "@/Components/MyProperties.vue";
import Pagination from "@/Components/Pagination.vue";
import { useI18n } from "vue-i18n";
import { Head, Link } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const { t } = useI18n();

const props = defineProps({
    properties: [Array, Object],
    categories: Array,
    district: Array,
    cities: Object,
    postal_code: Object,
});
</script>
