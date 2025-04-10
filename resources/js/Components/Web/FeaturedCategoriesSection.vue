<script setup>
import { router, Link } from "@inertiajs/vue3";

const props = defineProps(["categories"]);

const cats = [
    {
        title: "titles.web.categories.electronics.name",
        name: "electronics",
        image: "/images/electronics.jpg",
        color: "meta-1",
        banner: "/images/electronics-hero.jpg",
        icon: "md-laptop-outlined",
    },
    {
        title: "titles.web.categories.furniture.name",
        name: "furniture",
        image: "/images/furniture.jpg",
        color: "meta-2",
        banner: "/images/furniture-hero.jpg",
        icon: "md-bed-outlined",
    },
    {
        title: "titles.web.categories.shoes.name",
        name: "shoe",
        image: "/images/shoes.jpg",
        color: "meta-3",
        banner: "/images/shoes-hero.jpg",
        icon: "md-favoriteborder-outlined",
    },
    {
        title: "titles.web.categories.honey.name",
        name: "honey",
        image: "/images/honey.jpg",
        color: "meta-11",
        banner: "/images/honey-hero.jpg",
        icon: "md-foodbank-outlined",
    },
    {
        title: "titles.web.categories.bathroom.name",
        name: "bathroom",
        image: "/images/bathroom.jpg",
        color: "meta-5",
        banner: "/images/bathroom-hero.jpg",
        icon: "md-bathroom-outlined",
    },
    {
        title: "titles.web.categories.tshirts.name",
        name: "t-shirt",
        image: "/images/tshirt.jpg",
        color: "meta-6",
        banner: "/images/tshirt-hero.jpg",
        icon: "md-grade-outlined",
    },
    {
        title: "titles.web.categories.home.name",
        name: "home-tools",
        image: "/images/home.jpg",
        color: "meta-7",
        banner: "/images/home-hero.jpg",
        icon: "md-home-outlined",
    },
];

const getColor = function (name) {
    const category = cats.find((cat) => cat.name === name);
    return category ? `bg-${category.color}` : null;
};
const getBgImage = function (name) {
    const category = cats.find((cat) => cat.name === name);
    return category ? `background-image: url(${category.image})` : null;
};
const getIcon = function (name) {
    const category = cats.find((cat) => cat.name === name);
    return category ? category.icon : null;
};
const getIconColor = function (name) {
    const category = cats.find((cat) => cat.name === name);
    return category ? `fill-${category.color}` : null;
};
</script>
<!-- End of Selection -->
<template>
    <section
        class="h-auto md:h-screen py-32 bg-gradient-to-b from-black to-gray-900"
    >
        <div class="container flex flex-col px-4 mx-auto">
            <h2
                class="mb-16 lg:text-6xl md:text-5xl text-4xl font-bold text-center text-white"
            >
                {{ $t("titles.web.categories.title") }}
            </h2>
            <div
                class="flex flex-col md:flex-row items-stretch justify-center mx-auto md:min-w-md w-full md:h-80 md:overflow-hidden"
            >
                <!-- here must change onClick to Link component -->
                <div
                    v-for="cat in props.categories.data"
                    :key="cat.name"
                    class="group relative m-2 overflow-hidden transition-all duration-700 ease-in-out cursor-pointer h-32 md:h-auto md:min-h-14 md:min-w-20 md:hover:min-w-48 pane rounded-3xl"
                    @click="router.get(cat.links.self)"
                >
                    <div
                        class="absolute background bg-center bg-cover bg-no-repeat duration-700 ease-in-out inset-0 scale-105 transition-all z-10"
                        :class="getColor(cat.slug)"
                        :style="getBgImage(cat.slug)"
                    ></div>
                    <div
                        class="absolute inset-x-0 bottom-0 z-20 transition-all duration-700 ease-in-out transform translate-y-1/2 shadow opacity-0 bg-gradient-to-b from-transparent h-1/2 to-black"
                    ></div>
                    <div
                        class="origin-[20px_20px] md:-rotate-90 group-hover:rotate-0 absolute bottom-0 z-30 flex rtl:flex-row-reverse mb-2 ml-3 transition-all duration-700 ease-in-out label left-3 sm:mb-3 sm:ml-2"
                    >
                        <div
                            class="flex items-center justify-center w-10 h-10 mr-1 bg-gray-900 rounded-full icon"
                        >
                            <v-icon
                                :name="getIcon(cat.slug)"
                                scale="1.2"
                                :fill="getIconColor(cat.slug)"
                                :class="getIconColor(cat.slug)"
                            />
                        </div>
                        <div
                            class="flex flex-col justify-center leading-tight text-white whitespace-pre content"
                        >
                            <div
                                class="relative font-bold transition-all duration-700 ease-in-out transform [text-shadow:0_2px_4px_rgba(0,0,0,0.8)]"
                            >
                                {{ cat.name }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
