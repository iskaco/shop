<script setup>
import WebLayout from "@/Layouts/WebLayout.vue";
import { ref } from "vue";

const props = defineProps(["product"]);

const getImage = function (image) {
    return route("shop.media", image);
};
</script>
<template>
    <WebLayout menuBg="bg-[url(/images/menubg.jpg)] bg-center">
        <div class="container mx-auto md:px-20 px-10 mt-40 mb-20">
            <!-- Product Details Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Product Images -->
                <div class="space-y-4">
                    <div
                        class="aspect-square bg-gray-100 rounded-lg overflow-hidden"
                    >
                        <img
                            :src="getImage(props.product.data.image)"
                            :alt="props.product.data.name"
                            class="w-full h-full object-cover"
                        />
                    </div>
                    <div class="grid grid-cols-4 gap-4">
                        <div
                            v-for="(image, index) in props.product.data.gallery"
                            :key="index"
                            class="aspect-square bg-gray-100 rounded-lg overflow-hidden cursor-pointer"
                        >
                            <img
                                :src="image"
                                :alt="props.product.data.name"
                                class="w-full h-full object-cover"
                            />
                        </div>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="space-y-6">
                    <div>
                        <h1 class="text-2xl font-bold mb-2">
                            {{ props.product.data.name }}
                        </h1>
                        <p class="text-gray-600">
                            {{ props.product.data.englishName }}
                        </p>
                    </div>

                    <div class="border-t border-b py-4">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-gray-600"
                                >{{ $t("category") }}:</span
                            >
                            <span>{{ props.product.data.category }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-gray-600"
                                >{{ $t("brand") }}:</span
                            >
                            <span>{{ props.product.data.brand }}</span>
                        </div>
                    </div>

                    <!-- Features -->
                    <div class="space-y-2">
                        <h3 class="font-bold">{{ $t("features") }}:</h3>
                        <ul
                            class="list-disc list-inside space-y-1 text-gray-600"
                        >
                            <li
                                v-for="(feature, index) in props.product
                                    .features"
                                :key="index"
                            >
                                {{ feature }}
                            </li>
                        </ul>
                    </div>

                    <!-- Price & Add to Cart -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-gray-600"
                                >{{ $t("price") }}:</span
                            >
                            <div class="text-xl font-bold">
                                {{ props.product.data.price }}
                                {{ $t("currency") }}
                            </div>
                        </div>
                        <button
                            class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition"
                        >
                            {{ $t("addToCart") }}
                        </button>
                    </div>

                    <!-- Seller Info -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-bold mb-2">{{ $t("seller") }}</h3>
                        <div class="flex items-center gap-2 text-gray-600">
                            <svg
                                class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                                />
                            </svg>
                            <span>{{ props.product.data.seller }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description Section -->
            <div class="mt-12">
                <h2 class="text-xl font-bold mb-4">{{ $t("description") }}</h2>
                <div
                    class="prose max-w-none"
                    v-html="props.product.data.description"
                ></div>
            </div>

            <!-- Specifications Section -->
            <div class="mt-12">
                <h2 class="text-xl font-bold mb-4">
                    {{ $t("specifications") }}
                </h2>
                <div class="border rounded-lg">
                    <div
                        v-for="(group, index) in props.product.data
                            .specifications"
                        :key="index"
                        class="border-b last:border-b-0"
                    >
                        <div class="bg-gray-50 px-4 py-2 font-bold">
                            {{ group.title }}
                        </div>
                        <div class="divide-y">
                            <div
                                v-for="(spec, specIndex) in group.items"
                                :key="specIndex"
                                class="grid grid-cols-3 px-4 py-3"
                            >
                                <div class="text-gray-600">{{ spec.name }}</div>
                                <div class="col-span-2">{{ spec.value }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </WebLayout>
</template>
