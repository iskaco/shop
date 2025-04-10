<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps(["category"]);

const getImage = function () {
    if (props.category.image) return route("shop.media", props.category.image);
};
</script>
<template>
    <div
        style="direction: ltr"
        class="relative p-3 flex w-full flex-col overflow-hidden rounded-lg border border-gray-100 bg-white shadow-md ltr:"
    >
        <Link
            class="relative flex h-60 overflow-hidden rounded-xl"
            :href="props.category.links.self"
        >
            <img
                class="w-full object-cover"
                :src="getImage()"
                alt="product image"
            />
            <div
                class="absolute inset-0 bg-gradient-to-t from-black-2 to-transparent opacity-50"
            ></div>
            <span
                class="absolute flex gap-1 justify-center items-center bottom-0 inset-x-0 m-2 rounded-full text-2xl font-medium text-white"
            >
                {{ props.category.name }}
            </span>
        </Link>
    </div>
</template>
