@ts-nocheck
<script setup>
import { ref } from "vue";
import ProductCard from "@/Components/Web/ProductCard.vue";

const props = defineProps(["category"]);
const containerRef = ref(null);
const containerRef2 = ref(null);

const scrollNext = (container) => {
    if (container) {
        container.scrollBy({
            left: container.clientWidth,
            behavior: "smooth",
        });
    }
};

const scrollPrev = (container) => {
    if (container) {
        container.scrollBy({
            left: -container.clientWidth,
            behavior: "smooth",
        });
    }
};

const getImage = function (image) {
    if (image) return route("shop.media", image);
};
</script>
<template>
    <section v-if="props.category.products.length" class="py-14 bg-gray-100">
        <div class="px-5 mx-auto">
            <h2
                class="mb-4 -mx-5 px-14 bg-gradient-to-b from-transparent from-45% to-cyan-300 to-45% lg:text-5xl md:text-5xl text-4xl font-black text-left rtl:text-right text-cyan-600"
            >
                {{ props.category.name }}
            </h2>
            <div
                class="relative"
                :class="{
                    'border-b-12 border-boxdark pb-5 mb-5':
                        props.category.products.length > 6,
                }"
            >
                <button
                    v-if="props.category.products.slice(0, 7).length > 5"
                    @click="scrollPrev(containerRef)"
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
                        v-for="product in props.category.products.slice(0, 7)"
                        :key="product.slug"
                        :product="product"
                        class="flex-none w-full md:w-1/5"
                        style="scroll-snap-align: start"
                    ></ProductCard>
                </div>
                <button
                    v-if="props.category.products.slice(0, 7).length > 5"
                    @click="scrollNext(containerRef)"
                    class="absolute right-0 top-1/2 -translate-y-5 z-10 p-1 bg-cyan-500 rounded-full shadow-md"
                >
                    <v-icon
                        name="la-arrow-circle-right-solid"
                        :scale="2"
                        class="fill-white"
                    ></v-icon>
                </button>
            </div>
            <div
                class="relative"
                :class="{
                    hidden: props.category.products.length < 7,
                }"
            >
                <button
                    v-if="props.category.products.slice(7, 13).length > 5"
                    @click="scrollPrev(containerRef2)"
                    class="absolute left-0 top-1/2 -translate-y-5 z-10 p-1 bg-cyan-500 rounded-full shadow-md"
                >
                    <v-icon
                        name="la-arrow-circle-left-solid"
                        :scale="2"
                        class="fill-white"
                    ></v-icon>
                </button>
                <div
                    ref="containerRef2"
                    class="flex overflow-x-auto gap-4"
                    style="scroll-snap-type: x mandatory; scrollbar-width: none"
                >
                    <ProductCard
                        v-for="product in props.category.products.slice(7, 13)"
                        :key="product.slug"
                        :product="product"
                        class="flex-none w-full md:w-1/5"
                        style="scroll-snap-align: start"
                    ></ProductCard>
                </div>
                <button
                    v-if="props.category.products.slice(7, 13).length > 5"
                    @click="scrollNext(containerRef2)"
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
