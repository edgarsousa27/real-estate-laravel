<template>
    <Head>
        <title>
            {{ $t(props.properties.title, props.properties.title_params) }}
        </title>
    </Head>
    <DefaultLayout>
        <div class="py-4 md:px-4 w-full sm:px-6 lg:px-8">
            <div
                v-if="
                    props.properties.status === 'active' &&
                    props.properties.user_id === props.authUser
                "
                class="mb-6 p-4 bg-green-50 border-l-4 border-green-400 max-w-7xl mx-auto"
            >
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <font-awesome-icon
                            icon="check"
                            class="h-5 w-5 text-green-400"
                        />
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">
                            {{ t("admin-dashboard.property-details-text") }}
                            <span class="font-bold">
                                {{ t("admin-dashboard.active") }} </span
                            >.
                        </p>
                    </div>
                </div>
            </div>

            <div
                v-if="props.properties.status === 'pending'"
                class="mb-6 p-4 bg-yellow-50 border-l-4 border-yellow-400 max-w-7xl mx-auto"
            >
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <font-awesome-icon
                            icon="exclamation-triangle"
                            class="h-5 w-5 text-yellow-400"
                        />
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            {{ t("admin-dashboard.property-details-text") }}
                            <span class="font-bold">
                                {{
                                    t("admin-dashboard.property-details-text2")
                                }} </span
                            >.
                        </p>
                    </div>
                </div>
            </div>

            <div
                v-if="props.properties.status === 'refused'"
                class="mb-6 p-4 bg-red-50 border-l-4 border-red-400 max-w-7xl mx-auto"
            >
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <font-awesome-icon
                            icon="xmark"
                            class="h-5 w-5 text-red-400"
                        />
                    </div>
                    <div class="ml-3">
                        <div class="text-sm text-red-700 space-y-2">
                            <p>
                                {{ t("admin-dashboard.refused-text") }}
                                <span class="font-bold">
                                    {{ t("admin-dashboard.refused") }}.
                                </span>
                            </p>
                            <p class="text-lg">
                                {{ t("admin-dashboard.reason") }}
                                {{ props.properties.reason_for_refusal }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-5 px-4 lg:px-8"
            >
                <div
                    class="w-full sm:w-full md:w-full lg:w-2/3 xl:w-2/3 sm:rounded-lg md:rounded-xl overflow-hidden"
                >
                    <div>
                        <PropertiesShow
                            :images="props.properties.media"
                            :properties="props.properties"
                            :favorites="props.favorites"
                        />
                    </div>

                    <div
                        class="flex flex-col sm:flex-row justify-between items-start sm:items-center mt-4 gap-2"
                    >
                        <h1
                            class="ml-3 text-xl sm:text-2xl font-bold text-gray-800 break-words max-w-sm"
                        >
                            {{
                                $t(
                                    props.properties.title,
                                    props.properties.title_params
                                )
                            }}
                        </h1>
                        <h1
                            class="ml-3 text-xl sm:text-2xl font-bold text-blue-500"
                        >
                            {{ formatPrice(props.properties.price) + "€" }}
                        </h1>
                    </div>

                    <div
                        class="flex items-center gap-2 mt-3 ml-3 mb-10 text-gray-600 text-lg"
                    >
                        <font-awesome-icon
                            icon="location-dot"
                            class="size-5 text-red-600"
                        />
                        <span>
                            {{ props.properties.district }},
                            {{ props.properties.city }}
                        </span>
                    </div>

                    <EssentialsHighlights :properties="props.properties" />

                    <hr
                        class="my-8"
                        v-if="
                            props.properties.category_id === 1 ||
                            props.properties.category_id === 2
                        "
                    />

                    <InteriorHighlights
                        v-if="
                            props.properties.category_id === 1 ||
                            props.properties.category_id === 2
                        "
                        :properties="props.properties"
                    />

                    <hr
                        class="my-8"
                        v-if="
                            props.properties.category_id === 1 ||
                            props.properties.category_id === 2
                        "
                    />

                    <OutdoorHighlights
                        v-if="
                            props.properties.category_id === 1 ||
                            props.properties.category_id === 2
                        "
                        :properties="props.properties"
                    />

                    <hr class="my-8" />

                    <div class="gap-2 mt-3 ml-3 mb-10 text-gray-800 text-lg">
                        <h1 class="text-xl font-semibold mb-4 mt-4">
                            {{ t("details-page.description") }}
                        </h1>
                        <p
                            class="text-justify leading-relaxed text-base text-gray-800 mb-4 whitespace-pre-line"
                        >
                            {{ props.properties.description }}
                        </p>
                    </div>

                    <hr
                        class="my-8"
                        v-if="
                            props.properties.category_id === 1 ||
                            props.properties.category_id === 2
                        "
                    />

                    <EnergyBalance
                        :properties="props.properties"
                        v-if="
                            props.properties.category_id === 1 ||
                            props.properties.category_id === 2
                        "
                    />
                </div>

                <div class="w-full lg:w-1/3 space-y-6">
                    <!-- Owner Tools Section -->
                    <div
                        v-if="authUser === props.properties.user_id"
                        class="bg-white rounded-lg shadow-md p-6"
                    >
                        <div class="space-y-4">
                            <a :href="route('properties.userProperties')">
                                <button
                                    class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-lg transition-all"
                                >
                                    <font-awesome-icon
                                        icon="pen-to-square"
                                        class="size-5"
                                    />
                                    {{ t("update-form.properties") }}
                                </button>
                            </a>
                        </div>
                    </div>

                    <!-- Contact Form Section for Non-Owners -->
                    <div
                        v-if="authUser !== props.properties.user_id"
                        class="bg-white rounded-lg shadow-md overflow-hidden"
                    >
                        <ContactForm
                            :properties="props.properties"
                            :contact="props.contact"
                        />
                        <div
                            v-if="props.properties.transaction_id === 1"
                            class="mt-6 border-t border-gray-100"
                        >
                            <CreditSimulator :properties="props.properties" />
                        </div>
                    </div>
                </div>
            </div>

            <Map :properties="props.properties" />
            e
            <div
                class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8"
                v-if="props.similarProperties.length > 0"
            >
                <div class="mt-10 text-center text-2xl text-gray-900 mb-12">
                    <span class="font-bold">{{
                        t("details-page.other-properties")
                    }}</span>
                    {{ t("details-page.other-properties2") }}
                </div>
                <Properties
                    :images="props.properties.media"
                    :properties="props.similarProperties"
                    :categories="props.categories"
                    :favorites="props.favorites"
                />
            </div>
        </div>
    </DefaultLayout>
</template>

<script setup>
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import PropertiesShow from "@/Components/PropertiesShow.vue";
import EssentialsHighlights from "./Partials/EssentialsHighlights.vue";
import InteriorHighlights from "./Partials/InteriorHighlights.vue";
import OutdoorHighlights from "./Partials/OutdoorHighlights.vue";
import ContactForm from "@/Components/ContactForm.vue";
import EnergyBalance from "./Partials/EnergyBalance.vue";
import CreditSimulator from "@/Components/CreditSimulator.vue";
import Map from "@/Components/Map.vue";
import Properties from "@/Components/Properties.vue";
import { Head } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";
const { t } = useI18n();

const props = defineProps({
    properties: Object,
    authUser: Number,
    favorites: Array,
    similarProperties: Array,
});

const formatPrice = (price) => {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
};
</script>
