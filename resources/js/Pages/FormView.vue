<script setup>
import { ref } from "vue";
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import CalendarCard from "@/Components/CalendarCard.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Form from "@/Components/Form.vue";

const props = defineProps({
    form: Object,
    data: Object,
});
</script>

<template>
    <AuthenticatedLayout>
        <Form :form="form" :data="data"></Form>
    </AuthenticatedLayout>
</template>
