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
        label: "titles.web.navigation.products",
        route: "/",
        iconName: "md-shoppingcart-outlined",
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
    <nav class="absolute z-30 w-full" :class="menuBg">
        <div class="container px-4 py-4 mx-auto">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <img
                        src="/images/logo.png"
                        alt="Logo"
                        class="w-auto h-20"
                    />
                </div>
                <div
                    class="items-center hidden gap-x-8 ltr:font-semibold md:flex"
                >
                    <Link
                        v-for="menu in menuItems"
                        :key="menu.label"
                        :href="menu.route"
                        class="text-white hover:text-gray-300 ltr:tracking-widest"
                        >{{ $t(menu.label) }}</Link
                    >

                    <div class="flex items-center gap-x-4">
                        <LanguageSwitcher />

                        <CurrencySwitcher />

                        <Link
                            :href="route('shop.cart.show')"
                            class="relative text-white hover:text-gray-300"
                        >
                            <v-icon name="md-shoppingcart-outlined"></v-icon>
                            <span
                                v-if="cart.length"
                                class="absolute grid place-content-center bg-meta-1 rounded-sm text-[9px] w-4 h-4 -top-2 -right-2"
                                >{{ cart.length }}</span
                            >
                        </Link>

                        <Link href="#" class="text-white hover:text-gray-300">
                            <v-icon name="md-favoriteborder-outlined"></v-icon>
                        </Link>

                        <Link
                            :href="
                                usePage().props.auth.customer
                                    ? route('shop.customer.profile')
                                    : route('shop.signin')
                            "
                            class="text-white hover:text-gray-300"
                        >
                            <img
                                v-if="usePage().props.auth.customer"
                                class="w-6 h-6 rounded-full outline outline-meta-6"
                                src="/images/person.jpeg"
                            />
                            <v-icon
                                v-else
                                name="md-personoutline-outlined"
                            ></v-icon>
                        </Link>
                    </div>
                </div>
                <div class="flex flex-row-reverse gap-2 md:hidden">
                    <button class="text-white" @click="toggleSidebar">
                        <v-icon name="md-menu-outlined"></v-icon>
                    </button>

                    <LanguageSwitcher />

                    <CurrencySwitcher />
                </div>
            </div>
        </div>
    </nav>
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
            class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar"
        >
            <!-- Sidebar Menu -->
            <nav class="px-4 py-4 lg:px-6">
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
