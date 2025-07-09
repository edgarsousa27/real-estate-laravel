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
                <a :href="`tel:${props.properties.user.phone_number}`">
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
            <div>
                <InputLabel for="message" :value="t('contact-form.message')" />
                <textarea
                    id="message"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 h-16"
                    v-model="form.body"
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
import { useI18n } from "vue-i18n";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const { t } = useI18n();
const number = ref(false);

const props = defineProps({
    properties: Object,
});

const form = useForm({
    property_id: props.properties.id,
    receiver_id: props.properties.user.id,
    body: "",
});

const submit = () => {
    form.post(route("message.store", { property: props.properties.slug }), {
        onSuccess: () => form.reset("body"),
    });
};
</script>
