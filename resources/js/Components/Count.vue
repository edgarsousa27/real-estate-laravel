<template>
    <div>
        <div>
            <div class="text-lg font-bold" v-if="count == 1">
                {{ count }} {{ t("filters.results-1") }}
            </div>
            <div v-else class="text-lg font-bold">
                {{ count }} {{ t("filters.results") }}
            </div>
        </div>
    </div>
</template>

<script setup>
import { useI18n } from "vue-i18n";
const { t } = useI18n();

const props = defineProps({
    count: Number,
});
</script>
