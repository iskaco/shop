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
        flag: "co-us",
        dir: "ltr",
    },
    { code: "ar", name: "العربية", flag: "co-lb", dir: "rtl" },
];

const GetCurLang = function () {
    return languages.find((lang) => lang.code === locale.value);
};

onClickOutside(target, () => {
    isOpen.value = false;
});

const changeLanguage = async (langCode, needSet = true) => {
    const selectedLang = languages.find((lang) => lang.code === langCode);
    if (selectedLang) {
        if (needSet)
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
    changeLanguage(usePage().props.locale, false);
});
</script>

<template>
    <div class="relative">
        <button
            class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium duration-300 ease-in-out bg-gray-100 dark:bg-meta-4"
            @click="isOpen = !isOpen"
        >
            <span
                ><v-icon :name="GetCurLang().flag" :scale="1.4"></v-icon
            ></span>
            <span>{{ GetCurLang().name }}</span>
        </button>

        <!-- Dropdown Menu -->
        <div
            v-if="isOpen"
            ref="target"
            class="absolute right-0 ltr:left-0 mt-2 w-40 rounded-lg bg-white py-2 shadow-lg dark:bg-boxdark"
        >
            <button
                v-for="lang in languages"
                :key="lang.code"
                class="flex w-full items-center gap-4 px-4 py-2 text-sm font-medium hover:bg-gray-100 dark:hover:bg-meta-4"
                @click="changeLanguage(lang.code)"
            >
                <span><v-icon :name="lang.flag" :scale="1.4"></v-icon></span>
                <span>{{ lang.name }}</span>
            </button>
        </div>
    </div>
</template>
