<script setup>
import { ref } from "vue";

const slides = [
    {
        title: "titles.web.slider.slide1.title",
        description: "titles.web.slider.slide1.description",
        image: "/images/main-hero.jpg",
    },
    {
        title: "titles.web.slider.slide2.title",
        description: "titles.web.slider.slide2.description",
        image: "/images/electronics-hero.jpg",
    },
    {
        title: "titles.web.slider.slide3.title",
        description: "titles.web.slider.slide3.description",
        image: "/images/furniture-hero.jpg",
    },
    {
        title: "titles.web.slider.slide4.title",
        description: "titles.web.slider.slide4.description",
        image: "/images/shoes-hero.jpg",
    },
    {
        title: "titles.web.slider.slide5.title",
        description: "titles.web.slider.slide5.description",
        image: "/images/bathroom-hero.jpg",
    },
    {
        title: "titles.web.slider.slide6.title",
        description: "titles.web.slider.slide6.description",
        image: "/images/honey-hero.jpg",
    },
    {
        title: "titles.web.slider.slide7.title",
        description: "titles.web.slider.slide7.description",
        image: "/images/tshirt-hero.jpg",
    },
    {
        title: "titles.web.slider.slide8.title",
        description: "titles.web.slider.slide8.description",
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
            :style="{
                transform: `translateX(${
                    this.$page.props.locale == 'en' ? '-' : ''
                }${currentIndex * 100}%)`,
            }"
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
                            {{ $t(slide.title) }}
                        </p>
                        <p class="text-xl md:text-2xl font-medium text-white">
                            {{ $t(slide.description) }}
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
