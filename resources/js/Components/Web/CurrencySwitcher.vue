<script setup>
import { ref } from "vue";
import { onClickOutside } from "@vueuse/core";

const isOpen = ref(false);
const target = ref(null);

const currencies = [
    {
        code: "usd",
        name: "titles.web.currency.usd.name",
        flag: "co-us",
        prefix: "titles.web.currency.usd.prefix",
    },
    {
        code: "rls",
        name: "titles.web.currency.rial.name",
        flag: "co-lb",
        prefix: "titles.web.currency.rial.prefix",
    },
];

const GetCurLang = function () {
    return languages.find((lang) => lang.code === locale.value);
};

onClickOutside(target, () => {
    isOpen.value = false;
});

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
            <span
                ><v-icon :name="selectedCurrency.flag" :scale="1.4"></v-icon
            ></span>
            <span>{{ $t(selectedCurrency.name) }}</span>
        </button>

        <!-- Dropdown Menu -->
        <div
            v-if="isOpen"
            ref="target"
            class="absolute rtl:left-0 ltr:right-0 mt-2 w-40 rounded-lg bg-white py-2 shadow-lg dark:bg-boxdark"
        >
            <button
                v-for="currency in currencies"
                :key="currency.code"
                class="flex w-full items-center gap-2 px-4 py-2 text-sm font-medium hover:bg-gray-100 dark:hover:bg-meta-4"
                @click="changeCurrency(currency)"
            >
                <span
                    ><v-icon :name="currency.flag" :scale="1.4"></v-icon
                ></span>
                <span>{{ $t(currency.name) }}</span>
            </button>
        </div>
    </div>
</template>
