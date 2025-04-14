<script>
import { router } from "@inertiajs/vue3";
export default {
    props: {
        customClasses: String,
        label: {
            type: String,
            default: "Back",
        },
        icon: {
            type: String,
            default: "md-arrowforward-outlined",
        },
    },
    methods: {
        back(e) {
            e.preventDefault();

            if (window.history.length > 1) {
                window.history.back();
            } else {
            }
        },
    },
};
</script>

<template>
    <button
        class="flex border gap-1 justify-center items-center px-7 py-3 rounded"
        :class="customClasses"
        @click="back"
    >
        <v-icon :name="icon"></v-icon>
        {{ label }}
    </button>
</template>
