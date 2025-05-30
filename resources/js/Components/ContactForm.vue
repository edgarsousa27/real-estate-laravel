<template>
    <div class="bg-white shadow-lg rounded-lg p-6 md:p-8 lg:p-10">
        <div>
            <h1 class="text-xl font-semibold">
                {{ props.properties.user.name }}
            </h1>
            <div v-if="props.properties.user.phone_number">
                <button
                    v-if="!number"
                    class="border bg-white border-blue-500 text-blue-500 rounded-full p-1 mt-2 hover:bg-blue-500 hover:text-white"
                    @click="number = !number"
                >
                    {{ t("contact-form.number") }}
                </button>
                <a href="tel:{{ props.properties.user.phone_number }}">
                    <button
                        v-if="number"
                        class="border bg-blue-500 border-blue-500 text-white rounded-full p-1 mt-2"
                    >
                        {{ props.properties.user.phone_number }}
                    </button>
                </a>
            </div>
        </div>
        <div class="mt-4">
            <h1 class="text-xl font-semibold text-blue-500">
                {{ t("contact-form.title") }}
            </h1>
            <p class="text-sm mb-5">
                {{ t("contact-form.subtitle") }}
            </p>
        </div>
        <form class="space-y-4" @submit.prevent="submit">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <InputLabel
                        for="firstName"
                        :value="t('contact-form.name')"
                    />
                    <TextInput
                        type="text"
                        id="firstName"
                        v-model="form.name"
                        class="w-full"
                    />
                </div>
                <div>
                    <InputLabel
                        for="lastName"
                        :value="t('contact-form.lastname')"
                    />
                    <TextInput
                        type="text"
                        id="lastName"
                        v-model="form.lastname"
                        class="w-full"
                    />
                </div>
            </div>

            <div>
                <InputLabel for="email" :value="t('contact-form.email')" />
                <TextInput
                    type="email"
                    id="email"
                    class="w-full"
                    v-model="form.email"
                />
            </div>

            <div>
                <InputLabel for="phone" :value="t('contact-form.phone')" />
                <TextInput
                    type="tel"
                    id="phone"
                    class="w-full"
                    placeholder="912345678"
                    v-model="form.phone_number"
                />
            </div>

            <div>
                <InputLabel for="message" :value="t('contact-form.message')" />
                <textarea
                    id="message"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 h-32"
                    v-model="form.message"
                ></textarea>
            </div>

            <div class="pt-2">
                <button
                    type="submit"
                    class="bg-blue-600 rounded-full text-white px-6 py-2 hover:bg-blue-700 w-full sm:w-auto"
                >
                    {{ t("contact-form.send") }}
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { useI18n } from "vue-i18n";
import { ref, onMounted } from "vue";
import { useForm } from "@inertiajs/vue3";

const number = ref(false);

const { t } = useI18n();
const props = defineProps({
    properties: Object,
});

const form = useForm({
    property_id: props.properties.id,
    name: "",
    lastname: "",
    email: "",
    phone_number: "",
    message: "",
});

onMounted(() => {
    form.property_id = props.properties.id;
});

function submit() {
    form.post(route("properties.contact", { slug: props.properties.slug }), {
        onSuccess: () => form.reset(),
    });
}
</script>
