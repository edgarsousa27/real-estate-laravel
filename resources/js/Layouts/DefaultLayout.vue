<template>
    <div>
        <div class="min-h-screen bg-white overflow-hidden">
            <nav class="mt-3">
                <!-- Primary Navigation Menu -->
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-20 justify-between">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex shrink-0 items-center">
                                <Link :href="route('welcome')">
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current text-gray-800"
                                    />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div
                                class="hidden sm:-my-px sm:ms-10 sm:flex sm:items-center sm:space-x-8"
                            >
                                <Dropdown
                                    align="center"
                                    width="48"
                                    class="hover:bg-blue-200 rounded-full"
                                >
                                    <template #trigger>
                                        <button
                                            type="button"
                                            class="inline-flex items-center px-3 py-2 text-md font-medium transition duration-150 ease-in-out group hover:text-lime-400"
                                        >
                                            {{ t("buttons.buy") }}
                                            <svg
                                                class="ml-1 h-4 w-4 text-gray-500 group-hover:text-gray-700 transition duration-150 ease-in-out"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                    </template>

                                    <template #content>
                                        <div class="py-1">
                                            <div
                                                class="flex gap-2 px-4 py-2 text-start font-bold text-xl"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.5"
                                                    stroke="currentColor"
                                                    class="size-6"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"
                                                    />
                                                </svg>

                                                <span>{{
                                                    t("buttons.looking-for")
                                                }}</span>
                                            </div>
                                            <DropdownLink
                                                :href="
                                                    route('properties', {
                                                        'filter[houses-apartments]':
                                                            'houses-apartments',
                                                        'filter[transaction]':
                                                            'buy',
                                                    })
                                                "
                                                >{{
                                                    t(
                                                        "buttons.houses-apartments"
                                                    )
                                                }}</DropdownLink
                                            >
                                            <DropdownLink
                                                :href="
                                                    route('properties', {
                                                        'filter[houses]':
                                                            'houses',
                                                        'filter[transaction]':
                                                            'buy',
                                                    })
                                                "
                                            >
                                                {{ t("buttons.houses") }}
                                            </DropdownLink>
                                            <DropdownLink
                                                :href="
                                                    route('properties', {
                                                        'filter[apartments]':
                                                            'apartments',
                                                        'filter[transaction]':
                                                            'buy',
                                                    })
                                                "
                                            >
                                                {{ t("buttons.apartments") }}
                                            </DropdownLink>
                                            <DropdownLink
                                                :href="
                                                    route('properties', {
                                                        'filter[lands]':
                                                            'lands',
                                                        'filter[transaction]':
                                                            'buy',
                                                    })
                                                "
                                                >{{
                                                    t("buttons.land")
                                                }}</DropdownLink
                                            >
                                        </div>
                                    </template>
                                </Dropdown>

                                <!--Rent out dropdrown-->

                                <Dropdown
                                    align="center"
                                    width="48"
                                    class="hover:bg-blue-200 rounded-full"
                                >
                                    <template #trigger>
                                        <button
                                            type="button"
                                            class="inline-flex items-center px-3 py-2 text-md font-medium text-gray-700 hover:text-gray-900 focus:outline-none transition duration-150 ease-in-out group"
                                        >
                                            {{ t("buttons.rent") }}
                                            <svg
                                                class="ml-1 h-4 w-4 text-gray-500 group-hover:text-gray-700 transition duration-150 ease-in-out"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                    </template>

                                    <template #content>
                                        <div class="py-1">
                                            <div
                                                class="flex gap-2 px-4 py-2 text-start font-bold text-xl"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.5"
                                                    stroke="currentColor"
                                                    class="size-6"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"
                                                    />
                                                </svg>

                                                <span>{{
                                                    t("buttons.looking-for")
                                                }}</span>
                                            </div>
                                            <DropdownLink
                                                :href="
                                                    route('properties', {
                                                        'filter[houses-apartments]':
                                                            'houses-apartments',
                                                        'filter[transaction]':
                                                            'rent',
                                                    })
                                                "
                                                >{{
                                                    t(
                                                        "buttons.houses-apartments"
                                                    )
                                                }}</DropdownLink
                                            >
                                            <DropdownLink
                                                :href="
                                                    route('properties', {
                                                        'filter[houses]':
                                                            'houses',
                                                        'filter[transaction]':
                                                            'rent',
                                                    })
                                                "
                                            >
                                                {{ t("buttons.houses") }}
                                            </DropdownLink>
                                            <DropdownLink
                                                :href="
                                                    route('properties', {
                                                        'filter[apartments]':
                                                            'apartments',
                                                        'filter[transaction]':
                                                            'rent',
                                                    })
                                                "
                                            >
                                                {{ t("buttons.apartments") }}
                                            </DropdownLink>
                                            <DropdownLink
                                                :href="
                                                    route('properties', {
                                                        'filter[lands]':
                                                            'lands',
                                                        'filter[transaction]':
                                                            'rent',
                                                    })
                                                "
                                                >{{
                                                    t("buttons.land")
                                                }}</DropdownLink
                                            >
                                        </div>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <div class="hidden sm:ms-6 sm:flex sm:items-center">
                            <!-- Settings Dropdown -->
                            <div
                                class="relative ms-3"
                                v-if="$page.props.auth.user"
                            >
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-md font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                                            >
                                                {{ $page.props.auth.user.name }}
                                                <svg
                                                    class="-me-0.5 ms-2 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink
                                            :href="route('dashboard')"
                                        >
                                            {{ t("authenticated.dashboard") }}
                                        </DropdownLink>
                                        <DropdownLink
                                            :href="route('profile.edit')"
                                        >
                                            {{ t("authenticated.profile") }}
                                        </DropdownLink>

                                        <DropdownLink
                                            :href="route('logout')"
                                            method="post"
                                            as="button"
                                        >
                                            {{ t("authenticated.logout") }}
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                            <div v-else>
                                <NavLink :href="route('login')">
                                    {{ t("buttons.my-account") }}
                                </NavLink>
                            </div>
                            <ChangeLanguage class="pl-5"></ChangeLanguage>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button
                                @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                "
                                class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none"
                            >
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex':
                                                !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex':
                                                showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden"
                >
                    <div class="space-y-1 pb-3 pt-2">
                        <ResponsiveNavLink
                            :href="
                                route('properties', {
                                    'filter[transaction]': 'buy',
                                })
                            "
                        >
                            {{ t("buttons.buy") }}
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            :href="
                                route('properties', {
                                    'filter[transaction]': 'rent',
                                })
                            "
                        >
                            {{ t("buttons.rent") }}
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div
                        class="border-t border-gray-200 pb-1 pt-4"
                        v-if="$page.props.auth.user"
                    >
                        <div class="px-4" v-if="$page.props.auth.user">
                            <div class="text-base font-medium text-gray-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="text-sm font-medium text-gray-500">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('dashboard')">
                                {{ t("authenticated.dashboard") }}
                            </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('profile.edit')">
                                {{ t("authenticated.profile") }}
                            </ResponsiveNavLink>
                            <ResponsiveNavLink
                                :href="route('logout')"
                                method="post"
                                as="button"
                            >
                                {{ t("authenticated.logout") }}
                            </ResponsiveNavLink>
                        </div>
                    </div>
                    <div v-else>
                        <ResponsiveNavLink :href="route('login')">
                            {{ t("buttons.my-account") }}
                        </ResponsiveNavLink>
                    </div>
                    <div>
                        <ChangeLanguage class="px-4 py-4"></ChangeLanguage>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
        <Footer />
    </div>
</template>

<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import ChangeLanguage from "@/Components/ChangeLanguage.vue";
import Footer from "@/Components/Footer.vue";

const showingNavigationDropdown = ref(false);
const { t } = useI18n();
</script>
