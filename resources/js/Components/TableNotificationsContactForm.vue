<template>
    <div class="max-w-7xl max-h-6xl mx-auto">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-blue-100">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            {{ t("notifications-page.property") }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ t("notifications-page.name") }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ t("notifications-page.lastname") }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ t("notifications-page.email") }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ t("notifications-page.phone") }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ t("notifications-page.message") }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        @click="openUpdateModal(contact)"
                        v-for="contact in props.contacts"
                        :key="contact"
                        class="bg-white border-b hover:drop-shadow-md cursor-pointer"
                    >
                        <td class="px-3 sm:px-6 py-4 font-medium text-gray-900">
                            <div class="whitespace-nowrap">
                                {{ showPropertiesName(contact.property_id) }}
                            </div>
                        </td>
                        <td class="px-3 sm:px-6 py-4 font-medium text-gray-900">
                            <div class="whitespace-nowrap">
                                {{ contact.name }}
                            </div>
                        </td>
                        <td class="px-3 sm:px-6 py-4 text-gray-900 font-medium">
                            <div class="whitespace-nowrap">
                                {{ contact.lastname }}
                            </div>
                        </td>
                        <td class="px-3 sm:px-6 py-4">
                            <div class="whitespace-nowrap">
                                <a
                                    :href="`mailto:${contact.email}`"
                                    target="_blank"
                                    class="hover:text-blue-500"
                                >
                                    {{ contact.email }}
                                </a>
                            </div>
                        </td>
                        <td class="px-3 sm:px-6 py-4">
                            <div class="whitespace-nowrap">
                                <a
                                    :href="`tel:${contact.phone_number}`"
                                    class="hover:text-blue-500"
                                >
                                    {{ contact.phone_number }}
                                </a>
                            </div>
                        </td>
                        <td class="px-3 sm:px-6 py-4">
                            <div class="flex flex-col sm:flex-row sm:gap-5">
                                <div class="line-clamp-1 sm:w-5/6 break-words">
                                    {{ contact.message }}
                                </div>
                                <div class="sm:w-1/6 mt-2 sm:mt-0">
                                    {{ formatDate(contact.created_at) }}
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <tfoot class="text-xs text-gray-700 uppercase bg-blue-100">
                    <tr>
                        <td colspan="6" class="px-6 py-3 text-center">
                            {{ props.contacts.length }}
                            {{
                                props.contacts.length == 1
                                    ? t("notifications-page.message-receive")
                                    : t("notifications-page.messages-receive")
                            }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div
            v-if="isModalOpen"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 px-6"
        >
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Responder mensagem
                        </h3>
                        <button
                            @click="closeModal"
                            class="text-gray-500 hover:text-gray-700"
                        >
                            <font-awesome-icon
                                icon="xmark"
                                class="size-5 text-gray-700"
                            />
                        </button>
                    </div>

                    <form @submit.prevent="handleSubmit" class="space-y-4">
                        <input type="hidden" v-model="selectedMessage.id" />

                        <div>
                            <label
                                class="block text-md font-semibold text-gray-700"
                                >Nome</label
                            >
                            <p class="mt-1 text-sm text-gray-900">
                                {{ selectedMessage.name }}
                                {{ selectedMessage.lastname }}
                            </p>
                        </div>

                        <div>
                            <label
                                class="block text-md font-semibold text-gray-700"
                                >Contactos</label
                            >
                            <p class="mt-1 text-sm text-gray-900">
                                {{ selectedMessage.email }}
                            </p>
                            <p class="mt-1 text-sm text-gray-900">
                                {{ selectedMessage.phone_number }}
                            </p>
                        </div>

                        <div>
                            <label
                                class="block text-md font-semibold text-gray-700"
                                >Mensagem do cliente</label
                            >
                            <p
                                class="mt-1 text-sm text-gray-900 whitespace-pre-line"
                            >
                                {{ selectedMessage.message }}
                            </p>
                        </div>

                        <div>
                            <label
                                for="response"
                                class="block text-md font-semibold text-gray-700"
                                >Responder</label
                            >
                            <textarea
                                id="response"
                                v-model="responseText"
                                rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                placeholder="Escreva a sua resposta aqui..."
                            ></textarea>
                        </div>

                        <div class="flex justify-end space-x-3 pt-4">
                            <button
                                type="button"
                                @click="closeModal"
                                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50"
                            >
                                {{ t("update-form.cancel") }}
                            </button>
                            <button
                                type="submit"
                                class="px-4 py-2 bg-blue-600 rounded-md text-sm font-medium text-white hover:bg-blue-700"
                            >
                                Enviar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { format } from "date-fns";
import { pt } from "date-fns/locale";
import { enUS } from "date-fns/locale";
import { useI18n } from "vue-i18n";
import { ref } from "vue";

const { t, locale } = useI18n();

const props = defineProps({
    contacts: Array,
    properties: Object,
});

const isModalOpen = ref(false);

const closeModal = () => {
    isModalOpen.value = false;
};

const selectedMessage = ref({
    id: null,
    name: null,
    lastname: null,
    email: null,
    phone_number: null,
    message: null,
    property_id: null,
});

const openUpdateModal = (contact) => {
    selectedMessage.value = { ...contact };
    isModalOpen.value = true;
};

const showPropertiesName = (property_id) => {
    const PropertyName = props.properties.find(
        (proper_name) => proper_name.id === property_id
    );

    return PropertyName.title;
};

const formatDate = (dateStr) => {
    if (locale.value === "en")
        return format(new Date(dateStr), "yyyy/MM/dd HH:mm", { locale: enUS });
    if (locale.value === "pt")
        return format(new Date(dateStr), "dd/MM/yyyy HH:mm", { locale: pt });
};
</script>
