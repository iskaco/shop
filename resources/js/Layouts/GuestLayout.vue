<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0 dark:bg-gray-900"
    >
        <div>
            <Link href="/" class="flex flex-row gap-2">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="60"
                    height="60"
                    viewBox="0 0 48 48"
                    class="bg-lime-400 text-black rounded"
                >
                    <path
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M19.408 4.5h9.184l6.664 7.094l.621 11.236l-4.916 7.778l-1.351 3.925v6.824L24 43.5l-5.61-2.143v-6.824l-1.35-3.925l-4.917-7.778l.62-11.235Zm0 0v8.256m-6.664-1.162l6.663 1.162M12.122 22.83l7.285-10.074M28.593 4.5l-9.185 8.256M28.593 4.5l2.764 13.36m3.899-6.266l-3.899 6.266m4.521 4.97l-4.52-4.97m-.398 12.748l.397-12.748m-11.949-5.104l11.949 5.104"
                    />
                    <path
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m12.122 22.83l10.842 1.819l7.997 5.96m.396-12.749l-8.393 6.788m-3.556-11.892l3.556 11.892m-5.924 5.96l5.925-5.96"
                    />
                    <path
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m22.964 24.648l-4.574 9.885l12.571-3.925M18.39 34.533h11.22"
                    />
                </svg>
                <div class="flex flex-col">
                    <span class="font-black text-lime-400 text-2xl">
                        آیسپ
                    </span>
                    <span class="text-normal"> ادمین پنل هوشمند ایسکا </span>
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
