<script setup>
import { ref } from "vue";
import { Head, usePage } from "@inertiajs/vue3";
import WebLayout from "@/Layouts/WebLayout.vue";
import ProfileCard from "@/Components/Web/ProfileCard.vue";
import ProfileOrdersSection from "@/Components/Web/ProfileOrdersSection.vue";

const props = defineProps(["customer"]);
</script>

<template>
    <Head :title="$t('titles.titles.web.description')" />
    <WebLayout menuBg="bg-[url(/images/menubg.jpg)] bg-center">
        <div class="mx-auto mt-28 pb-28 bg-white">
            <ProfileCard :customer="props.customer.data" />
            <ProfileOrdersSection :orders="props.customer.data.orders" />
        </div>
    </WebLayout>
</template>
