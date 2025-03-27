<script setup>
import { Head, Link } from "@inertiajs/vue3";
import LanguageSwitcher from "@/Components/Header/LanguageSwitcher.vue";

function handleImageError() {
    document.getElementById("screenshot-container")?.classList.add("!hidden");
    document.getElementById("docs-card")?.classList.add("!row-span-1");
    document.getElementById("docs-card-content")?.classList.add("!flex-row");
    document.getElementById("background")?.classList.add("!hidden");
}
</script>

<template>
    <Head :title="$t('titles.titles.web.description')" />

    <div>
        <nav class="absolute z-30 w-full">
            <div class="container px-4 py-4 mx-auto">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img
                            src="/images/logo.png"
                            alt="Logo"
                            class="w-auto h-20"
                        />
                    </div>
                    <div
                        class="items-center hidden gap-x-8 text-xl rtl:text-base ltr:font-semibold ltr:tracking-widest md:flex font-alumni"
                    >
                        <a href="#" class="text-white hover:text-gray-300">{{
                            $t("titles.web.navigation.home")
                        }}</a>
                        <a href="#" class="text-white hover:text-gray-300">{{
                            $t("titles.web.navigation.products")
                        }}</a>
                        <a href="#" class="text-white hover:text-gray-300">{{
                            $t("titles.web.navigation.categories")
                        }}</a>
                        <a href="#" class="text-white hover:text-gray-300">{{
                            $t("titles.web.navigation.contact")
                        }}</a>

                        <div class="flex items-center gap-x-4">
                            <LanguageSwitcher />

                            <select
                                class="py-1 border border-white rounded text-xs font-sans"
                            >
                                <option value="usd">USD</option>
                                <option value="rls">RLS</option>
                            </select>

                            <a href="#" class="text-white hover:text-gray-300">
                                <svg
                                    class="w-6 h-6"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
                                    ></path>
                                </svg>
                            </a>

                            <a href="#" class="text-white hover:text-gray-300">
                                <svg
                                    class="w-6 h-6"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                                    ></path>
                                </svg>
                            </a>

                            <a href="#" class="text-white hover:text-gray-300">
                                <svg
                                    class="w-6 h-6"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                    ></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="md:hidden">
                        <button class="text-white">
                            <svg
                                class="w-6 h-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                ></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>
        <section
            class="relative bg-[url(/images/main-hero.jpg)] bg-center text-white min-h-screen"
        >
            <div
                class="absolute inset-0 z-10 bg-black/60"
                style="
                    background-image: radial-gradient(
                        rgba(255, 255, 255, 0.1) 1px,
                        transparent 1px
                    );
                    background-size: 4px 4px;
                "
            ></div>
            <div class="container absolute z-20 px-4 mx-auto pt-60">
                <div class="text-center">
                    <h1 class="mb-4 rtl:mb-8 font-bold text-7xl font-alumni">
                        {{ $t("titles.web.hero.title") }}
                    </h1>
                    <p class="mb-8 text-xl">
                        {{ $t("titles.web.hero.subtitle") }}
                    </p>
                    <div class="flex justify-center">
                        <div class="relative w-full max-w-xl">
                            <input
                                type="search"
                                :placeholder="
                                    $t('titles.web.hero.search.placeholder')
                                "
                                class="w-full px-8 py-3 text-gray-900 placeholder-gray-500 rounded-full bg-white/90 focus:outline-none focus:ring-2 focus:ring-blue-600"
                            />
                            <button
                                class="absolute -translate-y-1/2 right-3 top-1/2"
                            >
                                <svg
                                    class="w-5 h-5 text-gray-500"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                    ></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Price Table Section -->
        <section class="py-20 bg-gray-100">
            <div class="container px-4 mx-auto">
                <h2 class="mb-16 text-6xl font-bold text-center font-alumni">
                    {{ $t("titles.web.plans.title") }}
                </h2>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-5">
                    <div
                        class="relative p-8 text-center border-2 rounded-lg shadow-lg border-amber-700"
                    >
                        <svg
                            class="absolute w-20 h-20 -translate-x-1/2 text-amber-700 top-4 left-1/2"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                            />
                        </svg>
                        <h3 class="mt-20 mb-4 text-4xl font-bold font-alumni">
                            {{ $t("titles.web.plans.bronze.name") }}
                        </h3>
                        <p class="mb-2 text-4xl font-bold">
                            {{ $t("titles.web.plans.bronze.price") }}
                        </p>
                        <p class="mb-6 text-lg text-green-600">
                            {{ $t("titles.web.plans.bronze.revenue") }}
                        </p>
                        <ul class="mb-8">
                            <li class="mb-2">
                                ✓
                                {{
                                    $t("titles.web.plans.bronze.features.basic")
                                }}
                            </li>
                            <li class="mb-2">
                                ✓
                                {{
                                    $t("titles.web.plans.bronze.features.email")
                                }}
                            </li>
                            <li class="mb-2">
                                ✓
                                {{
                                    $t(
                                        "titles.web.plans.bronze.features.analytics"
                                    )
                                }}
                            </li>
                        </ul>
                        <button
                            class="w-full py-2 text-white bg-blue-600 rounded-lg"
                        >
                            {{ $t("titles.web.plans.bronze.button") }}
                        </button>
                    </div>

                    <div
                        class="relative p-8 text-center border-2 border-gray-400 rounded-lg shadow-lg"
                    >
                        <svg
                            class="absolute w-20 h-20 text-gray-400 -translate-x-1/2 top-4 left-1/2"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                            />
                        </svg>
                        <h3 class="mt-20 mb-4 text-4xl font-bold font-alumni">
                            {{ $t("titles.web.plans.silver.name") }}
                        </h3>
                        <p class="mb-2 text-4xl font-bold">
                            {{ $t("titles.web.plans.silver.price") }}
                        </p>
                        <p class="mb-6 text-lg text-green-600">
                            {{ $t("titles.web.plans.silver.revenue") }}
                        </p>
                        <ul class="mb-8">
                            <li class="mb-2">
                                ✓
                                {{
                                    $t("titles.web.plans.bronze.features.basic")
                                }}
                            </li>
                            <li class="mb-2">
                                ✓
                                {{
                                    $t(
                                        "titles.web.plans.silver.features.support"
                                    )
                                }}
                            </li>
                            <li class="mb-2">
                                ✓
                                {{
                                    $t(
                                        "titles.web.plans.silver.features.analytics"
                                    )
                                }}
                            </li>
                        </ul>
                        <button
                            class="w-full py-2 text-white bg-blue-600 rounded-lg"
                        >
                            {{ $t("titles.web.plans.silver.button") }}
                        </button>
                    </div>

                    <div
                        class="relative p-8 text-center border-2 border-yellow-500 rounded-lg shadow-lg"
                    >
                        <svg
                            class="absolute w-20 h-20 text-yellow-500 -translate-x-1/2 top-4 left-1/2"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                            />
                        </svg>
                        <h3 class="mt-20 mb-4 text-4xl font-bold font-alumni">
                            {{ $t("titles.web.plans.gold.name") }}
                        </h3>
                        <p class="mb-2 text-4xl font-bold">
                            {{ $t("titles.web.plans.gold.price") }}
                        </p>
                        <p class="mb-6 text-lg text-green-600">
                            {{ $t("titles.web.plans.gold.revenue") }}
                        </p>
                        <ul class="mb-8">
                            <li class="mb-2">
                                ✓
                                {{
                                    $t("titles.web.plans.gold.features.silver")
                                }}
                            </li>
                            <li class="mb-2">
                                ✓
                                {{
                                    $t("titles.web.plans.gold.features.support")
                                }}
                            </li>
                            <li class="mb-2">
                                ✓
                                {{
                                    $t(
                                        "titles.web.plans.gold.features.analytics"
                                    )
                                }}
                            </li>
                        </ul>
                        <button
                            class="w-full py-2 text-white bg-blue-600 rounded-lg"
                        >
                            {{ $t("titles.web.plans.gold.button") }}
                        </button>
                    </div>

                    <div
                        class="relative p-8 text-center border-2 border-gray-600 rounded-lg shadow-lg"
                    >
                        <svg
                            class="absolute w-20 h-20 text-gray-600 -translate-x-1/2 top-4 left-1/2"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                            />
                        </svg>
                        <h3 class="mt-20 mb-4 text-4xl font-bold font-alumni">
                            {{ $t("titles.web.plans.platinum.name") }}
                        </h3>
                        <p class="mb-2 text-4xl font-bold">
                            {{ $t("titles.web.plans.platinum.price") }}
                        </p>
                        <p class="mb-6 text-lg text-green-600">
                            {{ $t("titles.web.plans.platinum.revenue") }}
                        </p>
                        <ul class="mb-8">
                            <li class="mb-2">
                                ✓
                                {{
                                    $t(
                                        "titles.web.plans.platinum.features.gold"
                                    )
                                }}
                            </li>
                            <li class="mb-2">
                                ✓
                                {{
                                    $t(
                                        "titles.web.plans.platinum.features.support"
                                    )
                                }}
                            </li>
                            <li class="mb-2">
                                ✓
                                {{
                                    $t(
                                        "titles.web.plans.platinum.features.analytics"
                                    )
                                }}
                            </li>
                        </ul>
                        <button
                            class="w-full py-2 text-white bg-blue-600 rounded-lg"
                        >
                            {{ $t("titles.web.plans.platinum.button") }}
                        </button>
                    </div>

                    <div
                        class="relative p-8 text-center border-2 border-blue-500 rounded-lg shadow-lg"
                    >
                        <svg
                            class="absolute w-20 h-20 text-blue-500 -translate-x-1/2 top-4 left-1/2"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                            />
                        </svg>
                        <h3 class="mt-20 mb-4 text-4xl font-bold font-alumni">
                            {{ $t("titles.web.plans.diamond.name") }}
                        </h3>
                        <p class="mb-2 text-4xl font-bold">
                            {{ $t("titles.web.plans.diamond.price") }}
                        </p>
                        <p class="mb-6 text-lg text-green-600">
                            {{ $t("titles.web.plans.diamond.revenue") }}
                        </p>
                        <ul class="mb-8">
                            <li class="mb-2">
                                ✓
                                {{
                                    $t(
                                        "titles.web.plans.diamond.features.platinum"
                                    )
                                }}
                            </li>
                            <li class="mb-2">
                                ✓
                                {{
                                    $t(
                                        "titles.web.plans.platinum.features.support"
                                    )
                                }}
                            </li>
                        </ul>
                        <button
                            class="w-full py-2 text-white bg-blue-600 rounded-lg"
                        >
                            {{ $t("titles.web.plans.diamond.button") }}
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Off Section -->
        <section
            class="relative bg-red-600 bg-[url('/images/off-section.jpg')] bg-cover bg-center text-white py-32"
        >
            <div class="container px-4 mx-auto">
                <div class="grid items-center gap-8 md:grid-cols-3">
                    <div class="text-center md:text-left rtl:md:text-right">
                        <h2 class="mb-4 text-6xl font-bold font-alumni">
                            {{ $t("titles.web.sale.title") }}
                        </h2>
                        <p class="mb-4 text-2xl">
                            {{ $t("titles.web.sale.subtitle") }}
                        </p>
                        <p class="text-lg opacity-90">
                            {{ $t("titles.web.sale.description") }}
                        </p>
                    </div>

                    <div class="-mt-10 text-center">
                        <div class="p-8 rounded-lg bg-white/10">
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
                                        $t("titles.web.sale.countdown.hours")
                                    }}</span>
                                </div>
                                <div class="p-3 rounded bg-white/20">
                                    <span class="block text-4xl font-bold"
                                        >33</span
                                    >
                                    <span class="text-sm">{{
                                        $t("titles.web.sale.countdown.minutes")
                                    }}</span>
                                </div>
                                <div class="p-3 rounded bg-white/20">
                                    <span class="block text-4xl font-bold"
                                        >59</span
                                    >
                                    <span class="text-sm">{{
                                        $t("titles.web.sale.countdown.seconds")
                                    }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center md:text-right rtl:md:text-left">
                        <p class="mb-6 text-3xl font-bold">
                            {{ $t("titles.web.sale.code.text") }}:
                            <span class="px-4 py-2 rounded bg-white/20">{{
                                $t("titles.web.sale.code.value")
                            }}</span>
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
        <section class="py-20 bg-white">
            <div class="container px-4 mx-auto">
                <h2 class="mb-16 text-6xl font-bold text-center font-alumni">
                    {{ $t("titles.web.brands.title") }}
                </h2>
                <div class="flex items-center justify-center">
                    <div class="flex">
                        <!-- Brand logos - Add your actual brand images -->
                        <div
                            class="flex items-center justify-center w-48 h-32 mx-8 transition-all duration-300 grayscale hover:grayscale-0"
                        >
                            <img
                                src="/images/brand1.png"
                                alt="Brand 1"
                                class="max-h-full"
                            />
                        </div>
                        <div
                            class="flex items-center justify-center w-48 h-32 mx-8 transition-all duration-300 grayscale hover:grayscale-0"
                        >
                            <img
                                src="/images/brand2.png"
                                alt="Brand 2"
                                class="max-h-full"
                            />
                        </div>
                        <div
                            class="flex items-center justify-center w-48 h-32 mx-8 transition-all duration-300 grayscale hover:grayscale-0"
                        >
                            <img
                                src="/images/brand3.png"
                                alt="Brand 3"
                                class="max-h-full"
                            />
                        </div>
                        <div
                            class="flex items-center justify-center w-48 h-32 mx-8 transition-all duration-300 grayscale hover:grayscale-0"
                        >
                            <img
                                src="/images/brand4.png"
                                alt="Brand 4"
                                class="max-h-full"
                            />
                        </div>
                        <div
                            class="flex items-center justify-center w-48 h-32 mx-8 transition-all duration-300 grayscale hover:grayscale-0"
                        >
                            <img
                                src="/images/brand5.png"
                                alt="Brand 5"
                                class="max-h-full"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Categories Section -->
        <section class="h-screen py-32 bg-gradient-to-b from-black to-gray-900">
            <div class="container flex flex-col px-4 mx-auto">
                <h2
                    class="mb-16 text-4xl font-bold text-center text-white font-alumni"
                >
                    {{ $t("titles.web.categories.title") }}
                </h2>
                <div
                    class="flex flex-row items-stretch justify-center max-w-2xl mx-auto min-w-md sm:flex-row sm:h-80 sm:overflow-hidden"
                >
                    <div
                        class="relative m-2 overflow-hidden transition-all duration-700 ease-in-out cursor-pointer min-h-14 min-w-20 pane rounded-3xl"
                    >
                        <div
                            class="absolute background bg-center bg-cover bg-red-500 bg-[url('/images/electronics.jpg')] bg-no-repeat duration-700 ease-in-out inset-0 scale-105 transition-all z-10"
                        ></div>
                        <div
                            class="absolute inset-x-0 bottom-0 z-20 transition-all duration-700 ease-in-out transform translate-y-1/2 shadow opacity-0 bg-gradient-to-b from-transparent h-1/2 to-black"
                        ></div>
                        <div
                            class="absolute bottom-0 z-30 flex mb-2 ml-3 transition-all duration-700 ease-in-out label left-3 sm:mb-3 sm:ml-2"
                        >
                            <div
                                class="flex items-center justify-center w-10 h-10 mr-3 text-red-500 bg-gray-900 rounded-full icon"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-6 h-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                    />
                                </svg>
                            </div>
                            <div
                                class="flex flex-col justify-center leading-tight text-white whitespace-pre content"
                            >
                                <div
                                    class="relative font-bold transition-all duration-700 ease-in-out transform translate-x-8 opacity-0"
                                >
                                    {{
                                        $t(
                                            "titles.web.categories.electronics.name"
                                        )
                                    }}
                                </div>
                                <div
                                    class="relative transition-all duration-700 ease-in-out delay-100 transform translate-x-8 opacity-0"
                                >
                                    {{
                                        $t(
                                            "titles.web.categories.electronics.tagline"
                                        )
                                    }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="relative m-2 overflow-hidden transition-all duration-700 ease-in-out cursor-pointer undefined min-h-14 min-w-20 pane rounded-3xl"
                    >
                        <div
                            class="absolute background bg-center bg-cover bg-yellow-500 bg-[url('/images/furniture.jpg')] bg-no-repeat duration-700 ease-in-out inset-0 scale-105 transition-all z-10"
                        ></div>
                        <div
                            class="absolute inset-x-0 bottom-0 z-20 transition-all duration-700 ease-in-out transform translate-y-1/2 shadow opacity-0 bg-gradient-to-b from-transparent h-1/2 to-black"
                        ></div>
                        <div
                            class="absolute bottom-0 z-30 flex mb-2 ml-3 transition-all duration-700 ease-in-out label left-3 sm:mb-3 sm:ml-2"
                        >
                            <div
                                class="flex items-center justify-center w-10 h-10 mr-3 text-yellow-500 bg-gray-900 rounded-full icon"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-6 h-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                                    />
                                </svg>
                            </div>
                            <div
                                class="flex flex-col justify-center leading-tight text-white whitespace-pre content"
                            >
                                <div
                                    class="relative font-bold transition-all duration-700 ease-in-out transform translate-x-8 opacity-0"
                                >
                                    {{
                                        $t(
                                            "titles.web.categories.furniture.name"
                                        )
                                    }}
                                </div>
                                <div
                                    class="relative transition-all duration-700 ease-in-out delay-100 transform translate-x-8 opacity-0"
                                >
                                    {{
                                        $t(
                                            "titles.web.categories.furniture.tagline"
                                        )
                                    }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="relative m-2 overflow-hidden transition-all duration-700 ease-in-out cursor-pointer undefined min-h-14 min-w-20 pane rounded-3xl"
                    >
                        <div
                            class="absolute background bg-left bg-cover bg-green-500 bg-[url('/images/shoes.jpg')] bg-no-repeat duration-700 ease-in-out inset-0 scale-105 transition-all z-10"
                        ></div>
                        <div
                            class="absolute inset-x-0 bottom-0 z-20 transition-all duration-700 ease-in-out transform translate-y-1/2 shadow opacity-0 bg-gradient-to-b from-transparent h-1/2 to-black"
                        ></div>
                        <div
                            class="absolute bottom-0 z-30 flex mb-2 ml-3 transition-all duration-700 ease-in-out label left-3 sm:mb-3 sm:ml-2"
                        >
                            <div
                                class="flex items-center justify-center w-10 h-10 mr-3 text-green-500 bg-gray-900 rounded-full icon"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-6 h-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M16 3h5m0 0v5m0-5l-6 6M8 21H3m0 0v-5m0 5l6-6"
                                    />
                                </svg>
                            </div>
                            <div
                                class="flex flex-col justify-center leading-tight text-white whitespace-pre content"
                            >
                                <div
                                    class="relative font-bold transition-all duration-700 ease-in-out transform translate-x-8 opacity-0"
                                >
                                    {{ $t("titles.web.categories.shoes.name") }}
                                </div>
                                <div
                                    class="relative transition-all duration-700 ease-in-out delay-100 transform translate-x-8 opacity-0"
                                >
                                    {{
                                        $t(
                                            "titles.web.categories.shoes.tagline"
                                        )
                                    }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="relative m-2 overflow-hidden transition-all duration-700 ease-in-out cursor-pointer undefined min-h-14 min-w-20 pane rounded-3xl active"
                    >
                        <div
                            class="absolute background bg-center bg-cover bg-blue-500 bg-[url('/images/honey.jpg')] bg-no-repeat duration-700 ease-in-out inset-0 scale-105 transition-all z-10"
                        ></div>
                        <div
                            class="absolute inset-x-0 bottom-0 z-20 transition-all duration-700 ease-in-out transform translate-y-1/2 shadow opacity-0 bg-gradient-to-b from-transparent h-1/2 to-black"
                        ></div>
                        <div
                            class="absolute bottom-0 z-30 flex mb-2 ml-3 transition-all duration-700 ease-in-out label left-3 sm:mb-3 sm:ml-2"
                        >
                            <div
                                class="flex items-center justify-center w-10 h-10 mr-3 text-blue-500 bg-gray-900 rounded-full icon"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-6 h-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2z"
                                    />
                                </svg>
                            </div>
                            <div
                                class="flex flex-col justify-center leading-tight text-white whitespace-pre content"
                            >
                                <div
                                    class="relative font-bold transition-all duration-700 ease-in-out transform translate-x-8 opacity-0"
                                >
                                    {{ $t("titles.web.categories.honey.name") }}
                                </div>
                                <div
                                    class="relative transition-all duration-700 ease-in-out delay-100 transform translate-x-8 opacity-0"
                                >
                                    {{
                                        $t(
                                            "titles.web.categories.honey.tagline"
                                        )
                                    }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="relative m-2 overflow-hidden transition-all duration-700 ease-in-out cursor-pointer undefined min-h-14 min-w-20 pane rounded-3xl"
                    >
                        <div
                            class="absolute background bg-center bg-cover bg-purple-500 bg-[url('/images/home.jpg')] bg-no-repeat duration-700 ease-in-out inset-0 scale-105 transition-all z-10"
                        ></div>
                        <div
                            class="absolute inset-x-0 bottom-0 z-20 transition-all duration-700 ease-in-out transform translate-y-1/2 shadow opacity-0 bg-gradient-to-b from-transparent h-1/2 to-black"
                        ></div>
                        <div
                            class="absolute bottom-0 z-30 flex mb-2 ml-3 transition-all duration-700 ease-in-out label left-3 sm:mb-3 sm:ml-2"
                        >
                            <div
                                class="flex items-center justify-center w-10 h-10 mr-3 text-purple-500 bg-gray-900 rounded-full icon"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-6 h-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 20l9-13m0 0L12 4m0 16l-9-13"
                                    />
                                </svg>
                            </div>
                            <div
                                class="flex flex-col justify-center leading-tight text-white whitespace-pre content"
                            >
                                <div
                                    class="relative font-bold transition-all duration-700 ease-in-out transform translate-x-8 opacity-0"
                                >
                                    {{ $t("titles.web.categories.home.name") }}
                                </div>
                                <div
                                    class="relative transition-all duration-700 ease-in-out delay-100 transform translate-x-8 opacity-0"
                                >
                                    {{
                                        $t("titles.web.categories.home.tagline")
                                    }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="relative m-2 overflow-hidden transition-all duration-700 ease-in-out cursor-pointer undefined min-h-14 min-w-20 pane rounded-3xl"
                    >
                        <div
                            class="absolute background bg-center bg-cover bg-purple-500 bg-[url('/images/tshirt.jpg')] bg-no-repeat duration-700 ease-in-out inset-0 scale-105 transition-all z-10"
                        ></div>
                        <div
                            class="absolute inset-x-0 bottom-0 z-20 transition-all duration-700 ease-in-out transform translate-y-1/2 shadow opacity-0 bg-gradient-to-b from-transparent h-1/2 to-black"
                        ></div>
                        <div
                            class="absolute bottom-0 z-30 flex mb-2 ml-3 transition-all duration-700 ease-in-out label left-3 sm:mb-3 sm:ml-2"
                        >
                            <div
                                class="flex items-center justify-center w-10 h-10 mr-3 text-purple-500 bg-gray-900 rounded-full icon"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-6 h-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z"
                                    />
                                </svg>
                            </div>
                            <div
                                class="flex flex-col justify-center leading-tight text-white whitespace-pre content"
                            >
                                <div
                                    class="relative font-bold transition-all duration-700 ease-in-out transform translate-x-8 opacity-0"
                                >
                                    {{
                                        $t("titles.web.categories.tshirts.name")
                                    }}
                                </div>
                                <div
                                    class="relative transition-all duration-700 ease-in-out delay-100 transform translate-x-8 opacity-0"
                                >
                                    {{
                                        $t(
                                            "titles.web.categories.tshirts.tagline"
                                        )
                                    }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="relative m-2 overflow-hidden transition-all duration-700 ease-in-out cursor-pointer undefined min-h-14 min-w-20 pane rounded-3xl"
                    >
                        <div
                            class="absolute background bg-right bg-cover bg-purple-500 bg-[url('/images/bathroom.jpg')] bg-no-repeat duration-700 ease-in-out inset-0 scale-105 transition-all z-10"
                        ></div>
                        <div
                            class="absolute inset-x-0 bottom-0 z-20 transition-all duration-700 ease-in-out transform translate-y-1/2 shadow opacity-0 bg-gradient-to-b from-transparent h-1/2 to-black"
                        ></div>
                        <div
                            class="absolute bottom-0 z-30 flex mb-2 ml-3 transition-all duration-700 ease-in-out label left-3 sm:mb-3 sm:ml-2"
                        >
                            <div
                                class="flex items-center justify-center w-10 h-10 mr-3 text-purple-500 bg-gray-900 rounded-full icon"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-6 h-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M21.75 17.25h-.75V7.5a1.5 1.5 0 0 0-1.5-1.5H16.5v-.75a.75.75 0 0 0-.75-.75h-1.5a.75.75 0 0 0-.75.75v.75h-3v-.75a.75.75 0 0 0-.75-.75h-1.5a.75.75 0 0 0-.75.75v.75H4.5A1.5 1.5 0 0 0 3 7.5v9.75h-.75a.75.75 0 0 0 0 1.5h19.5a.75.75 0 0 0 0-1.5Z"
                                    />
                                </svg>
                            </div>
                            <div
                                class="flex flex-col justify-center leading-tight text-white whitespace-pre content"
                            >
                                <div
                                    class="relative font-bold transition-all duration-700 ease-in-out transform translate-x-8 opacity-0"
                                >
                                    {{
                                        $t(
                                            "titles.web.categories.bathroom.name"
                                        )
                                    }}
                                </div>
                                <div
                                    class="relative transition-all duration-700 ease-in-out delay-100 transform translate-x-8 opacity-0"
                                >
                                    {{
                                        $t(
                                            "titles.web.categories.bathroom.tagline"
                                        )
                                    }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Latest Products Section -->
        <section class="py-20 bg-gray-100 font-alumni">
            <div class="container px-4 mx-auto">
                <h2
                    class="mb-4 ml-10 text-4xl font-bold text-left rtl:text-right"
                >
                    {{ $t("titles.web.products.electronics.title") }}
                </h2>
                <div class="flex flex-row gap-4 p-3 bg-gray-200 rounded-lg">
                    <div
                        class="flex-1 overflow-hidden bg-white rounded-lg shadow-lg"
                    >
                        <img
                            src="/images/tv.jpg"
                            alt="Product 1"
                            class="object-cover w-full h-64"
                        />
                        <div class="p-6">
                            <h3 class="mb-2 text-3xl font-bold">
                                {{
                                    $t(
                                        "titles.web.products.electronics.television.name"
                                    )
                                }}
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
                            class="object-cover w-full h-64"
                        />
                        <div class="p-6">
                            <h3 class="mb-2 text-3xl font-bold">
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
                            class="object-cover w-full h-64"
                        />
                        <div class="p-6">
                            <h3 class="mb-2 text-3xl font-bold">
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
                            class="object-cover w-full h-64"
                        />
                        <div class="p-6">
                            <h3 class="mb-2 text-3xl font-bold">
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
                        class="overflow-hidden bg-white rounded-lg shadow-lg w-60"
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

        <!-- Footer -->
        <footer class="py-16 text-white bg-gray-800">
            <div class="container px-4 mx-auto">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
                    <div>
                        <h4 class="mb-4 text-xl font-bold">
                            {{ $t("titles.web.footer.about.title") }}
                        </h4>
                        <p>{{ $t("titles.web.footer.about.description") }}</p>
                    </div>
                    <div>
                        <h4 class="mb-4 text-xl font-bold">
                            {{ $t("titles.web.footer.quick_links.title") }}
                        </h4>
                        <ul>
                            <li class="mb-2">
                                <a href="#" class="hover:text-blue-400">{{
                                    $t("titles.web.footer.quick_links.home")
                                }}</a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="hover:text-blue-400">{{
                                    $t("titles.web.footer.quick_links.shop")
                                }}</a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="hover:text-blue-400">{{
                                    $t("titles.web.footer.quick_links.about")
                                }}</a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="hover:text-blue-400">{{
                                    $t("titles.web.footer.quick_links.contact")
                                }}</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="mb-4 text-xl font-bold">
                            {{ $t("titles.web.footer.contact.title") }}
                        </h4>
                        <ul>
                            <li class="mb-2">
                                {{ $t("titles.web.footer.contact.email") }}
                            </li>
                            <li class="mb-2">
                                {{ $t("titles.web.footer.contact.phone") }}
                            </li>
                            <li class="mb-2">
                                {{ $t("titles.web.footer.contact.address") }}
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="mb-4 text-xl font-bold">
                            {{ $t("titles.web.footer.social.title") }}
                        </h4>
                        <div class="flex gap-4">
                            <a href="#" class="hover:text-blue-400">{{
                                $t("titles.web.footer.social.facebook")
                            }}</a>
                            <a href="#" class="hover:text-blue-400">{{
                                $t("titles.web.footer.social.twitter")
                            }}</a>
                            <a href="#" class="hover:text-blue-400">{{
                                $t("titles.web.footer.social.instagram")
                            }}</a>
                        </div>
                    </div>
                </div>
                <div class="pt-8 mt-12 text-center border-t border-gray-700">
                    <p>{{ $t("titles.web.footer.copyright") }}</p>
                </div>
            </div>
        </footer>
    </div>
</template>
