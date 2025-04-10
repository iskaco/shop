<script setup>
import { Head } from "@inertiajs/vue3";
import WebLayout from "@/Layouts/WebLayout.vue";
import MapSection from "@/Components/Web/MapSection.vue";
import ContactInfo from "@/Components/Web/ContactInfo.vue";
import ContactForm from "@/Components/Web/ContactForm.vue";
import SectionHead from "@/Components/Web/SectionHead.vue";
</script>

<template>
    <Head :title="$t('titles.titles.web.description')" />
    <WebLayout menuBg="bg-[url(/images/menubg.jpg)] bg-center">
        <div class="flex flex-col mt-40">
            <SectionHead align="center">{{
                $t("titles.web.navigation.contact")
            }}</SectionHead>
            <div class="">
                <MapSection></MapSection>
            </div>
            <div
                class="flex flex-col-reverse md:flex-row md:divide-x md:divide-x-reverse divide-y divide-y-reverse my-10 px-10 md:px-20"
            >
                <ContactForm class="flex-1"></ContactForm>
                <ContactInfo class="flex-1"></ContactInfo>
            </div>
        </div>
    </WebLayout>
</template>
