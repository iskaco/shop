<script setup>
import BackButton from "../Forms/BackButton.vue";
import { useCartStore } from "@/Composables/useCart.js";
import { onMounted, reactive, ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const { cart } = useCartStore();

const props = defineProps(["address"]);
const newAddress = ref("");
const form = useForm({ items: [], selectedAddress: "" });

const CheckoutCart = function () {
    form.post(route("shop.order.store"));
};

onMounted(() => {
    let cartItems = [];
    cart.forEach((element) => {
        let cartItem = {};
        cartItem["product_id"] = element.id;
        cartItem["quantity"] = element.quantity;
        cartItems.push(cartItem);
    });

    form.items = cartItems;
});
</script>
<template>
    <section class="px-10 md:px-20 py-16">
        <div class="flex flex-col gap-10 w-full">
            <h2
                class="mb-6 lg:text-6xl md:text-5xl text-4xl font-bold text-center"
            >
                {{ $t("titles.web.cart.orderInfoTitle") }}
            </h2>
            <label v-if="props.address" class="cursor-pointer">
                <div
                    class="flex divide-x rtl:divide-x-reverse border rounded-xl bg-gray-50"
                >
                    <div class="w-14 h-28 grid place-content-center">
                        <input
                            type="radio"
                            name="address"
                            :value="props.address"
                            v-model="form.selectedAddress"
                        />
                    </div>
                    <div
                        class="flex flex-col md:flex-row gap-x-5 justify-center md:items-center px-5"
                    >
                        <span class="text-sm">{{
                            $t("titles.web.cart.profileAddress")
                        }}</span>
                        <span class="font-medium text-boxdark-2">{{
                            props.address
                        }}</span>
                    </div>
                </div>
            </label>
            <label class="flex-1 cursor-pointer">
                <div
                    class="flex divide-x rtl:divide-x-reverse border rounded-xl bg-gray-50"
                >
                    <div class="w-14 h-28 grid place-content-center">
                        <input
                            type="radio"
                            v-model="form.selectedAddress"
                            :value="newAddress"
                        />
                    </div>
                    <div
                        class="flex-1 flex flex-col md:flex-row gap-x-5 justify-center md:items-center px-5"
                    >
                        <span class="text-sm pt-2 md:pt-0">{{
                            $t("titles.web.cart.newAddress")
                        }}</span>
                        <span class="flex-1 font-medium text-boxdark-2 md:pt-5">
                            <input
                                class="w-full rounded-md border-stroke"
                                type="text"
                                v-model="newAddress"
                                @focus="form.selectedAddress = newAddress"
                                @input="form.selectedAddress = newAddress"
                            />
                            <p
                                class="text-meta-1 text-xs font-normal mt-1 mx-2"
                            >
                                {{
                                    $t("titles.web.cart.newAddressPlaceHolder")
                                }}
                            </p>
                        </span>
                    </div>
                </div>
            </label>
            <div class="flex justify-end gap-3">
                <button
                    @click="CheckoutCart()"
                    class="px-10 py-2 bg-blue-600 text-white rounded"
                >
                    {{ $t("titles.web.cart.checkout") }}
                </button>
                <BackButton :label="$t('titles.web.cart.back')"></BackButton>
            </div>
        </div>
    </section>
</template>
