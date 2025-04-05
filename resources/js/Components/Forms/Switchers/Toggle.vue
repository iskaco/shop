<script>
export default {
    props: {
        label: String,
        modelValue: Boolean,
        isDisabled: {
            type: Boolean,
            default: false,
        },
    },
    computed: {
        value: {
            get() {
                return this.modelValue ? true : false;
            },
            set(value) {
                this.$emit("update:modelValue", value);
            },
        },
    },
};
</script>

<template>
    <div>
        <label v-if="label" class="mb-2.5 block text-black dark:text-white">
            {{ label }}
        </label>
        <label class="flex cursor-pointer select-none items-center">
            <div class="relative">
                <input
                    type="checkbox"
                    v-model="value"
                    class="sr-only"
                    :disabled="isDisabled"
                />
                <div
                    :class="
                        value ? '!bg-success' : 'bg-meta-9 dark:bg-[#5A616B]'
                    "
                    class="block h-8 w-14 rounded-full transition-colors"
                ></div>
                <div
                    :class="value ? '!right-7 !translate-x-full' : 'left-1'"
                    class="absolute flex items-center justify-center top-1 h-6 w-6 rounded-full bg-white transition"
                >
                    <span v-if="value" class="block text-success">
                        <v-icon name="md-done-outlined" scale=".7"></v-icon>
                    </span>
                    <span v-else class="hidden">
                        <v-icon name="md-close-outlined" scale=".7"></v-icon>
                    </span>
                </div>
            </div>
        </label>
    </div>
</template>
