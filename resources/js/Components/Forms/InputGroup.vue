<script>
import { defineComponent } from "vue";

export default defineComponent({
    props: {
        label: String,
        type: String,
        placeholder: String,
        customClasses: String,
        modelValue: String,
        required: {
            type: Boolean,
            default: false,
        },
        isDisabled: {
            type: Boolean,
            default: false,
        },
    },
    data() {
        return {
            min: "0",
            step: "1",
        };
    },
    computed: {
        value: {
            get() {
                return this.modelValue;
            },
            set(value) {
                this.$emit("update:modelValue", value);
            },
        },
        calcMin() {
            switch (this.type) {
                case "number":
                    this.min = "0";
                    break;
                case "currency":
                    this.min = "0.00";
                    this.step = "0.01";
                    break;
            }
        },
    },
});
</script>

<template>
    <div :class="customClasses">
        <label class="mb-2.5 block text-black dark:text-white">
            {{ label }}
            <span v-if="required" class="text-meta-1">*</span>
        </label>
        <input
            :type="type"
            :placeholder="placeholder"
            v-model="value"
            :disabled="isDisabled"
            :min="min"
            :step="step"
            class="w-full rounded border-[1.5px] text-black border-stroke bg-transparent py-3 px-5 font-normal outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:text-white dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
            @focus="this.$emit('focus', event)"
        />
    </div>
</template>
