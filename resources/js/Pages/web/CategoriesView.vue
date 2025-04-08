<script setup>
import HeroSection from "@/Components/Web/HeroSection.vue";
import { Head } from "@inertiajs/vue3";
import WebLayout from "@/Layouts/WebLayout.vue";
import CategoriesSection from "@/Components/Web/CategoriesSection.vue";

const props = defineProps(["categories"]);
</script>

<template>
    <Head :title="$t('titles.titles.web.description')" />
    <WebLayout>
        <HeroSection
            :title="$t('titles.web.hero.title')"
            :subtitle="$t('titles.web.hero.subtitle')"
            banner="/images/main-hero.jpg"
        />
        <CategoriesSection :categories="props.categories"></CategoriesSection>
    </WebLayout>
</template>
