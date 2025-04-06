<script setup>
import HeroSection from "@/Components/Web/HeroSection.vue";
import ProductsSection from "@/Components/Web/ProductsSection.vue";
import { Head } from "@inertiajs/vue3";
import WebLayout from "@/Layouts/WebLayout.vue";

const props = defineProps(["category", "products"]);

const cats = [
    {
        name: "electronics",
        banner: "/images/electronics-hero.jpg",
    },
    {
        name: "furniture",
        banner: "/images/furniture-hero.jpg",
    },
    {
        name: "shoe",
        banner: "/images/shoes-hero.jpg",
    },
    {
        name: "honey",
        banner: "/images/honey-hero.jpg",
    },
    {
        name: "bathroom",
        banner: "/images/bathroom-hero.jpg",
    },
    {
        name: "t-shirt",
        banner: "/images/tshirt-hero.jpg",
    },
    {
        name: "home-tools",
        banner: "/images/home-hero.jpg",
    },
];

const getBanner = function (name) {
    const category = cats.find((cat) => cat.name === name);
    return category ? category.banner : null;
};
</script>

<template>
    <Head :title="$t('titles.titles.web.description')" />
    <WebLayout>
        <HeroSection
            :title="props.category.data.name"
            :subtitle="props.category.data.description"
            :banner="getBanner(props.category.data.slug)"
        />
        <div class="container">
            <ProductsSection :products="props.products"></ProductsSection>
        </div>
    </WebLayout>
</template>
