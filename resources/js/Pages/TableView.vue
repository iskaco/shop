<script setup>
import { ref } from "vue";
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import CalendarCard from "@/Components/CalendarCard.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Table from "@/Components/Table.vue";

const pageTitle = ref("Calender");

const props = defineProps({
    table: Object,
    rows: Object,
});
</script>

<template>
    <AuthenticatedLayout>
        <Table :table="props.table" :rows="props.rows"></Table>
    </AuthenticatedLayout>
</template>
