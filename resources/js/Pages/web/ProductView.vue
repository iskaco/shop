<script setup>
import WebLayout from "@/Layouts/WebLayout.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { startsWith } from "lodash";
import { computed, ref, watch } from "vue";
import { useCartStore } from "@/Composables/useCart.js";

const props = defineProps(["product"]);

const getImage = function (image) {
    return route("shop.media", image);
};

const form = useForm({
    product_id: props.product.data.id,
    attributes: [],
});

const variant = ref({});

const fetchUpdatedPrice = () => {
    form.attributes = Object.values(variant.value);

    form.post(
        route("shop.product.variant.find", { product: props.product.data.id }),
        {
            preserveScroll: true,
            onSuccess: (response) => {
                console.log(response);
            },
            onError: (errors) => {
                console.error("Error fetching price:", errors);
            },
        }
    );
};

watch(
    () => variant.value,
    () => {
        fetchUpdatedPrice();
    },
    { deep: true }
);

const updateAttributes = (attribute_id, attribute_value_id) => {
    variant.value = {
        ...variant.value,
        [attribute_id]: attribute_value_id,
    };
};

const quantity = ref(1);
const { addToCart, cart } = useCartStore();

const isInCart = computed(() => {
    return cart.some((item) => item.id === props.product.id);
});

const orderItem = computed(() => {
    return cart.find((item) => item.id === props.product.data.id);
});
</script>
<template>
    <WebLayout menuBg="bg-[url(/images/menubg.jpg)] bg-center">
        <div class="mx-auto md:px-20 px-10 my-20">
            <!-- Product Details Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Product Images -->
                <div class="space-y-4">
                    <div
                        class="aspect-square bg-gray-100 rounded-lg overflow-hidden"
                    >
                        <img
                            ref="previewImage"
                            :src="getImage(props.product.data.image)"
                            :alt="props.product.data.name"
                            class="w-full h-full object-cover"
                        />
                    </div>
                    <div class="grid grid-cols-4 gap-4">
                        <div
                            class="aspect-square bg-gray-100 rounded-lg overflow-hidden cursor-pointer"
                        >
                            <img
                                ref="mainImage"
                                :src="getImage(props.product.data.image)"
                                :alt="props.product.data.name"
                                class="w-full h-full object-cover"
                                @click="
                                    $refs.previewImage.src = $event.target.src
                                "
                            />
                        </div>
                        <div
                            v-for="(image, index) in props.product.data.gallery"
                            :key="index"
                            class="aspect-square bg-gray-100 rounded-lg overflow-hidden cursor-pointer"
                        >
                            <img
                                :src="getImage(image)"
                                :alt="props.product.data.name"
                                class="w-full h-full object-cover"
                                @click="
                                    $refs.previewImage.src = $event.target.src
                                "
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

                    <!-- Price & Add to Cart -->
                    <div
                        class="flex flex-col gap-5 bg-gray-50 p-4 rounded-lg border"
                    >
                        <div
                            v-for="(attribute, index) in props.product.data
                                .attributes"
                            :key="index"
                            class="flex gap-5 items-center"
                        >
                            <span class="text-body w-fit">{{ index }}: </span>
                            <span
                                v-for="attribute_value in attribute"
                                :key="attribute_value.id"
                            >
                                <label>
                                    <input
                                        type="radio"
                                        :value="attribute_value.id"
                                        :name="index"
                                        class="hidden peer"
                                        @change="
                                            updateAttributes(
                                                index,
                                                attribute_value.id
                                            )
                                        "
                                    />
                                    <div
                                        v-if="
                                            attribute_value.code &&
                                            attribute_value.code.startsWith('#')
                                        "
                                        class="peer-checked:outline-meta-6 peer-checked:outline-4 peer-checked:outline-offset-0 w-7 h-7 cursor-pointer rounded-full outline outline-1 outline-offset-4 outline-body"
                                        :style="`background-color:${attribute_value.code}`"
                                    ></div>
                                    <div
                                        v-else
                                        class="text-sm peer-checked:bg-yellow-300 peer-checked:text-black flex items-center justify-center px-2 pt-1 cursor-pointer rounded-md bg-gray-100"
                                    >
                                        {{
                                            attribute_value.code ??
                                            attribute_value.name
                                        }}
                                    </div>
                                </label>
                            </span>
                        </div>
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex gap-10">
                                <span class="text-body"
                                    >{{
                                        $t("titles.web.products.price")
                                    }}:</span
                                >
                                <div class="text-boxdark-2 text-xl font-bold">
                                    {{ props.product.data.price }}
                                    {{ $t("titles.web.products.currency") }}
                                </div>
                                <div class="text-body line-through">
                                    {{ props.product.data.price }}
                                    {{ $t("titles.web.products.currency") }}
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button
                                    @click="quantity--"
                                    class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-200 hover:bg-gray-300"
                                >
                                    <v-icon
                                        name="md-remove"
                                        scale="0.8"
                                    ></v-icon>
                                </button>
                                <input
                                    type="number"
                                    v-model="quantity"
                                    min="1"
                                    class="w-16 text-center border rounded-md py-1"
                                />
                                <button
                                    @click="quantity++"
                                    class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-200 hover:bg-gray-300"
                                >
                                    <v-icon name="md-add" scale="0.8"></v-icon>
                                </button>
                            </div>
                        </div>
                        <button
                            @click="addToCart(props.product.data, quantity)"
                            class="w-full flex rtl:flex-row-reverse gap-2 items-center justify-center rounded-md bg-slate-900 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300"
                        >
                            <v-icon name="md-shoppingcart-outlined"></v-icon>
                            {{
                                isInCart
                                    ? $t("titles.web.products.isInCart")
                                    : $t("titles.web.products.addtocart")
                            }}
                            {{ props.product.id }}
                            <span
                                v-if="orderItem"
                                class="grid place-content-center bg-meta-1 rounded-full w-5 h-5 text-xs pt-1"
                                >{{ orderItem.quantity }}</span
                            >
                        </button>
                    </div>

                    <!-- Seller Info -->
                    <div
                        v-if="props.product.data.vendor"
                        class="flex items-center gap-2 bg-gray-50 p-4 rounded-lg"
                    >
                        <v-icon name="la-cubes-solid" :scale="2"></v-icon>
                        <span class="text-body">
                            {{ $t("titles.web.products.seller") }}
                        </span>
                        <div class="text-boxdark-2 font-medium">
                            <span>{{ props.product.data.vendor }}</span>
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
