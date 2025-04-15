<script setup>
import { Head } from "@inertiajs/vue3";
import WebLayout from "@/Layouts/WebLayout.vue";
import CheckoutInfoSection from "@/Components/Web/CheckoutInfoSection.vue";

const props = defineProps(["address"]);
</script>

<template>
    <Head :title="$t('titles.titles.web.description')" />
    <WebLayout menuBg="bg-[url(/images/menubg.jpg)] bg-center">
        <CheckoutInfoSection
            :address="props.address"
            class="mt-28"
        ></CheckoutInfoSection>
    </WebLayout>
</template>
