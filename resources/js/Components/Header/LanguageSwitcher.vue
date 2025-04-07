<script setup>
import { useI18n } from "vue-i18n";
import { loadLanguageMessages } from "@/i18n";
import { onMounted, ref } from "vue";
import { router, usePage } from "@inertiajs/vue3";
import { onClickOutside } from "@vueuse/core";

const { locale } = useI18n();
const isOpen = ref(false);
const target = ref(null);

const languages = [
    {
        code: "en",
        name: "English",
        flag: "🇺🇸",
        dir: "ltr",
    },
    { code: "ar", name: "العربية", flag: "🇱🇧", dir: "rtl" },
];

onClickOutside(target, () => {
    isOpen.value = false;
});

const changeLanguage = async (langCode) => {
    const selectedLang = languages.find((lang) => lang.code === langCode);
    if (selectedLang) {
        router.post(route("set-locale"), { locale: selectedLang.code });

        // Update document direction
        document.documentElement.setAttribute("dir", selectedLang.dir);
        document.documentElement.setAttribute("lang", langCode);
        // Load new language messages
        await loadLanguageMessages(langCode);

        // Update locale
        locale.value = langCode;

        // Close dropdown
        isOpen.value = false;
    }
};

onMounted(() => {
    changeLanguage(usePage().props.locale);
});
</script>

<template>
    <div class="relative">
        <button
            class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium duration-300 ease-in-out bg-gray-100 dark:bg-meta-4"
            @click="isOpen = !isOpen"
        >
            <span>{{
                languages.find((lang) => lang.code === locale)?.flag
            }}</span>
            <span class="hidden md:block">{{
                languages.find((lang) => lang.code === locale)?.name
            }}</span>
        </button>

        <!-- Dropdown Menu -->
        <div
            v-if="isOpen"
            ref="target"
            class="absolute right-0 mt-2 w-40 rounded-lg bg-white py-2 shadow-lg dark:bg-boxdark"
        >
            <button
                v-for="lang in languages"
                :key="lang.code"
                class="flex w-full items-center gap-2 px-4 py-2 text-sm font-medium hover:bg-gray-100 dark:hover:bg-meta-4"
                @click="changeLanguage(lang.code)"
            >
                <span>{{ lang.flag }}</span>
                <span>{{ lang.name }}</span>
            </button>
        </div>
    </div>
</template>
