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
        <div class="mx-auto md:px-20 px-10 mt-40 mb-20">
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
                                :src="getImage(image)"
                                :alt="props.product.data.name"
                                class="w-full h-full object-cover"
                            />
                        </div>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="space-y-6">
                    <div>
                        <h1 class="text-2xl font-bold mb-2 text-boxdark-2">
                            {{ props.product.data.name }}
                        </h1>
                        <p class="text-body">
                            {{ props.product.data.short_description }}
                        </p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg border">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-body"
                                >{{ $t("titles.web.products.category") }}:</span
                            >
                            <span class="text-boxdark-2 font-medium">{{
                                props.product.data.category
                            }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-body"
                                >{{ $t("titles.web.products.brand") }}:</span
                            >
                            <span class="text-boxdark-2 font-medium">{{
                                props.product.data.brand
                            }}</span>
                        </div>
                    </div>

                    <!-- Features -->
                    <div v-if="props.product.features" class="space-y-2">
                        <h3 class="font-bold">
                            {{ $t("titles.web.products.features") }}:
                        </h3>
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
                    <div class="bg-gray-50 p-4 rounded-lg border">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-gray-600"
                                >{{ $t("titles.web.products.price") }}:</span
                            >
                            <div class="text-xl font-bold">
                                {{ props.product.data.price }}
                                {{ $t("titles.web.products.currency") }}
                            </div>
                        </div>
                        <button
                            @click="addToCart(props.product)"
                            class="w-full flex rtl:flex-row-reverse gap-2 items-center justify-center rounded-md bg-slate-900 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300"
                        >
                            <v-icon name="md-shoppingcart-outlined"></v-icon>
                            {{
                                isInCart
                                    ? $t("titles.web.products.isInCart")
                                    : $t("titles.web.products.addtocart")
                            }}
                        </button>
                    </div>

                    <!-- Seller Info -->
                    <div
                        v-if="props.product.data.seller"
                        class="bg-gray-50 p-4 rounded-lg"
                    >
                        <h3 class="font-bold mb-2">
                            {{ $t("titles.web.products.seller") }}
                        </h3>
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
                <h2 class="text-xl font-bold mb-4">
                    {{ $t("titles.web.products.description") }}
                </h2>
                <div
                    class="prose max-w-none"
                    v-html="props.product.data.description"
                ></div>
            </div>

            <!-- Specifications Section -->
            <div v-if="props.product.data.specifications.length" class="mt-12">
                <h2 class="text-xl font-bold mb-4">
                    {{ $t("titles.web.products.specifications") }}
                </h2>
                <div class="border rounded-lg grid grid-cols-5 p-5 bg-gray-50">
                    <template
                        v-for="spec in props.product.data.specifications"
                        :key="spec.id"
                    >
                        <div class="text-body border-b py-3">
                            {{ spec.name_translated }}
                        </div>
                        <div
                            class="col-span-4 text-boxdark-2 font-medium border-b py-3"
                        >
                            {{ spec.pivot.value }}
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </WebLayout>
</template>
