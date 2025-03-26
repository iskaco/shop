<script>
export default {
    props: {
        customClasses: String,
        label: {
            type: String,
            default: "تایید",
        },
        icon: {
            type: String,
            default: "md-check-outlined",
        },
    },
};
</script>

<template>
    <button
        class="flex border gap-1 justify-center items-center px-10 py-3 rounded"
        :class="customClasses"
        @click="(e) => e.preventDefault()"
    >
        <v-icon :name="icon"></v-icon>
        {{ label }}
    </button>
</template>
