<script setup>
import { toast } from "vue3-toastify";
import { useI18n } from "vue-i18n";
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";

import { useCartStore } from "@/Composables/useCart.js";

const props = defineProps(["product"]);

const { t, locale } = useI18n();

const getImage = function () {
    return route("shop.media", props.product.image);
};

const { addToCart, cart } = useCartStore();

const isInCart = computed(() => {
    return cart.some((item) => item.id === props.product.id);
});

const AddToCart = function (product) {
    toast.success(
        `
        <div class='!whitespace-normal'>
            <div class='text-center pb-2 border-b border-meta-3 text-meta-3 font-semibold'>${t(
                "titles.web.cart.successfullyAddToCart"
            )}</div>
            <div class='flex flex-row ltr:flex-row-reverse items-center h-28'>
                <img src="${getImage()}" class='w-24 h-24 object-cover m-2 rounded' />
                <div class='flex flex-col justify-around h-full'>
                    <h5 class='text-lg font-bold text-black ltr:text-left trl:text-right'>${
                        props.product.name
                    }</h5>
                    <span class='text-base text-gray-500'>${
                        props.product.price
                    }$</span>
                </div>
            </div>
                <button @click='' class='w-full rounded bg-meta-3 text-white mt-4 py-2 z-999999'>${t(
                    "titles.web.cart.goToCart"
                )}
                </button>
        </div>
    `,
        {
            dangerouslyHTMLString: true,
            autoClose: false,
            position: "bottom-center",
        }
    );
};
</script>
<template>
    <div
        style="direction: ltr"
        class="relative flex w-full flex-col overflow-hidden rounded-lg border border-gray-100 bg-white"
    >
        <Link
            class="relative mx-3 mt-3 flex h-60 overflow-hidden rounded-xl"
            :href="route('shop.product.show', [props.product.slug])"
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
        </Link>
        <div class="mt-4 px-5">
            <Link :href="route('shop.product.show', [props.product.slug])">
                <h5
                    :title="props.product.name"
                    style="max-width: 90%; display: inline-block"
                    class="truncate text-xl ltr:tracking-wider text-slate-900 rtl:text-right"
                >
                    {{ props.product.name }}
                </h5>
            </Link>
            <div class="mt-2 mb-5">
                <p class="flex rtl:flex-row-reverse items-center gap-2">
                    <span
                        class="text-2xl font-bold text-slate-900 ltr:text-right pt-1"
                        >{{ props.product.price }}$</span
                    >
                    <span
                        class="text-xs text-meta-1 font-semibold border-meta-1 border rounded p-1 pt-2"
                        >-{{ Math.floor(Math.random() * 100) }}%</span
                    >
                </p>
                <span
                    class="text-sm text-bodydark font-semibold line-through p-1 pt-2"
                    >-{{ Math.floor(Math.random() * 100) }}%</span
                >
            </div>
        </div>
        <div class="flex justify-between items-center px-5 pb-5">
            <span
                class="bg-meta-1 rounded-l-full rounded-br-full px-2 tesxt-xs text-white"
            >
                <v-icon name="la-cube-solid"></v-icon>
                express
            </span>

            <button
                @click="addToCart(props.product)"
                class="flex rtl:flex-row-reverse gap-2 items-center justify-center rounded-md border shadow-md px-3 py-2 text-center text-xs font-medium text-black-2 hover:bg-cyan-500"
            >
                <v-icon
                    v-if="!isInCart"
                    name="la-cart-plus-solid"
                    :scale="1.5"
                ></v-icon>
                <v-icon
                    v-else
                    name="la-cart-arrow-down-solid"
                    :scale="1.5"
                ></v-icon>
            </button>
        </div>
    </div>
</template>
