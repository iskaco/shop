<script setup>
import HeroSection from "@/Components/Web/HeroSection.vue";
import ProductsSection from "@/Components/Web/ProductsSection.vue";
import { Head } from "@inertiajs/vue3";
import WebLayout from "@/Layouts/WebLayout.vue";

const props = defineProps(["category", "products"]);

const getImage = function (image) {
    if (image) return route("shop.media", image);
};
</script>

<template>
    <Head :title="$t('titles.titles.web.description')" />
    <WebLayout>
        <HeroSection
            :title="props.category.data.name"
            :subtitle="props.category.data.description"
            :banner="getImage(props.category.data.banner)"
        />
        <div class="container">
            <ProductsSection :products="props.products"></ProductsSection>
        </div>
    </WebLayout>
</template>
