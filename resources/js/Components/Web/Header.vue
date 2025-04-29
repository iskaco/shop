<script setup>
import { useSidebarStore } from "@/stores/sidebar";
import LanguageSwitcher from "@/Components/Header/LanguageSwitcher.vue";
import CurrencySwitcher from "@/Components/Web/CurrencySwitcher.vue";
import { onClickOutside } from "@vueuse/core";
import { useTemplateRef, ref } from "vue";
import { useCartStore } from "@/Composables/useCart.js";
import { Link, usePage } from "@inertiajs/vue3";

const props = defineProps({
    menuBg: { type: String, default: "bg-transparent" },
});

const { cart } = useCartStore();

const { toggleSidebar } = useSidebarStore();
const sidebarStore = useSidebarStore();

const target = useTemplateRef("target");
onClickOutside(target, () => (sidebarStore.isSidebarOpen = false));

const menuItems = ref([
    {
        label: "titles.web.navigation.home",
        route: "/",
        iconName: "md-home-outlined",
    },
    {
        label: "titles.web.navigation.categories",
        route: route("shop.category.index"),
        iconName: "md-category-outlined",
    },
    {
        label: "titles.web.navigation.contact",
        route: route("shop.contactus.show"),
        iconName: "md-contact-outlined",
    },
    {
        label: "titles.web.navigation.about",
        route: route("shop.aboutus.show"),
        iconName: "md-info-outlined",
    },
]);
</script>

