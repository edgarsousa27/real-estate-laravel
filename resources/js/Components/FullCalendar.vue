<template>
    <FullCalendar :options="calendarOptions" :key="calendarKey" />

    <!--Add Event-->
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

    <!--Update Event-->
    <InputModal
        :isOpen="isUpdateModalOpen"
        :title="t('calendar.event')"
        @close="closeUpdateModal"
    >
        <input type="hidden" v-model="form.id" />

        <div class="mb-3">
            <h2 class="text-lg font-semibold text-gray-800">
                {{ t("calendar.title") }}
            </h2>
            <p class="text-xl font-medium text-blue-700">
                {{ form.title }}
            </p>
        </div>

        <div class="mb-3">
            <h2 class="text-lg font-semibold text-gray-800">
                {{ t("calendar.date") }}
            </h2>
            <p class="text-xl font-medium text-blue-700">
                {{ form.start_date }}
            </p>
        </div>

        <div class="mb-3">
            <h2 class="text-lg font-semibold text-gray-800">
                {{ t("calendar.description") }}
            </h2>
            <p class="text-md font-medium text-gray-700">
                {{ form.description }}
            </p>
        </div>

        <div class="space-y-4">
            <div>
                <button
                    @click="openUpdateEventModal"
                    class="w-full px-4 py-2 bg-green-600 rounded-md text-sm font-medium text-white hover:bg-green-700 transition-colors"
                >
                    {{ t("calendar.update-event") }}
                </button>
            </div>

            <div>
                <button
                    @click="openDeleteModal"
                    class="w-full px-4 py-2 bg-red-600 rounded-md text-sm font-medium text-white hover:bg-red-700 transition-colors"
                >
                    {{ t("calendar.delete-event") }}
                </button>
            </div>
        </div>

        <InputModal
            :isOpen="isModalDeleteOpen"
            :title="t('calendar.delete.title')"
            @close="closeModal"
        >
            <form @submit.prevent="deleteEvent" class="space-y-4">
                <input type="hidden" v-model="form.id" />

                <div>
                    <p class="text-sm">
                        {{ t("calendar.delete.confirm") }}
                    </p>
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <button
                        type="button"
                        @click="closeDeleteModal"
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50"
                    >
                        {{ t("update-form.cancel") }}
                    </button>
                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-600 rounded-md text-sm font-medium text-white hover:bg-blue-700"
                    >
                        {{ t("update-form.delete") }}
                    </button>
                </div>
            </form>
        </InputModal>

        <InputModal
            :isOpen="isModalUpdateEventOpen"
            :title="t('calendar.update.title')"
            @close="closeUpdateEventModal"
        >
            <form @submit.prevent="updateEvent" class="space-y-4">
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

                    <div
                        class="flex items-center gap-3 mt-3"
                        v-if="!form.all_day"
                    >
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
                        <InputLabel
                            :value="t('calendar.end-date')"
                            class="mt-3"
                        />
                        <TextInput type="date" v-model="form.end_date" />
                    </div>

                    <div v-if="!form.all_day">
                        <InputLabel
                            :value="t('calendar.end-time')"
                            class="mt-3"
                        />
                        <TextInput type="time" v-model="form.end_time" />
                    </div>

                    <InputLabel :value="t('calendar.url')" class="mt-3" />
                    <TextInput type="text" v-model="form.url" />

                    <InputLabel
                        :value="t('calendar.description')"
                        class="mt-3"
                    />
                    <TextInput type="text" v-model="form.description" />
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <button
                        type="button"
                        @click="closeUpdateEventModal"
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50"
                    >
                        {{ t("update-form.cancel") }}
                    </button>
                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-600 rounded-md text-sm font-medium text-white hover:bg-blue-700"
                    >
                        {{ t("calendar.update.save") }}
                    </button>
                </div>
            </form>
        </InputModal>
    </InputModal>

    <!--Holidays-->
    <InputModal
        :isOpen="isHolidayModalOpen"
        :title="t('calendar.holidays.title')"
        @close="closeHolidayModal"
    >
        <input type="hidden" />

        <div class="mb-3">
            <h2 class="text-lg font-semibold text-gray-800">
                {{ t("calendar.holidays.name") }}
            </h2>
            <p class="text-xl font-medium text-blue-700">
                {{ currentHolidayName }}
            </p>
        </div>

        <div class="mb-4">
            <h2 class="text-lg font-semibold text-gray-800">
                {{ t("calendar.holidays.date") }}
            </h2>
            <p class="text-lg text-gray-600">{{ currentHolidayDate }}</p>
        </div>

        <div class="mt-4">
            <a
                :href="`https://www.google.com/search?q=${currentHolidayName}`"
                target="_blank"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors"
            >
                <font-awesome-icon icon="circle-info" class="h-5 w-5 mr-2" />
                {{ t("calendar.holidays.info") }}
            </a>
        </div>
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
            click: openAddEventModal,
        },
    },
    headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "AddEventButton dayGridMonth,timeGridWeek,timeGridDay",
    },
    eventSources: [
        {
            id: "holidays",
            googleCalendarId:
                "pt-pt.portuguese#holiday@group.v.calendar.google.com",
            color: "#378006",
        },
        {
            url: "/admin/calendar/json",
            method: "GET",
        },
    ],
    eventClick: (info) => {
        info.jsEvent.preventDefault();

        const googleEvent = info.event.source.id === "holidays";

        if (googleEvent) {
            const HolidayName = info.event.title;
            const HolidayDate = info.event.start.toLocaleDateString("pt-PT");
            openHolidayModal(HolidayName, HolidayDate);
        } else {
            form.id = info.event.id;
            form.title = info.event.title;
            form.all_day = info.event.allDay;
            form.more_days = false;
            form.important = false;
            form.start_date =
                info.event.start.toLocaleDateString("pt-PT") || null;
            form.start_time =
                info.event.start?.toTimeString()?.substring(0, 5) || null;
            form.end_date =
                info.event.end?.toISOString().substring(0, 10) || null;
            form.end_time =
                info.event.end?.toTimeString()?.substring(0, 5) || null;
            form.url = info.event.url || "";
            form.description = info.event.extendedProps?.description || "";
            openUpdateModal();
        }
    },
}));

