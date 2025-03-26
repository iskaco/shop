<script setup>
import { useSidebarStore } from "@/stores/sidebar";
import { onClickOutside } from "@vueuse/core";
import { ref } from "vue";
import SidebarItem from "./SidebarItem.vue";
import { Link } from "@inertiajs/vue3";

const target = ref(null);

const sidebarStore = useSidebarStore();

onClickOutside(target, () => {
    sidebarStore.isSidebarOpen = false;
});

const menuGroups = ref([
    {
        name: "منو",
        menuItems: [
            {
                label: "داشبورد",
                route: "dashboard",
                iconName: "md-dashboardcustomize-outlined",
            },
            {
                label: "مدیران",
                route: "admins",
                iconName: "md-contacts-outlined",
            },
            {
                label: "دسته بندی محصولات",
                route: "dashboard",
                iconName: "md-category-outlined",
            },
            {
                label: "محصولات",
                route: "products",
                iconName: "md-creditcard-outlined",
            },
            {
                label: "سفارشات",
                route: "dashboard",
                iconName: "md-dns-outlined",
            },
        ],
    },
]);
</script>

<template>
    <aside
        class="absolute left-0 top-0 z-9999 flex h-screen w-72.5 flex-col overflow-y-hidden bg-black duration-300 ease-linear dark:bg-boxdark lg:static lg:translate-x-0"
        :class="{
            'translate-x-0': sidebarStore.isSidebarOpen,
            '-translate-x-full': !sidebarStore.isSidebarOpen,
        }"
        ref="target"
    >
        <!-- SIDEBAR HEADER -->
        <div
            class="flexitems-center justify-between gap-2 px-6 py-5.5 lg:py-5.5"
        >
            <Link :href="route('admin.dashboard')" class="flex flex-row gap-2">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="40"
                    height="40"
                    viewBox="0 0 48 48"
                    class="text-black rounded bg-lime-400"
                >
                    <path
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M19.408 4.5h9.184l6.664 7.094l.621 11.236l-4.916 7.778l-1.351 3.925v6.824L24 43.5l-5.61-2.143v-6.824l-1.35-3.925l-4.917-7.778l.62-11.235Zm0 0v8.256m-6.664-1.162l6.663 1.162M12.122 22.83l7.285-10.074M28.593 4.5l-9.185 8.256M28.593 4.5l2.764 13.36m3.899-6.266l-3.899 6.266m4.521 4.97l-4.52-4.97m-.398 12.748l.397-12.748m-11.949-5.104l11.949 5.104"
                    />
                    <path
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m12.122 22.83l10.842 1.819l7.997 5.96m.396-12.749l-8.393 6.788m-3.556-11.892l3.556 11.892m-5.924 5.96l5.925-5.96"
                    />
                    <path
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m22.964 24.648l-4.574 9.885l12.571-3.925M18.39 34.533h11.22"
                    />
                </svg>
                <div class="flex flex-col">
                    <span class="font-black text-lime-400"> آیسپ </span>
                    <span class="text-xs"> ادمین پنل هوشمند ایسکا </span>
                </div>
            </Link>

            <button
                class="block lg:hidden"
                @click="sidebarStore.isSidebarOpen = false"
            >
                <svg
                    class="fill-current"
                    width="20"
                    height="18"
                    viewBox="0 0 20 18"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M19 8.175H2.98748L9.36248 1.6875C9.69998 1.35 9.69998 0.825 9.36248 0.4875C9.02498 0.15 8.49998 0.15 8.16248 0.4875L0.399976 8.3625C0.0624756 8.7 0.0624756 9.225 0.399976 9.5625L8.16248 17.4375C8.31248 17.5875 8.53748 17.7 8.76248 17.7C8.98748 17.7 9.17498 17.625 9.36248 17.475C9.69998 17.1375 9.69998 16.6125 9.36248 16.275L3.02498 9.8625H19C19.45 9.8625 19.825 9.4875 19.825 9.0375C19.825 8.55 19.45 8.175 19 8.175Z"
                        fill=""
                    />
                </svg>
            </button>
        </div>
        <!-- SIDEBAR HEADER -->

        <div
            class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar"
        >
            <!-- Sidebar Menu -->
            <nav class="px-4 py-4 mt-5 lg:mt-9 lg:px-6">
                <template v-for="menuGroup in menuGroups" :key="menuGroup.name">
                    <div>
                        <h3
                            class="mb-4 ml-4 text-sm font-medium text-bodydark2"
                        >
                            {{ menuGroup.name }}
                        </h3>

                        <ul class="mb-6 flex flex-col gap-1.5">
                            <SidebarItem
                                v-for="(menuItem, index) in menuGroup.menuItems"
                                :item="menuItem"
                                :key="index"
                                :index="index"
                            />
                        </ul>
                    </div>
                </template>
            </nav>
            <!-- Sidebar Menu -->
        </div>
    </aside>
</template>
