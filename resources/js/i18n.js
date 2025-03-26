import { createI18n } from "vue-i18n";

const messages = {};

const localeConfigs = {
    en: { dir: "ltr", flag: "🇺🇸" },
    ar: { dir: "rtl", flag: "🇱🇧" },
};

// Create i18n instance
const i18n = createI18n({
    legacy: false, // Use Composition API
    locale: import.meta.env.VITE_APP_LOCALE || "ar", // Get from env or default to Arabic
    fallbackLocale: import.meta.env.VITE_APP_FALLBACK_LOCALE || "ar",
    messages,
    globalInjection: true,
    silentTranslationWarn: true,
});

i18n.global.onLanguageChanged = (locale) => {
    document.documentElement.setAttribute("dir", localeConfigs[locale].dir);
    document.documentElement.setAttribute("lang", locale);
};

// Dynamic message loading function for single language
export async function loadLanguageMessages(locale) {
    try {
        // Import only the requested language file
        const module = await import(`./locales/${locale}.json`);
        const translations = module.default;

        i18n.global.setLocaleMessage(locale, translations);
        i18n.global.locale.value = locale;
        return translations;
    } catch (error) {
        console.error(`Failed to load ${locale} messages:`, error);
        return {};
    }
}

// Load default locale messages
loadLanguageMessages(i18n.global.locale.value);
i18n.global.onLanguageChanged(i18n.global.locale.value);

export default i18n;