const openAddEventModal = () => {
    isModalOpen.value = true;
};

const isModalOpen = ref(false);
const isHolidayModalOpen = ref(false);
const currentHolidayName = ref("");
const currentHolidayDate = ref("");
const isUpdateModalOpen = ref(false);
const isModalDeleteOpen = ref(false);
const isModalUpdateEventOpen = ref(false);

const openHolidayModal = (HolidayName, HolidayDate) => {
    currentHolidayName.value = HolidayName;
    currentHolidayDate.value = HolidayDate;
    isHolidayModalOpen.value = true;
};

const openUpdateModal = () => {
    isUpdateModalOpen.value = true;
};

const openDeleteModal = () => {
    isModalDeleteOpen.value = true;
};

const openUpdateEventModal = () => {
    isModalUpdateEventOpen.value = true;
};

const closeUpdateEventModal = () => {
    isModalUpdateEventOpen.value = false;
};

const closeUpdateModal = () => {
    isUpdateModalOpen.value = false;
};

const closeHolidayModal = () => {
    isHolidayModalOpen.value = false;
};

const closeModal = () => {
    isModalOpen.value = false;
};

const closeDeleteModal = () => {
    isModalDeleteOpen.value = false;
};

const form = useForm({
    id: null,
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
    form.post(route("admin.calendar.store"));
};

const deleteEvent = () => {
    form.delete(route("admin.calendar.destroy", form.id));
};

const updateEvent = () => {
    form.patch(route("admin.calendar.update", form.id), {
        onSuccess: () => {
            closeUpdateEventModal();
            closeUpdateModal();
            calendarKey.value++;
        },
    });
};
</script>
