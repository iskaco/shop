<script setup>
import { ref } from "vue";
import ProductCard from "@/Components/Web/ProductCard.vue";

const props = defineProps(["products"]);
const containerRef = ref(null);

const scrollNext = () => {
    if (containerRef.value) {
        containerRef.value.scrollBy({
            left: containerRef.value.clientWidth,
            behavior: "smooth",
        });
    }
};

const scrollPrev = () => {
    if (containerRef.value) {
        containerRef.value.scrollBy({
            left: -containerRef.value.clientWidth,
            behavior: "smooth",
        });
    }
};

const getImage = function (image) {
    if (image) return route("shop.media", image);
};
</script>
<template>
    <section class="py-20 bg-gray-100">
        <div class="px-5 mx-auto">
            <h2
                class="mb-4 lg:text-5xl md:text-5xl text-4xl font-black text-left rtl:text-right bg-clip-text bg-gradient-to-br from-cyan-500 to-indigo-500 text-transparent"
            >
                {{ $t("titles.web.products.electronics.title") }}
            </h2>
            <div class="relative">
                <button
                    @click="scrollPrev"
                    class="absolute left-0 top-1/2 -translate-y-5 z-10 p-1 bg-cyan-500 rounded-full shadow-md"
                >
                    <v-icon
                        name="la-arrow-circle-left-solid"
                        :scale="2"
                        class="fill-white"
                    ></v-icon>
                </button>
                <div
                    ref="containerRef"
                    class="flex overflow-x-auto gap-4"
                    style="scroll-snap-type: x mandatory; scrollbar-width: none"
                >
                    <ProductCard
                        v-for="product in props.products.data"
                        :key="product.slug"
                        :product="product"
                        class="flex-none w-full md:w-1/5"
                        style="scroll-snap-align: start"
                    ></ProductCard>
                </div>
                <button
                    @click="scrollNext"
                    class="absolute right-0 top-1/2 -translate-y-5 z-10 p-1 bg-cyan-500 rounded-full shadow-md"
                >
                    <v-icon
                        name="la-arrow-circle-right-solid"
                        :scale="2"
                        class="fill-white"
                    ></v-icon>
                </button>
            </div>
        </div>
    </section>
</template>
