<script setup>
const props = defineProps(["align"]);
</script>
<template>
    <h2
        class="mb-16 lg:text-6xl md:text-5xl text-4xl font-bold"
        :class="`text-${props.align}`"
    >
        <slot />
    </h2>
</template>
