<script setup>
import HeroSection from "@/Components/Web/HeroSection.vue";
import { Head } from "@inertiajs/vue3";
import WebLayout from "@/Layouts/WebLayout.vue";
import CategoriesSection from "@/Components/Web/CategoriesSection.vue";

const props = defineProps(["categories"]);
</script>

<template>
    <Head :title="$t('titles.titles.web.description')" />
    <WebLayout menuBg="bg-[url(/images/menubg.jpg)] bg-center">
        <CategoriesSection
            :categories="props.categories"
            class="mt-40"
        ></CategoriesSection>
    </WebLayout>
</template>
