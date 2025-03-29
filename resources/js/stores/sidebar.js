import { useStorage } from "@vueuse/core";
import { defineStore } from "pinia";
import { ref } from "vue";

export const useSidebarStore = defineStore("sidebar", () => {
    const isSidebarOpen = ref(false);
    const selected = useStorage("selected", ref("eCommerce"));
    const page = useStorage("page", ref("Dashboard"));

    function toggleSidebar() {
        console.log(isSidebarOpen.value);
        isSidebarOpen.value = !isSidebarOpen.value;
        console.log(isSidebarOpen.value);
    }

    return { isSidebarOpen, toggleSidebar, selected, page };
});
