<template>
    <footer class="bg-white">
        <div
            class="mx-auto max-w-screen-xl space-y-8 px-4 py-16 sm:px-6 lg:space-y-16 lg:px-8"
        >
            <div class="sm:flex sm:items-center sm:justify-between">
                <div>
                    <ApplicationLogo />
                </div>

                <ul
                    class="mt-8 flex justify-start gap-6 sm:mt-0 sm:justify-end"
                >
                    <li>
                        <a
                            href="#"
                            rel="noreferrer"
                            target="_blank"
                            class="text-gray-700 transition hover:text-blue-500 cursor-pointer"
                        >
                            <span class="sr-only">Facebook</span>

                            <font-awesome-icon
                                :icon="['fab', 'facebook']"
                                class="size-6 text-gray-700 hover:text-blue-500"
                            />
                        </a>
                    </li>

                    <li>
                        <a
                            href="#"
                            rel="noreferrer"
                            target="_blank"
                            class="text-gray-700 transition hover:text-blue-500 cursor-pointer"
                        >
                            <span class="sr-only">Instagram</span>

                            <font-awesome-icon
                                :icon="['fab', 'instagram']"
                                class="size-6 text-gray-700 hover:text-blue-500"
                            />
                        </a>
                    </li>

                    <li>
                        <a
                            href="#"
                            rel="noreferrer"
                            target="_blank"
                            class="text-gray-700 transition hover:text-blue-500 cursor-pointer"
                        >
                            <span class="sr-only">Twitter</span>

                            <font-awesome-icon
                                :icon="['fab', 'twitter']"
                                class="size-6 text-gray-700 hover:text-blue-500"
                            />
                        </a>
                    </li>
                </ul>
            </div>

            <div
                class="grid grid-cols-1 gap-8 border-t border-gray-100 pt-8 sm:grid-cols-2 lg:grid-cols-4 lg:pt-16"
            >
                <div>
                    <p class="font-medium text-gray-900">
                        {{ t("footer.contact-title") }}
                    </p>

                    <ul class="mt-6 space-y-4 text-sm">
                        <li
                            class="text-gray-700 transition hover:text-blue-500 cursor-pointer"
                        >
                            <span class="text-xl px-2"
                                ><font-awesome-icon
                                    icon="phone"
                                    class="size-5 text-gray-700 hover:fill-white"
                            /></span>
                            +351 123 456 789
                        </li>
                        <li
                            class="text-gray-700 transition hover:text-blue-500 cursor-pointer"
                        >
                            <span class="text-xl px-2"
                                ><font-awesome-icon
                                    icon="inbox"
                                    class="size-5 text-gray-700 hover:fill-white"
                            /></span>
                            geral@realestate.pt
                        </li>
                    </ul>

                    <ul class="mt-6 space-y-4 text-sm">
                        <p class="font-medium text-gray-900">
                            {{ t("footer.hours") }}
                        </p>
                        <p>
                            <span class="text-gray-700">{{
                                t("footer.mon-fri")
                            }}</span>
                            <br />
                            <span class="text-gray-700">{{
                                t("footer.sab")
                            }}</span>
                        </p>
                    </ul>
                </div>

                <div>
                    <p class="font-medium text-gray-900">
                        {{ t("footer.explore") }}
                    </p>

                    <ul class="mt-6 space-y-4 text-sm">
                        <li>
                            <a
                                :href="route('search.buy')"
                                class="text-gray-700 transition hover:text-blue-500 cursor-pointer"
                            >
                                {{ t("footer.buy") }}
                            </a>
                        </li>

                        <li>
                            <a
                                :href="route('search.rent')"
                                class="text-gray-700 transition hover:text-blue-500 cursor-pointer"
                            >
                                {{ t("footer.rent") }}
                            </a>
                        </li>

                        <li>
                            <a
                                :href="route('properties.create')"
                                class="text-gray-700 transition hover:text-blue-500 cursor-pointer"
                            >
                                {{ t("footer.sale") }}
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <p class="font-medium text-gray-900">
                        {{ t("footer.about-us") }}
                    </p>

                    <ul class="mt-6 space-y-4 text-sm">
                        <li>
                            <a
                                href="#"
                                class="text-gray-700 transition hover:text-blue-500 cursor-pointer"
                            >
                                {{ t("footer.team") }}
                            </a>
                        </li>

                        <li>
                            <a
                                href="#"
                                class="text-gray-700 transition hover:text-blue-500 cursor-pointer"
                            >
                                {{ t("footer.partners") }}
                            </a>
                        </li>

                        <li>
                            <a
                                href="#"
                                class="text-gray-700 transition hover:text-blue-500 cursor-pointer"
                            >
                                {{ t("footer.careers") }}
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <p class="font-medium text-gray-900">
                        {{ t("footer.legal") }}
                    </p>

                    <ul class="mt-6 space-y-4 text-sm">
                        <li>
                            <a
                                href="#"
                                class="text-gray-700 transition hover:text-blue-500 cursor-pointer"
                            >
                                {{ t("footer.terms") }}
                            </a>
                        </li>

                        <li>
                            <a
                                href="#"
                                class="text-gray-700 transition hover:text-blue-500 cursor-pointer"
                            >
                                {{ t("footer.privacy") }}
                            </a>
                        </li>

                        <li>
                            <a
                                href="#"
                                class="text-gray-700 transition hover:text-blue-500 cursor-pointer"
                            >
                                {{ t("footer.complaints-book") }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <p class="text-xs text-gray-500">&copy; {{ t("footer.rights") }}</p>
        </div>
    </footer>
</template>

<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { useI18n } from "vue-i18n";

const { t } = useI18n();
</script>
