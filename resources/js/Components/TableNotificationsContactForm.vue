<template>
    <div class="max-w-7xl max-h-6xl mx-auto">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-blue-100">
                    <tr>
                        <th scope="col" class="px-6 py-3">Imóvel</th>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Last name</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Phone</th>
                        <th scope="col" class="px-6 py-3">Message</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
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
                                    ? "mensagem recebida"
                                    : "mensagens recebidas"
                            }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</template>

<script setup>
import { format } from "date-fns";
import { pt } from "date-fns/locale";

const props = defineProps({
    contacts: Array,
    properties: Object,
});

const showPropertiesName = (property_id) => {
    const PropertyName = props.properties.find(
        (proper_name) => proper_name.id === property_id
    );

    return PropertyName.title;
};

const formatDate = (dateStr) => {
    return format(new Date(dateStr), "dd/MM/yyyy HH:mm", { locale: pt });
};
</script>
