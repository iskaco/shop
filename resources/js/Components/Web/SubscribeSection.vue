<script setup></script>
<template>
    <section class="relative py-20 text-white bg-gray-900 overflow-hidden">
        <div class="container px-4 mx-auto">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="mb-8 text-6xl font-thin">
                    {{ $t("titles.web.newsletter.title") }}
                </h2>
                <div
                    class="flex rounded-full overflow-hidden border-6 border-cyan-500"
                >
                    <input
                        type="email"
                        :placeholder="$t('titles.web.newsletter.placeholder')"
                        class="flex-1 px-4 py-3 text-black border-0"
                    />
                    <button class="px-8 py-3 bg-cyan-500 border-0">
                        <v-icon name="la-check-solid" :scale="1.5"></v-icon>
                    </button>
                </div>
            </div>
        </div>
        <img
            src="/images/sparking1.png"
            class="hidden md:block absolute top-1/4 left-20 w-60 brightness-200"
        />
        <img
            src="/images/sparking2.png"
            class="hidden md:block absolute top-1/4 right-20 w-60 brightness-200"
        />
    </section>
</template>
