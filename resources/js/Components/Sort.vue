<template>
    <div>
        <div>
            <div>
                <label class="text-sm">{{ t("filters.sort-by") }}</label>
                <select
                    class="border-none font-bold text-sm"
                    @change="applySorts"
                    v-model="selectedFilters.sort"
                >
                    <option value="-date">
                        {{ t("filters.date-up") }}
                    </option>
                    <option value="date">
                        {{ t("filters.date-down") }}
                    </option>
                    <option value="price">
                        {{ t("filters.price-down") }}
                    </option>
                    <option value="-price">
                        {{ t("filters.price-up") }}
                    </option>
                    <option value="-surface">
                        {{ t("filters.surface-up") }}
                    </option>
                    <option value="surface">
                        {{ t("filters.surface-down") }}
                    </option>
                </select>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useI18n } from "vue-i18n";
import { ref } from "vue";
const { t } = useI18n();
import { router } from "@inertiajs/vue3";

const props = defineProps({
    sort: String,
});

const emit = defineEmits(["update:sort"]);

function updateSort(value) {
    emit("update:sort", value);
}

const selectedFilters = ref({
    sort: props.sort,
});

const applySorts = () => {
    const currentUrl = new URL(window.location.href);
    const params = new URLSearchParams(currentUrl.search);

    params.set("sort", selectedFilters.value.sort);

    const query = {};
    params.forEach((value, key) => {
        query[key] = value;
    });

    router.get(window.location.pathname, query, {
        preserveScroll: true,
        preserveState: true,
    });
};
</script>
