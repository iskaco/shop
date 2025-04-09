<script setup>
const props = defineProps({ title: String, subtitle: String, banner: String });
</script>
<template>
    <section
        class="relative bg-center text-white min-h-screen bg-cover"
        :style="`background-image: url(${props.banner})`"
    >
        <div
            class="absolute inset-0 z-10 bg-black/60"
            style="
                background-image: radial-gradient(
                    rgba(255, 255, 255, 0.1) 1px,
                    transparent 1px
                );
                background-size: 4px 4px;
            "
        ></div>
        <div class="w-full absolute z-20 px-4 mx-auto pt-60">
            <div class="text-center">
                <h1
                    class="mb-4 rtl:mb-8 rtl:font-medium ltr:font-bold lg:text-7xl md:text-5xl text-3xl ltr:tracking-wide"
                >
                    {{ props.title }}
                </h1>
                <p class="mb-8 text-xl">
                    {{ props.subtitle }}
                </p>
                <div class="flex justify-center">
                    <div class="relative w-full max-w-xl">
                        <input
                            type="search"
                            :placeholder="
                                $t('titles.web.hero.search.placeholder')
                            "
                            class="w-full px-8 py-3 text-gray-900 placeholder-gray-500 rounded-full bg-white/90 focus:outline-none focus:ring-2 focus:ring-blue-600"
                        />
                        <button
                            class="absolute -translate-y-1/2 rtl:right-3 ltr:left-3 top-1/2"
                        >
                            <v-icon
                                name="md-search-outlined"
                                fill="fill-gray-100"
                                class="fill-body"
                            ></v-icon>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
