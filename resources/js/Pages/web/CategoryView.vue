<script setup>
import HeroSection from "@/Components/Web/HeroSection.vue";
import { Head } from "@inertiajs/vue3";
import WebLayout from "@/Layouts/WebLayout.vue";

const props = defineProps({
    title: String,
    subtitle: String,
    banner: String,
});
</script>

<template>
    <Head :title="$t('titles.titles.web.description')" />
    <WebLayout>
        <HeroSection :title="title" :subtitle="subtitle" :banner="banner" />
    </WebLayout>
</template>
