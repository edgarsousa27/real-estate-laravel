<template>
    <AuthenticatedLayout>
        <div class="py-8 px-4 sm:px-6 lg:px-8">
            <h1
                class="mb-6 text-2xl font-bold text-gray-900 sm:text-4xl lg:mb-8 lg:text-center text-center sm:text-center"
            >
                Notificações
            </h1>
        </div>
        <TableNotificationsContactForm
            :contacts="props.contacts"
            :properties="props.properties"
        />
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TableNotificationsContactForm from "@/Components/TableNotificationsContactForm.vue";

const props = defineProps({
    contacts: Array,
    properties: Object,
});
</script>
