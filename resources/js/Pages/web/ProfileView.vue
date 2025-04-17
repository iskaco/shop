<script setup>
import { ref } from "vue";
import { Head, usePage } from "@inertiajs/vue3";
import WebLayout from "@/Layouts/WebLayout.vue";
import ProfileHeader from "@/Components/Web/ProfileHeader.vue";
import ProfileCard from "@/Components/Web/ProfileCard.vue";
import ProfileOrdersSection from "@/Components/Web/ProfileOrdersSection.vue";

const props = defineProps(["customer"]);

const tabs = {
    profile: ProfileCard,
    orders: ProfileOrdersSection,
};

const activeTab = ref("profile");

const setActiveTab = (tabKey) => {
    activeTab.value = tabKey;
};
</script>

<template>
    <Head :title="$t('titles.titles.web.description')" />
    <WebLayout menuBg="bg-[url(/images/menubg.jpg)] bg-center">
        <div class="mx-auto mt-28 pb-28 bg-white">
            <ProfileHeader
                :customer="props.customer.data"
                :activeTab="activeTab"
                @change-tab="setActiveTab"
            />
            <component
                :is="tabs[activeTab]"
                :customer="props.customer.data"
                :orders="props.customer.data?.orders"
            />
        </div>
    </WebLayout>
</template>
