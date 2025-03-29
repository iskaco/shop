<script setup>
import ToastNotifications from "@/Components/ToastNotifications.vue";
import Header from "@/Components/Web/Header.vue";
</script>

<template>
    <ToastNotifications />
    <div
        class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden"
    >
        <Header />
        <main>
            <div class="mx-auto max-w-screen-2xl">
                <slot></slot>
            </div>
        </main>
    </div>
</template>
