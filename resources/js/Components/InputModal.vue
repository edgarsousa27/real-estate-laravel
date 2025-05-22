<template>
    <div
        v-if="isOpen"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 px-6"
        @click.self="close"
    >
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ title }}
                    </h3>
                    <button
                        @click="close"
                        class="text-gray-500 hover:text-gray-700"
                        aria-label="Close modal"
                    >
                        <font-awesome-icon icon="xmark" class="size-5" />
                    </button>
                </div>

                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Modal",
    props: {
        isOpen: {
            type: Boolean,
            required: true,
        },
        title: {
            type: String,
            default: "",
        },
    },
    methods: {
        close() {
            this.$emit("close");
        },
    },
};
</script>
