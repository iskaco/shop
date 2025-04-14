<script setup>
import ProductCard from "@/Components/Web/ProductCard.vue";

const props = defineProps(["products"]);

const getImage = function (image) {
    if (image) return route("shop.media", image);
};
</script>
<template>
    <section class="py-20 bg-gray-100">
        <div class="container px-4 mx-auto">
            <h2
                class="mb-4 ml-10 lg:text-5xl md:text-5xl text-4xl font-bold text-left rtl:text-right"
            >
                {{ $t("titles.web.products.electronics.title") }}
            </h2>
            <div
                class="flex flex-col-reverse md:flex-row gap-4 p-3 bg-gray-200 rounded-lg"
            >
                <ProductCard
                    v-for="product in props.products.data"
                    :key="product.slug"
                    :product="product"
                ></ProductCard>
                <!-- <div
                    class="overflow-hidden bg-white rounded-lg shadow-lg lg:w-40 w-full"
                >
                    <img
                        src="/images/electronics-adv.jpg"
                        alt="Product 1"
                        class="object-cover h-full"
                    />
                </div> -->
            </div>
        </div>
    </section>
</template>
