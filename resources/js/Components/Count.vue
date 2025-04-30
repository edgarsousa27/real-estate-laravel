<template>
    <div>
        <div>
            <div>{{ count }} {{ t("filters.results") }}</div>
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
