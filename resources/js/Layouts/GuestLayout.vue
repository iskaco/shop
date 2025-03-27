<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div
        class="flex bg-[url('/images/loginbg.jpg')] bg-[size:200px_200px] bg-blend-lighten bg-repeat min-h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0 dark:bg-gray-900"
    >
        <div>
            <Link href="/" class="flex flex-row gap-2">
                <img src="/images/logo.png" alt="Logo" class="w-20 h-14" />
                <div class="flex flex-col">
                    <span class="font-black text-sky-700 text-2xl">
                        {{ $t("titles.admin.label") }}
                    </span>
                    <span class="text-normal">
                        {{ $t("titles.admin.description") }}
                    </span>
                </div>
            </Link>
        </div>

        <div
            class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg dark:bg-gray-800"
        >
            <slot />
        </div>
    </div>
</template>
