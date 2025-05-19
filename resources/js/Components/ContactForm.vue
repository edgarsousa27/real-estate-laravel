<template>
    <div class="bg-white shadow-lg rounded-lg p-6 md:p-8 lg:p-10">
        <div>
            <h1 class="text-xl font-semibold">
                {{ props.properties.user.name }}
            </h1>
            <button
                v-if="!number"
                class="border bg-white border-blue-500 text-blue-500 rounded-full p-1 mt-2 hover:bg-blue-500 hover:text-white"
                @click="number = !number"
            >
                Mostrar número
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
        <div class="mt-4">
            <h1 class="text-xl font-semibold text-blue-500">
                Você está interessado nesta propriedade?
            </h1>
            <p class="text-sm mb-5">
                Entre em contato rapidamente com o anunciante para visitá-la!
            </p>
        </div>
        <form class="space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <InputLabel for="firstName" value="Primeiro Nome" />
                    <TextInput type="text" id="firstName" class="w-full" />
                </div>
                <div>
                    <InputLabel for="lastName" value="Sobrenome" />
                    <TextInput type="text" id="lastName" class="w-full" />
                </div>
            </div>

            <div>
                <InputLabel for="email" value="E-mail" />
                <TextInput type="email" id="email" class="w-full" />
            </div>

            <div>
                <InputLabel for="phone" value="Telemóvel" />
                <TextInput
                    type="tel"
                    id="phone"
                    class="w-full"
                    placeholder="912345678"
                />
            </div>

            <div>
                <InputLabel for="message" value="Mensagem" />
                <textarea
                    id="message"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 h-32"
                ></textarea>
            </div>

            <div class="pt-2">
                <button
                    type="submit"
                    class="bg-blue-600 rounded-full text-white px-6 py-2 hover:bg-blue-700 w-full sm:w-auto"
                >
                    Enviar
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { useI18n } from "vue-i18n";
import { ref } from "vue";

const number = ref(false);

const { t } = useI18n();
const props = defineProps({
    properties: Object,
});
</script>
