<template>
    <div class="locale-changer">
        <select
            v-model="$i18n.locale"
            class="p-2 rounded-md border border-gray-300 bg-white text-gray-700 shadow-sm hover:bg-gray-50 cursor-pointer appearance-none text-2xl"
        >
            <option
                v-for="(flag, locale) in localeFlags"
                :key="locale"
                :value="locale"
            >
                {{ flag }}
            </option>
        </select>
    </div>
</template>

<script setup>
const localeFlags = {
    pt: "🇵🇹",
    en: "🇬🇧",
};
</script>
