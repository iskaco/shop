<script setup>
import { useSidebarStore } from "@/stores/sidebar";
import SidebarDropdown from "./SidebarDropdown.vue";
import { Link } from "@inertiajs/vue3";

const sidebarStore = useSidebarStore();

const props = defineProps(["item", "index"]);

const handleItemClick = () => {
    const pageName =
        sidebarStore.page === props.item.label ? "" : props.item.label;
    sidebarStore.page = pageName;

    if (props.item.children) {
        return props.item.children.some(
            (child) => sidebarStore.selected === child.label
        );
    }
};
</script>

<template>
    <li>
        <Link
            v-if="item.route"
            :href="route('admin.' + item.route)"
            class="cursor-pointer group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
            :class="[
                sidebarStore.page === item.label
                    ? 'bg-graydark dark:bg-meta-4'
                    : '',
            ]"
            @click.prevent="handleItemClick"
        >
            <v-icon :name="item.iconName" scale="1.2" />

            {{ $t(item.label) }}
        </Link>
        <div
            v-else
            class="cursor-pointer group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
            :class="[
                sidebarStore.page === item.label
                    ? 'bg-graydark dark:bg-meta-4'
                    : '',
            ]"
            @click.prevent="handleItemClick"
        >
            <v-icon :name="item.iconName" scale="1.2" />

            {{ $t(item.label) }}

            <v-icon
                name="md-keyboardarrowdown-outlined"
                class="absolute ltr:right-4 rtl:left-4 top-1/2 -translate-y-1/2 fill-current"
                :class="{ 'rotate-180': sidebarStore.page === item.label }"
            ></v-icon>
        </div>

        <!-- Dropdown Menu Start -->
        <div
            class="translate transform overflow-hidden"
            v-show="sidebarStore.page === item.label"
        >
            <SidebarDropdown
                v-if="item.children"
                :items="item.children"
                :currentPage="currentPage"
                :page="item.label"
            />
            <!-- Dropdown Menu End -->
        </div>
    </li>
</template>
