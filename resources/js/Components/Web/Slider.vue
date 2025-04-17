<script setup>
import { ref } from "vue";

const slides = [
    {
        title: "Welcome to MeemHome",
        description: "Discover Amazing Products at Great Prices",
        image: "/images/main-hero.jpg",
    },
    {
        title: "Electronics",
        description:
            "Explore our latest collection of cutting-edge electronics, from smartphones to smart home devices",
        image: "/images/electronics-hero.jpg",
    },
    {
        title: "Furniture",
        description:
            "Transform your living spaces with our premium collection of stylish and comfortable furniture",
        image: "/images/furniture-hero.jpg",
    },
    {
        title: "Shoes",
        description:
            "Step into style with our premium collection of footwear for every occasion",
        image: "/images/shoes-hero.jpg",
    },
    {
        title: "Bathroom",
        description:
            "Upgrade your bathroom with our elegant and functional fixtures and accessories",
        image: "/images/bathroom-hero.jpg",
    },
    {
        title: "Honey",
        description:
            "Experience the pure taste of nature with our premium selection of natural honey",
        image: "/images/honey-hero.jpg",
    },
    {
        title: "Tshirt",
        description:
            "Express yourself with our comfortable and stylish collection of t-shirts",
        image: "/images/tshirt-hero.jpg",
    },
    {
        title: "Home Tools",
        description:
            "Make your home projects easier with our high-quality tools and equipment",
        image: "/images/home-hero.jpg",
    },
];
const currentIndex = ref(0);

function nextSlide() {
    currentIndex.value = (currentIndex.value + 1) % slides.length;
}

function prevSlide() {
    currentIndex.value =
        (currentIndex.value - 1 + slides.length) % slides.length;
}

function goToSlide(index) {
    currentIndex.value = index;
}
</script>

<template>
    <div class="relative w-full overflow-hidden">
        <div
            class="flex transition-transform duration-300"
            :style="{ transform: `translateX(-${currentIndex * 100}%)` }"
        >
            <div
                v-for="(slide, index) in slides"
                :key="index"
                class="w-full flex-shrink-0"
            >
                <div
                    class="relative h-80 md:h-150 flex items-center justify-center bg-gray-200"
                >
                    <div class="absolute text-center px-20 space-y-5 z-20">
                        <p class="text-5xl md:text-7xl font-black text-white">
                            {{ slide.title }}
                        </p>
                        <p class="text-xl md:text-2xl font-medium text-white">
                            {{ slide.description }}
                        </p>
                    </div>
                    <div
                        class="absolute inset-0 z-10 bg-black/40"
                        style="
                            background-image: radial-gradient(
                                rgba(255, 255, 255, 0.1) 1px,
                                transparent 1px
                            );
                            background-size: 4px 4px;
                        "
                    ></div>
                    <img :src="slide.image" />
                </div>
            </div>
        </div>
        <button
            @click="prevSlide"
            class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-white p-2"
        >
            Prev
        </button>
        <button
            @click="nextSlide"
            class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-white p-2"
        >
            Next
        </button>
        <div
            class="absolute bottom-0 left-1/2 transform -translate-x-1/2 flex space-x-2"
        >
            <span
                v-for="(slide, index) in slides"
                :key="index"
                @click="goToSlide(index)"
                :class="{
                    'bg-cyan-500': currentIndex === index,
                    'bg-gray-300': currentIndex !== index,
                }"
                class="w-3 h-3 rounded-full cursor-pointer mb-10"
            ></span>
        </div>
    </div>
</template>
