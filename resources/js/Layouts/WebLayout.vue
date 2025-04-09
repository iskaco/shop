<script setup>
import ToastNotifications from "@/Components/ToastNotifications.vue";
import Header from "@/Components/Web/Header.vue";
import Footer from "@/Components/Web/Footer.vue";

const props = defineProps({
    menuBgColor: { type: String },
});
</script>

<template>
    <ToastNotifications />
    <div
        class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden font-vazirmatn"
    >
        <Header :menuBgColor="menuBgColor" />
        <main>
            <div class="mx-auto max-w-screen-2xl">
                <slot></slot>
            </div>
        </main>
        <Footer />
    </div>
</template>
