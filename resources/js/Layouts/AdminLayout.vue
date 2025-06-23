<template>
    <div class="min-h-screen bg-gray-50 flex">
        <!-- Mobile menu button -->
        <button
            @click="isSidebarOpen = !isSidebarOpen"
            class="md:hidden fixed bottom-4 right-4 z-50 bg-blue-600 text-white p-3 rounded-full shadow-lg"
        >
            <font-awesome-icon :icon="isSidebarOpen ? 'xmark' : 'bars'" />
        </button>

        <!-- Sidebar -->
        <div
            class="w-64 bg-blue-600 text-white fixed h-full z-40 transition-transform duration-300 ease-in-out"
            :class="
                isSidebarOpen
                    ? 'translate-x-0'
                    : '-translate-x-full md:translate-x-0'
            "
        >
            <div class="p-4 border-b border-blue-700">
                <a :href="route('welcome')">
                    <h1 class="text-xl font-bold">
                        {{ t("admin-dashboard.realestate") }}
                    </h1>
                </a>
            </div>
            <nav class="mt-4">
                <NavLink
                    :href="route('admin.dashboard')"
                    :active="$page.url === '/admin/dashboard'"
                >
                    <font-awesome-icon
                        icon="gauge-high"
                        class="mr-3 text-white"
                    />
                    <span class="text-white">
                        {{ t("admin-dashboard.dashboard") }}</span
                    >
                </NavLink>
                <NavLink
                    :href="route('admin.properties')"
                    :active="$page.url.startsWith('/admin/properties')"
                >
                    <font-awesome-icon icon="home" class="mr-3 text-white" />
                    <span class="text-white">{{
                        t("admin-dashboard.properties")
                    }}</span>
                </NavLink>
                <NavLink
                    :href="route('admin.clients')"
                    :active="$page.url.startsWith('/admin/clients')"
                >
                    <font-awesome-icon
                        icon="address-book"
                        class="mr-3 text-white"
                    />
                    <span class="text-white">{{
                        t("admin-dashboard.clients")
                    }}</span>
                </NavLink>
                <NavLink
                    :href="route('admin.calendar')"
                    :active="$page.url.startsWith('/admin/calendar')"
                >
                    <font-awesome-icon
                        icon="calendar-days"
                        class="mr-3 text-white"
                    />
                    <span class="text-white">{{ t("calendar.page") }}</span>
                </NavLink>
                <NavLink
                    href="/admin/analytics"
                    :active="$page.url.startsWith('/admin/analytics')"
                >
                    <font-awesome-icon
                        icon="chart-bar"
                        class="mr-3 text-white"
                    />
                    <span class="text-white">{{
                        t("admin-dashboard.reports")
                    }}</span>
                </NavLink>
                <NavLink
                    :href="route('logout')"
                    method="post"
                    :active="$page.url.startsWith('/admin/settings')"
                >
                    <font-awesome-icon
                        icon="arrow-right-from-bracket"
                        class="mr-3 text-white"
                    />
                    <span class="text-white">{{
                        t("admin-dashboard.logout")
                    }}</span>
                </NavLink>
            </nav>
        </div>

        <!-- Main Content -->
        <div
            class="flex-1 transition-all duration-300"
            :class="isSidebarOpen ? 'ml-64' : 'md:ml-64'"
        >
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm">
                <div class="flex justify-between items-center p-4">
                    <button
                        @click="isSidebarOpen = !isSidebarOpen"
                        class="md:hidden text-gray-600 hover:text-blue-600"
                    >
                        <font-awesome-icon icon="bars" />
                    </button>
                    <h2 class="text-lg font-semibold text-gray-800">
                        {{ title }}
                    </h2>
                    <div class="flex items-center space-x-4">
                        <ChangeLanguage />
                        <button class="text-gray-600 hover:text-blue-600">
                            <font-awesome-icon icon="bell" />
                        </button>
                        <div class="flex items-center">
                            <span class="ml-2 text-md font-medium">{{
                                "Olá, " + $page.props.auth.user.name
                            }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6">
                <slot />
            </main>
        </div>
    </div>
</template>

<script setup>
import { computed, ref } from "vue";
import { useI18n } from "vue-i18n";
import NavLink from "@/Components/NavLink.vue";
import ChangeLanguage from "@/Components/ChangeLanguage.vue";

const { t } = useI18n();
const isSidebarOpen = ref(false);

defineProps({
    title: String,
});

const logout = () => {
    console.log("Logging out...");
};
</script>

<style scoped>
/* Override NavLink styles for sidebar */
nav :deep(.inline-flex) {
    @apply w-full px-4 py-3 border-b-0 text-left;
}

nav :deep(.inline-flex:hover) {
    @apply bg-blue-700 text-white border-transparent;
}

nav :deep(.border-indigo-400) {
    @apply bg-blue-700 text-white border-l-4 border-blue-300;
}
</style>
