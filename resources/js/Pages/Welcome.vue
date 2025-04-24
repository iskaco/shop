<script setup>
import { Head, Link } from "@inertiajs/vue3";
import WebLayout from "@/Layouts/WebLayout.vue";
import PriceTable from "@/Components/Web/PriceTable.vue";
import HeroSection from "@/Components/Web/HeroSection.vue";
import FeaturedCategoriesSection from "@/Components/Web/FeaturedCategoriesSection.vue";
import ScrolledSocialSection from "@/Components/Web/ScrolledSocialSection.vue";
import FeaturesSection from "@/Components/Web/FeaturesSection.vue";
import RandomProductsSection from "@/Components/Web/RandomProductsSection.vue";
import Slider from "@/Components/Web/Slider.vue";
import SubscribeSection from "@/Components/Web/SubscribeSection.vue";

const props = defineProps([
    "categories",
    "random_products",
    "featured_categories",
]);
</script>

<template>
    <Head :title="$t('titles.web.description')" />
    <WebLayout>
        <div>
            <ScrolledSocialSection />

            <slider />

            <FeaturedCategoriesSection
                :categories="props.featured_categories"
            />

            <RandomProductsSection
                v-for="category in props.featured_categories.data.slice(0, 3)"
                :key="category.slug"
                :category="category"
            />

            <BrandSection />

            <RandomProductsSection
                v-for="category in props.featured_categories.data.slice(3, 7)"
                :key="category.slug"
                :category="category"
            />

            <section
                class="relative bg-red-600 bg-[url('/images/off-section.jpg')] bg-cover bg-center text-white py-40"
            >
                <div class="container h-full px-4 mx-auto mt-20 md:mt-0">
                    <div
                        class="flex flex-col md:flex-row items-center justify-between"
                    >
                        <div
                            class="flex-1 text-center md:text-left rtl:md:text-right mb-10 md:mb-0"
                        >
                            <h2
                                class="lg:text-6xl md:text-5xl text-3xl font-bold"
                            >
                                {{ $t("titles.web.sale.title") }}
                            </h2>
                            <p class="lg:text-3xl text-xl">
                                {{ $t("titles.web.sale.subtitle") }}
                            </p>
                            <p class="text-base opacity-90">
                                {{ $t("titles.web.sale.description") }}
                            </p>
                        </div>

                        <div class="flex-1 mt-5 md:-mt-10 text-center">
                            <div class="px-8 py-4 rounded-lg bg-white/10">
                                <p class="mb-4 text-lg">
                                    {{ $t("titles.web.sale.countdown.title") }}
                                </p>
                                <div class="grid grid-cols-4 gap-4">
                                    <div class="p-3 rounded bg-white/20">
                                        <span class="block text-4xl font-bold"
                                            >02</span
                                        >
                                        <span class="text-sm">{{
                                            $t("titles.web.sale.countdown.days")
                                        }}</span>
                                    </div>
                                    <div class="p-3 rounded bg-white/20">
                                        <span class="block text-4xl font-bold"
                                            >14</span
                                        >
                                        <span class="text-sm">{{
                                            $t(
                                                "titles.web.sale.countdown.hours"
                                            )
                                        }}</span>
                                    </div>
                                    <div class="p-3 rounded bg-white/20">
                                        <span class="block text-4xl font-bold"
                                            >33</span
                                        >
                                        <span class="text-sm">{{
                                            $t(
                                                "titles.web.sale.countdown.minutes"
                                            )
                                        }}</span>
                                    </div>
                                    <div class="p-3 rounded bg-white/20">
                                        <span class="block text-4xl font-bold"
                                            >59</span
                                        >
                                        <span class="text-sm">{{
                                            $t(
                                                "titles.web.sale.countdown.seconds"
                                            )
                                        }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="flex-1 text-center md:text-right rtl:md:text-left mt-10 md:mt-0"
                        >
                            <p
                                class="flex flex-row md:flex-col items-center md:items-end md:justify-center gap-2 mb-6 text-3xl font-bold"
                            >
                                <span>{{
                                    $t("titles.web.sale.code.text")
                                }}</span>
                                <span
                                    class="w-fit px-4 py-2 rounded bg-white/20"
                                    >{{
                                        $t("titles.web.sale.code.value")
                                    }}</span
                                >
                            </p>
                            <button
                                class="px-12 py-4 text-xl font-bold text-red-600 transition-colors bg-white rounded-full hover:bg-gray-100"
                            >
                                {{ $t("titles.web.sale.button") }}
                            </button>
                            <p class="mt-4 text-sm opacity-75">
                                {{ $t("titles.web.sale.terms") }}
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Price Table Section -->
            <PriceTable />

            <SubscribeSection />
        </div>
    </WebLayout>
</template>
