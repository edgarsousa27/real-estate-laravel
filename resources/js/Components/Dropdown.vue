<template>
    <div class="relative" @mouseleave="closeDropdown">
        <div @mouseenter="openDropdown" @click="open = !open">
            <slot name="trigger" />
        </div>

        <!-- Full Screen Dropdown Overlay -->
        <div v-show="open" class="fixed inset-0 z-40" @click="forceClose"></div>

        <Transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="opacity-0 scale-95"
            enter-to-class="opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-95"
        >
            <div
                v-show="open"
                class="absolute z-50 mt-2 rounded-md shadow-lg bg-white"
                :class="[widthClass, alignmentClasses]"
                @mouseenter="keepOpen"
                @mouseleave="closeDropdown"
                @click="forceClose"
            >
                <div
                    class="rounded-md ring-1 ring-black ring-opacity-5"
                    :class="contentClasses"
                >
                    <slot name="content" />
                </div>
            </div>
        </Transition>
    </div>
</template>

<script setup>
import { computed, onMounted, onUnmounted, ref } from "vue";

const props = defineProps({
    align: {
        type: String,
        default: "left",
    },
    width: {
        type: String,
        default: "48",
    },
    contentClasses: {
        type: String,
        default: "py-1",
    },
});

const closeOnEscape = (e) => {
    if (open.value && e.key === "Escape") {
        open.value = false;
    }
};

onMounted(() => document.addEventListener("keydown", closeOnEscape));
onUnmounted(() => document.removeEventListener("keydown", closeOnEscape));

const widthClass = computed(() => {
    return {
        48: "w-96",
    }[props.width.toString()];
});

const alignmentClasses = computed(() => {
    if (props.align === "left") {
        return "ltr:origin-top-left rtl:origin-top-right start-0";
    } else if (props.align === "right") {
        return "ltr:origin-top-right rtl:origin-top-left end-0";
    } else {
        return "origin-top";
    }
});

const open = ref(false);

// Hover state management
let timeout;
const openDropdown = () => {
    clearTimeout(timeout);
    open.value = true;
};

const closeDropdown = () => {
    timeout = setTimeout(() => {
        open.value = false;
    }, 50);
};

const keepOpen = () => {
    clearTimeout(timeout);
};

const forceClose = () => {
    clearTimeout(timeout);
    open.value = false;
};
</script>
