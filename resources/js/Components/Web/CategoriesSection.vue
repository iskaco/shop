<script setup>
import { router, Link } from "@inertiajs/vue3";
import CategoryCard from "@/Components/Web/CategoryCard.vue";

const props = defineProps(["categories"]);
</script>
<!-- End of Selection -->
<template>
    <section class="flex flex-col items-center my-20 md:px-20 px-10">
        <h2
            class="mb-16 lg:text-6xl md:text-5xl text-4xl font-bold text-center"
        >
            {{ $t("titles.web.navigation.categories") }}
        </h2>
        <div class="w-full grid md:grid-cols-4 gap-5">
            <CategoryCard
                v-for="category in props.categories.data"
                :key="category.slug"
                :category="category"
            ></CategoryCard>
        </div>
    </section>
</template>
