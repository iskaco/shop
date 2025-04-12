<script setup>
import { ref } from "vue";
import { Head } from "@inertiajs/vue3";
import WebLayout from "@/Layouts/WebLayout.vue";
import ProfileCard from "@/Components/Web/ProfileCard.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps(["customer"]);
</script>

<template>
    <Head :title="$t('titles.titles.web.description')" />
    <WebLayout menuBg="bg-[url(/images/menubg.jpg)] bg-center">
        <div class="mx-auto mt-28">
            <ProfileCard :customer="props.customer.data" />
        </div>
    </WebLayout>
</template>
