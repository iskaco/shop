<script setup>
import { useI18n } from "vue-i18n";
import { loadLanguageMessages } from "@/i18n";
import { ref } from "vue";

const { locale } = useI18n();
const isOpen = ref(false);

const languages = [
    {
        code: "en",
        name: "English",
        flag: "🇺🇸",
        dir: "ltr",
        font: "Alumni Sans Pinstripe",
    },
    { code: "ar", name: "العربية", flag: "🇱🇧", dir: "rtl", font: "Vazirmatn" },
];

const changeLanguage = async (langCode) => {
    const selectedLang = languages.find((lang) => lang.code === langCode);
    if (selectedLang) {
        // Update document direction
        document.documentElement.setAttribute("dir", selectedLang.dir);
        document.documentElement.setAttribute("lang", langCode);
        document.documentElement.style.setProperty(
            "--font-family",
            selectedLang.font
        );
        // Load new language messages
        await loadLanguageMessages(langCode);

        // Update locale
        locale.value = langCode;

        // Close dropdown
        isOpen.value = false;
    }
};
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
            <span class="hidden sm:block">{{
                languages.find((lang) => lang.code === locale)?.name
            }}</span>
            <svg
                class="fill-current"
                width="12"
                height="12"
                viewBox="0 0 12 12"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M2.5 4.5L6 8L9.5 4.5"
                    stroke="currentColor"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
        </button>

        <!-- Dropdown Menu -->
        <div
            v-if="isOpen"
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

<script>
export default {
    data() {
        return {
            isOpen: false,
        };
    },
};
</script>
