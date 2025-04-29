<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { useCartStore } from "@/Composables/useCart.js";
import { onMounted } from "vue";
const props = defineProps(["orders"]);

const { clearCart } = useCartStore();

const getImage = function (image) {
    if (image) return route("shop.media", image);
    return false;
};

onMounted(() => {
    if (usePage().props.flash.toasts) clearCart();
});
</script>
<template>
    <div class="px-10 md:px-20">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th
                            class="px-6 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Order ID
                        </th>
                        <th
                            class="px-6 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Order Date
                        </th>
                        <th
                            class="px-6 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Order Status
                        </th>
                        <th
                            class="px-6 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Payment Method
                        </th>
                        <th
                            class="px-6 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Total
                        </th>
                        <th
                            class="px-6 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Order Image
                        </th>
                        <th
                            class="px-6 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="order in props.orders">
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            #12345
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            2023-10-01
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            {{ order[0].status }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            {{ order[0].payment_method }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            {{ order[0].total }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex -space-x-6 justify-center">
                                <img
                                    v-for="item in order[0].items"
                                    :key="item.product.id"
                                    :src="getImage(item.product.image)"
                                    alt="Order Image"
                                    class="h-10 w-10 object-cover inline-block rounded-full"
                                />
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex gap-2 w-full justify-center">
                                <v-icon
                                    name="la-eye"
                                    class="fill-meta-5 cursor-pointer"
                                ></v-icon>
                                <v-icon
                                    name="la-trash-alt"
                                    class="fill-meta-1 cursor-pointer"
                                ></v-icon>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
