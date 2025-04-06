<script setup>
import ProductCard from "./ProductCard.vue";

const props = defineProps(["products"]);
</script>
<template>
    <section class="flex flex-col items-center my-20 px-20">
        <h2
            class="mb-16 lg:text-6xl md:text-5xl text-4xl font-bold text-center ltr:font-alumni rtl:font-arabic"
        >
            {{ $t("titles.web.products.name") }}
        </h2>
        <div class="w-full grid md:grid-cols-4 gap-5">
            <ProductCard
                v-for="product in props.products.data"
                :key="product.slug"
                :product="product"
            ></ProductCard>
        </div>
    </section>
</template>
