<script setup>
import { ref } from "vue";

const isOpen = ref(false);

const currencies = [
    {
        code: "usd",
        name: "titles.web.currency.usd.name",
        flag: "🇺🇸",
        prefix: "titles.web.currency.usd.prefix",
    },
    {
        code: "rls",
        name: "titles.web.currency.rial.name",
        flag: "🇱🇧",
        prefix: "titles.web.currency.rial.prefix",
    },
];

const selectedCurrency = ref(currencies[0]);

const changeCurrency = (currency) => {
    selectedCurrency.value = currency;
    isOpen.value = false;
};
</script>

<template>
    <div class="relative">
        <button
            class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium duration-300 ease-in-out bg-gray-100 dark:bg-meta-4"
            @click="isOpen = !isOpen"
        >
            <span>{{ selectedCurrency.flag }}</span>
            <span class="hidden md:block">{{ $t(selectedCurrency.name) }}</span>
        </button>

        <!-- Dropdown Menu -->
        <div
            v-if="isOpen"
            class="absolute right-0 mt-2 w-40 rounded-lg bg-white py-2 shadow-lg dark:bg-boxdark"
        >
            <button
                v-for="currency in currencies"
                :key="currency.code"
                class="flex w-full items-center gap-2 px-4 py-2 text-sm font-medium hover:bg-gray-100 dark:hover:bg-meta-4"
                @click="changeCurrency(currency)"
            >
                <span>{{ currency.flag }}</span>
                <span>{{ $t(currency.name) }}</span>
            </button>
        </div>
    </div>
</template>
