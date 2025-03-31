<script setup>
const props = defineProps(["formTitle"]);
</script>

<template>
    <h2 class="text-title-md2 px-2 mb-4.5 text-black dark:text-white">
        {{ props.formTitle }}
    </h2>
</template>
