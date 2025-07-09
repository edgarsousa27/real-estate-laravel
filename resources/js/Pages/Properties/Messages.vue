<template>
    <Head :title="`${t('messages.title')} (${messages.length})`" />
    <AdminLayout :title="t('messages.title')">
        <div class="py-8 px-4 sm:px-6 lg:px-8">
            <h1
                class="mb-6 text-2xl font-bold text-gray-900 sm:text-3xl lg:mb-8 lg:text-center text-center sm:text-center"
            >
                {{ t("messages.title") }} ({{ messages.length }})
            </h1>
            <div v-if="messages.length === 0" class="text-center">
                <p>{{ t("messages.text") }}</p>
            </div>
            <div v-else class="space-y-4">
                <div
                    v-for="message in messages"
                    :key="message.id"
                    class="border p-4 rounded-lg shadow cursor-pointer"
                    @click="openUpdateModal(message)"
                >
                    <div class="text-sm text-gray-600 mb-1">
                        <span
                            v-if="
                                message.sender.id === $page.props.auth.user.id
                            "
                        >
                            {{ t("messages.to")
                            }}<strong>{{ message.receiver.name }}</strong>
                        </span>
                        <span v-else>
                            {{ t("messages.from")
                            }}<strong>{{ message.sender.name }}</strong>
                        </span>
                    </div>
                    <div class="text-gray-800">
                        <p class="mb-1">{{ message.body }}</p>
                        <p class="text-xs text-gray-500">
                            <span class="font-bold">{{
                                t("messages.property")
                            }}</span>
                            {{
                                $t(
                                    message.property.title,
                                    message.property.title_params
                                )
                            }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <InputModal
            v-if="selectedMessage"
            :isOpen="isModalOpen"
            :title="
                selectedMessage.sender
                    ? `${t('messages.message-from')} ${
                          selectedMessage.sender.name
                      }`
                    : `${t('messages.message')}`
            "
            @close="closeModal"
        >
            <form @submit.prevent="submit" class="space-y-4">
                <input type="hidden" :value="selectedMessage.id" />
                <div>
                    <h1 class="text-sm">{{ t("messages.message") }}</h1>
                    <p>{{ selectedMessage.body }}</p>
                </div>
                <div>
                    <h1 class="text-sm">{{ t("messages.property") }}</h1>
                    <a
                        target="_blank"
                        :href="
                            route('properties.show', {
                                slug: selectedMessage.property.slug,
                            })
                        "
                    >
                        {{
                            $t(
                                selectedMessage.property.title,
                                selectedMessage.property.title_params
                            )
                        }}
                    </a>
                </div>
                <div>
                    <textarea
                        name=""
                        id=""
                        v-model="form.body"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 h-16"
                    ></textarea>
                </div>
                <div class="flex justify-end space-x-3 pt-4">
                    <button
                        type="button"
                        @click="closeModal"
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50"
                    >
                        {{ t("messages.cancel") }}
                    </button>
                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-600 rounded-md text-sm font-medium text-white hover:bg-blue-700"
                    >
                        {{ t("messages.reply") }}
                    </button>
                </div>
            </form>
        </InputModal>
    </AdminLayout>
</template>

<script setup>
import { useForm, Head } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import InputModal from "@/Components/InputModal.vue";
import { ref } from "vue";

const { t } = useI18n();

const props = defineProps({
    messages: Array,
    property: Object,
});

const isModalOpen = ref(false);
const selectedMessage = ref(null);

const form = useForm({
    body: "",
    receiver_id: null,
    property_slug: null,
});

const openUpdateModal = (message) => {
    selectedMessage.value = message;
    form.body = "";
    form.receiver_id = message.sender.id;
    form.property_slug = message.property.slug;
    isModalOpen.value = true;
};

const closeModal = () => {
    isModalOpen.value = false;
    selectedMessage.value = null;
    form.reset();
};

const submit = () => {
    form.post(route("message.store", { property: form.property_slug }), {
        onSuccess: () => {
            form.reset();
            closeModal();
        },
    });
};
</script>
