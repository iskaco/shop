<script setup>
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import AlertWarning from "@/Components/Alerts/AlertWarning.vue";
import AlertSuccess from "@/Components/Alerts/AlertSuccess.vue";
import AlertError from "@/Components/Alerts/AlertError.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

import { ref } from "vue";

const pageTitle = ref("Alerts");
</script>

<template>
    <AuthenticatedLayout>
        <!-- Breadcrumb Start -->
        <BreadcrumbDefault :pageTitle="pageTitle" />
        <!-- Breadcrumb End -->

        <div
            class="rounded-sm border border-stroke bg-white p-4 shadow-default dark:border-strokedark dark:bg-boxdark md:p-6 xl:p-9"
        >
            <div class="flex flex-col gap-7.5">
                <!-- ====== AlertWarning Start -->
                <AlertWarning />
                <!-- ====== AlertWarning End -->

                <!-- ====== AlertSuccess Start -->
                <AlertSuccess />
                <!-- ====== AlertSuccess End -->

                <!-- ====== AlertError Start -->
                <AlertError />
                <!-- ====== AlertError End -->
            </div>
        </div>
    </AuthenticatedLayout>
</template>
