<script setup>
import { useCartStore } from "@/Composables/useCart.js";
import { Link, useForm } from "@inertiajs/vue3";

const {
    cart,
    removeFromCart,
    updateQuantity,
    cartTotal,
    cartItemCount,
    clearCart,
} = useCartStore();

const getImage = function (image) {
    if (image) return route("shop.media", image);
};
</script>
<template>
    <section class="py-20 bg-white md:px-20 px-5">
        <div class="px-4 mx-auto">
            <h2
                class="mb-16 lg:text-6xl md:text-5xl text-4xl font-bold text-center"
            >
                {{ $t("titles.web.cart.title") }}
            </h2>
            <div class="flex flex-col">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    {{ $t("titles.web.cart.product") }}
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    {{ $t("titles.web.cart.quantity") }}
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    {{ $t("titles.web.cart.price") }}
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    {{ $t("titles.web.cart.total") }}
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">{{
                                        $t("titles.web.cart.remove")
                                    }}</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="item in cart" :key="item.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <img
                                            :src="getImage(item.image)"
                                            :alt="item.name"
                                            class="h-16 w-16 object-cover rounded"
                                        />
                                        <div class="ml-4">
                                            <div
                                                class="text-sm font-medium text-gray-900"
                                            >
                                                {{ item.name }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ item.description }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input
                                        type="number"
                                        class="w-16 border border-gray-300 rounded"
                                        :value="item.quantity ?? 1"
                                        @input="
                                            updateQuantity(
                                                item.id,
                                                $event.target.value
                                            )
                                        "
                                    />
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                >
                                    {{ item.price }}
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                >
                                    {{ (item.quantity ?? 1) * item.price }}
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                                >
                                    <button
                                        @click="removeFromCart(item.id)"
                                        class="text-red-600 hover:text-red-900"
                                    >
                                        {{ $t("titles.web.cart.remove") }}
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 flex justify-between">
                    <div class="text-lg font-bold">
                        {{ $t("titles.web.cart.grandTotal") }}:
                        {{ cartTotal }}
                    </div>
                    <Link
                        :href="route('shop.cart.info')"
                        class="px-4 py-2 bg-blue-600 text-white rounded"
                    >
                        {{ $t("titles.web.cart.next") }}
                    </Link>
                </div>
            </div>
        </div>
    </section>
</template>
