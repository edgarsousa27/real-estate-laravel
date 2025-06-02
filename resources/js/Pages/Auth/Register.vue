<template>
    <GuestLayout>
        <Head :title="t('register-login.register-title')" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" :value="t('register-login.name')" />

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

            <div class="mt-4">
                <InputLabel for="email" :value="t('register-login.email')" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="identification_number"
                    :value="t('register-login.identification_number')"
                />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.identification_number"
                    required
                    autofocus
                    autocomplete="identification_number"
                    maxlength="12"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.identification_number"
                />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="tax_number"
                    :value="t('register-login.tax_number')"
                />

                <TextInput
                    id="name"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.tax_number"
                    required
                    autofocus
                    autocomplete="tax_number"
                    maxlength="9"
                />

                <InputError class="mt-2" :message="form.errors.tax_number" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="phone_number"
                    :value="t('register-login.phone_number')"
                />

                <TextInput
                    id="name"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.phone_number"
                    required
                    autofocus
                    autocomplete="phone_number"
                    maxlength="9"
                />

                <InputError class="mt-2" :message="form.errors.phone_number" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="password"
                    :value="t('register-login.password')"
                />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="password_confirmation"
                    :value="t('register-login.confirm-password')"
                />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <div class="relative flex items-center justify-end mt-10">
                <Link
                    :href="route('login')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    {{ t("register-login.already-register") }}
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    {{ t("register-login.register") }}
                </PrimaryButton>

                <div class="absolute bottom-0 left-0">
                    <ChangeLanguage />
                </div>
            </div>
        </form>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import ChangeLanguage from "@/Components/ChangeLanguage.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";

const { t } = useI18n();

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    tax_number: "",
    identification_number: "",
    phone_number: "",
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>
