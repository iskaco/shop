<script setup>
import BackButton from "../Forms/BackButton.vue";
import { useCartStore } from "@/Composables/useCart.js";
import { onMounted, reactive, ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const { cart } = useCartStore();

const props = defineProps(["address"]);
const newAddress = ref("");
const form = useForm({ items: [], address: "" });

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
    <section class="px-10 py-16 md:px-20">
        <div class="flex flex-col w-full gap-10">
            <h2
                class="mb-6 text-4xl font-bold text-center lg:text-6xl md:text-5xl"
            >
                {{ $t("titles.web.cart.orderInfoTitle") }}
            </h2>
            <label v-if="props.address" class="cursor-pointer">
                <div
                    class="flex border divide-x rtl:divide-x-reverse rounded-xl bg-gray-50"
                >
                    <div class="grid w-14 h-28 place-content-center">
                        <input
                            type="radio"
                            name="address"
                            :value="props.address"
                            :checked="props.address"
                            v-model="form.address"
                        />
                    </div>
                    <div
                        class="flex flex-col justify-center px-5 md:flex-row gap-x-5 md:items-center"
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
                    class="flex border divide-x rtl:divide-x-reverse rounded-xl bg-gray-50"
                >
                    <div class="grid w-14 h-28 place-content-center">
                        <input
                            type="radio"
                            v-model="form.address"
                            :value="newAddress"
                            :checked="!props.address"
                        />
                    </div>
                    <div
                        class="flex flex-col justify-center flex-1 px-5 md:flex-row gap-x-5 md:items-center"
                    >
                        <span class="pt-2 text-sm md:pt-0">{{
                            $t("titles.web.cart.newAddress")
                        }}</span>
                        <span class="flex-1 font-medium text-boxdark-2 md:pt-5">
                            <input
                                class="w-full rounded-md border-stroke"
                                type="text"
                                v-model="newAddress"
                                @focus="form.address = newAddress"
                                @input="form.address = newAddress"
                            />
                            <p
                                class="mx-2 mt-1 text-xs font-normal text-meta-1"
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
                    class="px-10 py-2 text-white bg-blue-600 rounded"
                >
                    {{ $t("titles.web.cart.checkout") }}
                </button>
                <BackButton :label="$t('titles.web.cart.back')"></BackButton>
            </div>
        </div>
    </section>
</template>
