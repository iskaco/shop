<script>
export default {
    props: {
        label: String,
        modelValue: Boolean | Number,
        isDisabled: {
            type: Boolean,
            default: false,
        },
    },
    data() {
        return {
            switcherToggle: false,
        };
    },
    mounted() {
        this.switcherToggle = this.modelValue ? true : false;
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
        <label class="mb-2.5 block text-black dark:text-white">
            {{ label }}
        </label>
        <label
            for="toggle1"
            class="flex cursor-pointer select-none items-center"
        >
            <div class="relative">
                <input
                    type="checkbox"
                    id="toggle1"
                    v-model="value"
                    class="sr-only"
                    :disabled="isDisabled"
                    @change="switcherToggle = !switcherToggle"
                />
                <div
                    :class="switcherToggle && '!bg-success'"
                    class="block h-8 w-14 rounded-full bg-meta-9 dark:bg-[#5A616B]"
                ></div>
                <div
                    :class="switcherToggle && '!right-7 !translate-x-full'"
                    class="absolute flex items-center justify-center left-1 top-1 h-6 w-6 rounded-full bg-white transition"
                >
                    <span
                        :class="switcherToggle && '!block'"
                        class="hidden text-success"
                    >
                        <v-icon name="md-done-outlined" scale=".7"></v-icon>
                    </span>
                    <span :class="switcherToggle && 'hidden'">
                        <v-icon name="md-close-outlined" scale=".7"></v-icon>
                    </span>
                </div>
            </div>
        </label>
    </div>
</template>
