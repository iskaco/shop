<script setup>
const props = defineProps(["product"]);

const getImage = function () {
    return route("shop.media", props.product.image);
};
</script>
<template>
    <div
        style="direction: ltr"
        class="relative flex w-full flex-col overflow-hidden rounded-lg border border-gray-100 bg-white shadow-md ltr:"
    >
        <a
            class="relative mx-3 mt-3 flex h-60 overflow-hidden rounded-xl"
            href="#"
        >
            <img
                class="w-full object-cover"
                :src="getImage()"
                alt="product image"
            />
            <span
                class="absolute top-0 ltr:left-0 rtl:right-0 m-2 rounded-full bg-black px-2 text-center text-sm font-medium text-white"
                >{{ Math.floor(Math.random() * 100) }}% OFF</span
            >
            <span
                class="absolute flex gap-1 justify-center items-center bottom-0 ltr:right-0 rtl:left-0 m-2 rounded-full bg-meta-6 px-2 text-center text-sm font-medium text-white"
            >
                <v-icon name="md-star-outlined" scale=".8"></v-icon>
                <span class="">{{ Math.floor(Math.random() * 5) }}</span>
            </span>
        </a>
        <div class="mt-4 px-5 pb-5">
            <a href="/product/1">
                <h5
                    class="text-xl ltr:tracking-wider text-slate-900 rtl:text-right ltr:text-2xl ltr:font-bold"
                >
                    {{ props.product.name }}
                </h5>
            </a>
            <div class="mt-2 mb-5">
                <p class="flex ltr:flex-row-reverse items-end gap-2">
                    <span
                        class="text-2xl font-bold text-slate-900 ltr:text-right"
                        >{{ props.product.price }}$</span
                    >
                    <span class="text-sm text-meta-1 line-through font-semibold"
                        >{{ Math.floor(Math.random() * 200) }}$</span
                    >
                </p>
            </div>
            <a
                href="#"
                class="flex rtl:flex-row-reverse gap-2 items-center justify-center rounded-md bg-slate-900 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300"
            >
                <v-icon name="md-shoppingcart-outlined"></v-icon>
                {{ $t("titles.web.products.addtocart") }}
            </a>
        </div>
    </div>
</template>
