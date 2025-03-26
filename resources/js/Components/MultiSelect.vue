<script>
import Multiselect from "vue-multiselect";
import "vue-multiselect/dist/vue-multiselect.min.css";

export default {
    components: {
        Multiselect,
    },
    props: {
        label: String,
        placeholder: String,
        customClasses: String,
        modelValue: String,
        required: {
            type: Boolean,
            default: false,
        },
        multiple: {
            type: Boolean,
            default: false,
        },
        options: Array,
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
    },
};
</script>
<template>
    <div :class="customClasses">
        <label class="mb-2.5 block text-black dark:text-white">
            {{ label }}
            <span v-if="required" class="text-meta-1">*</span>
        </label>
        <Multiselect
            :multiple="true"
            :options="options"
            label="name"
            :placeholder="placeholder"
            v-model="value"
        ></Multiselect>
    </div>
</template>
