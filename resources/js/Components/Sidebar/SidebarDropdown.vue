<script setup>
import { useSidebarStore } from "@/stores/sidebar";
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";

const sidebarStore = useSidebarStore();

const props = defineProps(["items", "page"]);
const items = ref(props.items);

const handleItemClick = (index) => {
    const pageName =
        sidebarStore.selected === props.items[index].label
            ? ""
            : props.items[index].label;
    sidebarStore.selected = pageName;
};
</script>

<template>
    <ul class="mt-4 mb-5.5 flex flex-col gap-2.5 pr-6">
        <template v-for="(childItem, index) in items" :key="index">
            <li>
                <Link
                    :href="route('admin.' + childItem.route)"
                    @click="handleItemClick(index)"
                    class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                    :class="{
                        '!text-white':
                            childItem.label === sidebarStore.selected,
                    }"
                >
                    {{ $t(childItem.label) }}
                </Link>
            </li>
        </template>
    </ul>
</template>