<template>
    <div class="bg-gray-50 px-5 py-2 md:px-30 pb-10">
        <div class="flex flex-col space-y-5">
            <div class="flex flex-row justify-between">
                <div>
                    <Link :href="route('home')">
                        <img
                            src="/images/logo.png"
                            alt="Logo"
                            class="w-auto h-24"
                        />
                    </Link>
                </div>
                <div
                    class="items-center hidden gap-x-8 ltr:font-semibold md:flex"
                >
                    <Link
                        v-for="menu in menuItems"
                        :key="menu.label"
                        :href="menu.route"
                        class="text-cyan-500 hover:text-cyan-600 ltr:tracking-widest"
                        >{{ $t(menu.label) }}</Link
                    >
                </div>
                <div class="md:flex items-center gap-x-4 hidden">
                    <LanguageSwitcher />

                    <CurrencySwitcher />
                </div>
                <div
                    class="flex flex-row-reverse gap-4 md:hidden text-bodydark font-extralight items-center"
                >
                    <button class="text-white" @click="toggleSidebar">
                        <v-icon
                            name="la-bars-solid"
                            :scale="1.5"
                            class="fill-cyan-500"
                        ></v-icon>
                    </button>
                    <div class="flex gap-4">
                        <Link
                            :href="route('shop.cart.show')"
                            class="relative hover:text-cyan-700"
                        >
                            <v-icon
                                name="la-shopping-cart-solid"
                                :scale="1.5"
                                class="fill-cyan-500"
                            ></v-icon>
                            <span
                                v-if="cart.length"
                                class="absolute grid place-content-center bg-meta-1 text-white rounded-full text-[9px] w-4 h-4 top-0 left-4"
                                >{{ cart.length }}</span
                            >
                        </Link>

                        <Link href="#" class="hover:text-cyan-700">
                            <v-icon
                                name="la-heart"
                                :scale="1.5"
                                class="fill-cyan-500"
                            ></v-icon>
                        </Link>

                        <Link
                            :href="
                                usePage().props.auth.customer
                                    ? route('shop.customer.profile')
                                    : route('shop.signin')
                            "
                            class="hover:text-cyan-700"
                        >
                            <img
                                v-if="usePage().props.auth.customer"
                                class="w-6 h-6 rounded-full outline outline-meta-6"
                                src="/images/person.jpeg"
                            />
                            <v-icon
                                v-else
                                name="la-user"
                                :scale="1.5"
                                class="fill-cyan-500"
                            ></v-icon>
                        </Link>
                    </div>
                </div>
            </div>
            <div
                class="w-full flex flex-row justify-between items-center gap-5 md:px-20"
            >
                <div
                    class="flex-1 flex border-cyan-500 border-4 rounded-md overflow-hidden"
                >
                    <input
                        type="text"
                        :placeholder="
                            $t('titles.web.navigation.search_placeholder')
                        "
                        class="flex-1 border-0 placeholder-bodydark placeholder:font-thin"
                    />
                    <button class="bg-cyan-500 px-10 text-white">
                        {{ $t("titles.web.navigation.search") }}
                    </button>
                </div>
                <div
                    class="hidden md:flex flex-row-reverse gap-5 text-bodydark font-extralight"
                >
                    <Link
                        :href="route('shop.cart.show')"
                        class="relative hover:text-cyan-700 space-x-1"
                    >
                        <v-icon
                            name="la-shopping-cart-solid"
                            :scale="2"
                            class="fill-cyan-500"
                        ></v-icon>
                        <span>{{ $t("titles.web.navigation.cart") }}</span>
                        <span
                            v-if="cart.length"
                            class="absolute grid place-content-center bg-meta-1 text-white rounded-full text-[9px] w-4 h-4 top-1 ltr:left-5 rtl:right-0"
                            >{{ cart.length }}</span
                        >
                    </Link>

                    <Link href="#" class="hover:text-cyan-700 space-x-1">
                        <v-icon
                            name="la-heart"
                            :scale="2"
                            class="fill-cyan-500"
                        ></v-icon>
                        <span>{{ $t("titles.web.navigation.favorite") }}</span>
                    </Link>

                    <Link
                        :href="
                            usePage().props.auth.customer
                                ? route('shop.customer.profile')
                                : route('shop.signin')
                        "
                        class="hover:text-cyan-700 space-x-1"
                    >
                        <img
                            v-if="usePage().props.auth.customer"
                            class="w-6 h-6 rounded-full outline outline-meta-6"
                            src="/images/person.jpeg"
                        />
                        <v-icon
                            v-else
                            name="la-user"
                            :scale="2"
                            class="fill-cyan-500"
                        ></v-icon>
                        <span>{{ $t("titles.web.navigation.account") }}</span>
                    </Link>
                </div>
            </div>
        </div>
    </div>

    <aside
        class="fixed ltr:left-0 rtl:right-0 top-0 z-9999 flex h-screen w-72.5 flex-col overflow-y-auto bg-black duration-300 ease-linear dark:bg-boxdark lg:hidden sm:ltr:translate-x-0"
        :class="{
            'ltr:translate-x-0 rtl:translate-x-0 flex':
                sidebarStore.isSidebarOpen,
            'ltr:-translate-x-full rtl:translate-x-full hidden':
                !sidebarStore.isSidebarOpen,
        }"
        ref="target"
    >
        <!-- SIDEBAR HEADER -->
        <div
            class="flex items-center justify-between gap-2 px-6 py-5.5 lg:py-5.5"
        >
            <Link href="/" class="flex flex-row gap-2">
                <img src="/images/logo.png" alt="Logo" class="w-14 h-10" />
                <div class="flex flex-col">
                    <span class="font-black text-sky-700">
                        {{ $t("titles.web.label") }}
                    </span>
                    <span class="text-xs">
                        {{ $t("titles.web.description") }}
                    </span>
                </div>
            </Link>

            <button
                class="block lg:hidden"
                @click="sidebarStore.isSidebarOpen = false"
            >
                <v-icon name="md-clear-outlined"></v-icon>
            </button>
        </div>
        <!-- SIDEBAR HEADER -->

        <div
            class="flex-1 flex flex-col justify-between pb-5 overflow-y-auto duration-300 ease-linear no-scrollbar"
        >
            <div
                class="flex justify-between mx-4 px-2 bg-boxdark py-2 rounded-md"
            >
                <LanguageSwitcher />
                <CurrencySwitcher />
            </div>
            <!-- Sidebar Menu -->
            <nav class="flex-1 px-4 py-4 lg:px-6">
                <div>
                    <a
                        v-for="menu in menuItems"
                        :key="menu.label"
                        :href="menu.route"
                        class="text-white hover:text-gray-300 hover:bg-gray-700 py-2 px-4 rounded block mb-4"
                    >
                        <v-icon :name="menu.iconName"></v-icon>
                        {{ $t(menu.label) }}
                    </a>
                </div>
            </nav>

            <!-- Sidebar Menu -->
        </div>
    </aside>
</template>
