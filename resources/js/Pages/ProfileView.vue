<script setup>
import { ref } from "vue";
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import ProfileCard from "@/Components/ProfileCard.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const pageTitle = ref("نمایه");
</script>

<template>
    <AuthenticatedLayout>
        <div class="mx-auto max-w-242.5">
            <!-- Breadcrumb Start -->
            <BreadcrumbDefault :pageTitle="pageTitle" />
            <!-- Breadcrumb End -->
            <ProfileCard />
        </div>
    </AuthenticatedLayout>
</template>
