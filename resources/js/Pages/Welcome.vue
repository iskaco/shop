<script setup>
import { Head, Link } from "@inertiajs/vue3";
import WebLayout from "@/Layouts/WebLayout.vue";
import PriceTable from "@/Components/Web/PriceTable.vue";
import HeroSection from "@/Components/Web/HeroSection.vue";
import FeaturedCategoriesSection from "@/Components/Web/FeaturedCategoriesSection.vue";
import BrandSectionVue from "@/Components/Web/BrandSection.vue";

const props = defineProps(["categories"]);
</script>

<template>
    <Head :title="$t('titles.web.description')" />
    <WebLayout>
        <div>
            <HeroSection
                :title="$t('titles.web.hero.title')"
                :subtitle="$t('titles.web.hero.subtitle')"
                banner="/images/main-hero.jpg"
            />
            <!-- Price Table Section -->
            <PriceTable />

            <!-- Off Section -->
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

            <!-- Brands Section -->
            <BrandSection />

            <!-- Categories Section -->
            <FeaturedCategoriesSection :categories="props.categories" />

            <!-- Latest Products Section -->
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
                        <div
                            class="flex-1 overflow-hidden bg-white rounded-lg shadow-lg"
                        >
                            <img
                                src="/images/tv.jpg"
                                alt="Product 1"
                                class="object-cover w-full h-64 hover:rotate-2 hover:scale-110 transition-all duration-300"
                            />
                            <div class="p-6">
                                <h3 class="mb-2 text-xl md:text-2xl font-bold">
                                    <Link href="/product/1">
                                        {{
                                            $t(
                                                "titles.web.products.electronics.television.name"
                                            )
                                        }}
                                    </Link>
                                </h3>
                                <p class="mb-4 text-xl text-gray-600">
                                    {{
                                        $t(
                                            "titles.web.products.electronics.television.price"
                                        )
                                    }}
                                </p>
                                <button
                                    class="w-full py-2 text-white bg-blue-600 rounded-lg"
                                >
                                    {{
                                        $t(
                                            "titles.web.products.electronics.television.button"
                                        )
                                    }}
                                </button>
                            </div>
                        </div>
                        <div
                            class="flex-1 overflow-hidden bg-white rounded-lg shadow-lg"
                        >
                            <img
                                src="/images/laptop.jpg"
                                alt="Product 1"
                                class="object-cover w-full h-64 hover:rotate-2 hover:scale-110 transition-all duration-300"
                            />
                            <div class="p-6">
                                <h3 class="mb-2 text-xl md:text-2xl font-bold">
                                    {{
                                        $t(
                                            "titles.web.products.electronics.laptop.name"
                                        )
                                    }}
                                </h3>
                                <p class="mb-4 text-xl text-gray-600">$300</p>
                                <button
                                    class="w-full py-2 text-white bg-blue-600 rounded-lg"
                                >
                                    {{
                                        $t(
                                            "titles.web.products.electronics.laptop.button"
                                        )
                                    }}
                                </button>
                            </div>
                        </div>
                        <div
                            class="flex-1 overflow-hidden bg-white rounded-lg shadow-lg"
                        >
                            <img
                                src="/images/mobile.jpg"
                                alt="Product 1"
                                class="object-cover w-full h-64 hover:rotate-2 hover:scale-110 transition-all duration-300"
                            />
                            <div class="p-6">
                                <h3 class="mb-2 text-xl md:text-2xl font-bold">
                                    {{
                                        $t(
                                            "titles.web.products.electronics.smartphone.name"
                                        )
                                    }}
                                </h3>
                                <p class="mb-4 text-xl text-gray-600">$120</p>
                                <button
                                    class="w-full py-2 text-white bg-blue-600 rounded-lg"
                                >
                                    {{
                                        $t(
                                            "titles.web.products.electronics.smartphone.button"
                                        )
                                    }}
                                </button>
                            </div>
                        </div>
                        <div
                            class="flex-1 overflow-hidden bg-white rounded-lg shadow-lg"
                        >
                            <img
                                src="/images/watch.jpg"
                                alt="Product 1"
                                class="object-cover w-full h-64 hover:rotate-2 hover:scale-110 transition-all duration-300"
                            />
                            <div class="p-6">
                                <h3 class="mb-2 text-xl md:text-2xl font-bold">
                                    {{
                                        $t(
                                            "titles.web.products.electronics.smartwatch.name"
                                        )
                                    }}
                                </h3>
                                <p class="mb-4 text-xl text-gray-600">$50.99</p>
                                <button
                                    class="w-full py-2 text-white bg-blue-600 rounded-lg"
                                >
                                    {{
                                        $t(
                                            "titles.web.products.electronics.smartwatch.button"
                                        )
                                    }}
                                </button>
                            </div>
                        </div>
                        <div
                            class="overflow-hidden bg-white rounded-lg shadow-lg lg:w-40 w-full"
                        >
                            <img
                                src="/images/electronics-adv.jpg"
                                alt="Product 1"
                                class="object-cover h-full"
                            />
                        </div>
                    </div>
                </div>
            </section>

            <!-- Subscribe Newsletter Section -->
            <section class="py-20 text-white bg-gray-900">
                <div class="container px-4 mx-auto">
                    <div class="max-w-2xl mx-auto text-center">
                        <h2 class="mb-8 text-4xl font-bold">
                            {{ $t("titles.web.newsletter.title") }}
                        </h2>
                        <p class="mb-8">
                            {{ $t("titles.web.newsletter.description") }}
                        </p>
                        <form class="flex flex-col gap-4 md:flex-row">
                            <input
                                type="email"
                                :placeholder="
                                    $t('titles.web.newsletter.placeholder')
                                "
                                class="flex-1 px-4 py-3 text-black rounded-lg"
                            />
                            <button class="px-8 py-3 bg-blue-600 rounded-lg">
                                {{ $t("titles.web.newsletter.button") }}
                            </button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </WebLayout>
</template>
