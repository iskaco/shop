<script setup>
import InfiniteScrollSection from "@/Components/Web/InfiniteScrollSection.vue";

const items = [
    {
        id: 1,
        image: "https://simpleicons.org/icons/samsung.svg",
    },
    {
        id: 2,
        image: "https://simpleicons.org/icons/acer.svg",
    },
    {
        id: 3,
        image: "https://simpleicons.org/icons/nokia.svg",
    },
    {
        id: 4,
        image: "https://simpleicons.org/icons/grab.svg",
    },
    {
        id: 5,
        image: "https://simpleicons.org/icons/ferrarinv.svg",
    },
    {
        id: 6,
        image: "https://simpleicons.org/icons/egnyte.svg",
    },
    {
        id: 7,
        image: "https://simpleicons.org/icons/puma.svg",
    },
];
</script>
<template>
    <section class="bg-boxdark">
        <div class="container px-4 mx-auto">
            <!-- <h2
                class="mb-16 lg:text-6xl md:text-5xl text-4xl font-bold text-center"
            >
                {{ $t("titles.web.brands.title") }}
            </h2> -->
            <InfiniteScrollSection :items="items"></InfiniteScrollSection>
        </div>
    </section>
</template>
