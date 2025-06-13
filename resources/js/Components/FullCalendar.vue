<template>
    <FullCalendar :options="calendarOptions" :key="calendarKey" />

    <InputModal
        :isOpen="isModalOpen"
        :title="t('calendar.add-event')"
        @close="closeModal"
    >
        <form @submit.prevent="addEvent" class="space-y-4">
            <input type="hidden" />

            <div>
                <InputLabel :value="t('calendar.title')" class="mt-3" />
                <TextInput type="text" v-model="form.title" />

                <div
                    class="flex items-center gap-3 mt-3"
                    v-if="!form.more_days"
                >
                    <Checkbox
                        id="all_day"
                        :value="true"
                        v-model:checked="form.all_day"
                    />
                    <InputLabel :value="t('calendar.all-day')" />
                </div>

                <div class="flex items-center gap-3 mt-3" v-if="!form.all_day">
                    <Checkbox
                        id="more_days"
                        :value="true"
                        v-model:checked="form.more_days"
                    />
                    <InputLabel :value="t('calendar.many-days')" />
                </div>

                <div class="flex items-center gap-3 mt-3">
                    <Checkbox
                        id="important"
                        :value="true"
                        v-model:checked="form.important"
                    />
                    <InputLabel :value="t('calendar.important')" />
                </div>

                <div v-if="form.all_day || form.more_days || !form.all_day">
                    <InputLabel
                        :value="t('calendar.start-date')"
                        class="mt-3"
                    />
                    <TextInput type="date" v-model="form.start_date" />
                </div>

                <div v-if="!form.all_day">
                    <InputLabel
                        :value="t('calendar.start-time')"
                        class="mt-3"
                    />
                    <TextInput type="time" v-model="form.start_time" />
                </div>

                <div v-if="form.more_days">
                    <InputLabel :value="t('calendar.end-date')" class="mt-3" />
                    <TextInput type="date" v-model="form.end_date" />
                </div>

                <div v-if="!form.all_day">
                    <InputLabel :value="t('calendar.end-time')" class="mt-3" />
                    <TextInput type="time" v-model="form.end_time" />
                </div>

                <InputLabel :value="t('calendar.url')" class="mt-3" />
                <TextInput type="text" v-model="form.url" />

                <InputLabel :value="t('calendar.description')" class="mt-3" />
                <TextInput type="text" v-model="form.description" />
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
                    {{ t("calendar.add-event") }}
                </button>
            </div>
        </form>
    </InputModal>
</template>

<script setup>
import { ref, computed, watch } from "vue";
import { useI18n } from "vue-i18n";
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import allLocales from "@fullcalendar/core/locales-all";
import googleCalendarPlugin from "@fullcalendar/google-calendar";
import InputModal from "./InputModal.vue";
import TextInput from "./TextInput.vue";
import InputLabel from "./InputLabel.vue";
import Checkbox from "./Checkbox.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    checked: [Array, Boolean],
});

const { locale, t } = useI18n();

const calendarKey = ref(0);

watch(locale, () => {
    calendarKey.value++;
});

const calendarOptions = computed(() => ({
    plugins: [
        dayGridPlugin,
        timeGridPlugin,
        interactionPlugin,
        googleCalendarPlugin,
    ],
    googleCalendarApiKey: import.meta.env.VITE_GOOGLE_CALENDAR_API_KEY,
    initialView: "dayGridMonth",
    locales: allLocales,
    locale: locale.value,
    nowIndicator: true,
    height: 800,
    customButtons: {
        AddEventButton: {
            text: t("calendar.add-event"),
            click: openUpdateModal,
        },
    },
    headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "AddEventButton dayGridMonth,timeGridWeek,timeGridDay",
    },
    eventSources: [
        {
            googleCalendarId:
                "pt-pt.portuguese#holiday@group.v.calendar.google.com",
            color: "#378006",
        },
        {
            url: "/admin/calendar/json",
            method: "GET",
            failure: () => {
                alert("Erro ao carregar eventos!");
            },
        },
    ],
}));

const openUpdateModal = () => {
    isModalOpen.value = true;
};

const isModalOpen = ref(false);

const closeModal = () => {
    isModalOpen.value = false;
};

const form = useForm({
    title: "",
    all_day: false,
    more_days: false,
    important: false,
    start_date: null,
    start_time: null,
    end_date: null,
    end_time: null,
    url: "",
    description: "",
    color: "",
});

const addEvent = () => {
    if (form.important === true) {
        form.color = "#ff5733";
    } else {
        form.color = "#4287f5";
    }

    form.post(route("admin.calendar.store"), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
    });
};
</script>
