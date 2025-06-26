<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ t("profile.info") }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ t("profile.info-desc") }}
            </p>
        </header>

        <form @submit.prevent="updateProfileInfo()" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" :value="t('profile.name')" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="email" :value="t('profile.email')" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="email"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div>
                <button
                    @click.prevent="display = !display"
                    class="flex items-center gap-2 text-gray-700"
                >
                    <span class="font-medium">{{
                        t("profile.advanced_options")
                    }}</span>
                    <span
                        class="w-5 h-5 transform transition-transform duration-200"
                        :class="{ 'rotate-180': display }"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                            />
                        </svg>
                    </span>
                </button>
            </div>

            <div v-if="display">
                <p class="text-sm text-gray-600">
                    {{ t("profile.advanced_options_info") }}
                </p>

                <div
                    id="advanced-options-section"
                    class="space-y-6 mt-4 p-6 bg-gray-50 rounded-lg border border-gray-200"
                >
                    <!-- Nationality -->
                    <div>
                        <InputLabel
                            for="nationality"
                            :value="t('profile.nationality')"
                            required
                        />
                        <select
                            id="nationality"
                            name="nationality"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 pl-3 pr-10"
                            v-model="form.nationality"
                        >
                            <option
                                v-for="country in countries"
                                :key="country"
                                :value="country"
                            >
                                {{ country }}
                            </option>
                        </select>
                        <InputError
                            class="mt-2"
                            :message="form.errors.nationality"
                        />
                    </div>

                    <!-- Identification Number -->
                    <div>
                        <InputLabel
                            for="identification_number"
                            :value="t('profile.identification_number')"
                            required
                        />
                        <TextInput
                            id="identification_number"
                            type="text"
                            maxlength="8"
                            class="mt-1 block w-full"
                            v-model="form.identification_number"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.identification_number"
                        />
                    </div>

                    <!-- Tax Number -->
                    <div>
                        <InputLabel
                            for="tax_number"
                            :value="t('profile.tax_number')"
                        />
                        <TextInput
                            id="tax_number"
                            type="text"
                            maxlength="9"
                            class="mt-1 block w-full"
                            v-model="form.tax_number"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.tax_number"
                        />
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <InputLabel
                            for="phone_number"
                            :value="t('profile.phone_number')"
                        />
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <span
                                class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-gray-500"
                                >+351</span
                            >
                            <TextInput
                                id="phone_number"
                                type="tel"
                                maxlength="9"
                                class="block w-full rounded-none rounded-r-md"
                                v-model="form.phone_number"
                            />
                        </div>
                        <InputError
                            class="mt-2"
                            :message="form.errors.phone_number"
                        />
                    </div>

                    <!-- Date of Birth -->
                    <div>
                        <InputLabel
                            for="date_of_birth"
                            :value="t('profile.date_of_birth')"
                        />
                        <TextInput
                            id="date_of_birth"
                            type="date"
                            class="mt-1 block w-full"
                            v-model="form.date_of_birth"
                            max="2024-12-31"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.date_of_birth"
                        />
                    </div>
                </div>
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="mt-2 text-sm text-gray-800">
                    {{ t("profile.email-unverified.") }}
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        {{ t("profile.email-resend") }}
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 text-sm font-medium text-green-600"
                >
                    {{ t("profile.email-new") }}
                </div>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">{{
                    t("profile.save")
                }}</PrimaryButton>
            </div>
        </form>
    </section>
</template>

<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";
import { ref } from "vue";
import { useToast } from "vue-toastification";

const { t } = useI18n();
const toast = useToast();

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    countries: {
        type: Array,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
    nationality: user.nationality,
    identification_number: user.identification_number,
    tax_number: user.tax_number,
    phone_number: user.phone_number,
    date_of_birth: user.date_of_birth,
});

const display = ref(false);

const updateProfileInfo = () => {
    form.patch(route("profile.update"), {
        onSuccess: () => {
            toast.info(t("notifications.profile.update"));
        },
        onError: () => {
            toast.error(t("notifications.error.update-profile"));
        },
    });
};
</script>
