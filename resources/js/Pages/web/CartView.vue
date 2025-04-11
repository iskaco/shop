<script setup>
import { Head } from "@inertiajs/vue3";
import WebLayout from "@/Layouts/WebLayout.vue";
import CartSection from "@/Components/Web/CartSection.vue";
</script>

<template>
    <Head :title="$t('titles.titles.web.description')" />
    <WebLayout menuBg="bg-[url(/images/menubg.jpg)] bg-center">
        <CartSection class="mt-28"></CartSection>
    </WebLayout>
</template>
