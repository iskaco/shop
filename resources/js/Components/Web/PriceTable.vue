<script setup>
const plans = [
    {
        name: "titles.web.plans.bronze.name",
        price: "titles.web.plans.bronze.price",
        revenue: "titles.web.plans.bronze.revenue",
        features: [
            "titles.web.plans.bronze.features.basic",
            "titles.web.plans.bronze.features.email",
            "titles.web.plans.bronze.features.analytics",
        ],
        color: "#CE8946",
        image: "/images/boronze-star.png",
    },
    {
        name: "titles.web.plans.silver.name",
        price: "titles.web.plans.silver.price",
        revenue: "titles.web.plans.silver.revenue",
        features: [
            "titles.web.plans.silver.features.bronze",
            "titles.web.plans.silver.features.support",
            "titles.web.plans.silver.features.analytics",
        ],
        color: "#C4C4C4",
        image: "/images/silver-star.png",
    },
    {
        name: "titles.web.plans.gold.name",
        price: "titles.web.plans.gold.price",
        revenue: "titles.web.plans.gold.revenue",
        features: [
            "titles.web.plans.gold.features.silver",
            "titles.web.plans.gold.features.support",
            "titles.web.plans.gold.features.analytics",
        ],
        color: "#EFBF04",
        image: "/images/gold-star.png",
    },
    {
        name: "titles.web.plans.platinum.name",
        price: "titles.web.plans.platinum.price",
        revenue: "titles.web.plans.platinum.revenue",
        features: [
            "titles.web.plans.platinum.features.gold",
            "titles.web.plans.platinum.features.support",
            "titles.web.plans.platinum.features.analytics",
        ],
        color: "#D9D9D9",
        image: "/images/platinum-star.png",
    },
    {
        name: "titles.web.plans.diamond.name",
        price: "titles.web.plans.diamond.price",
        revenue: "titles.web.plans.diamond.revenue",
        features: [
            "titles.web.plans.diamond.features.platinum",
            "titles.web.plans.diamond.features.support",
            "titles.web.plans.diamond.features.analytics",
        ],
        color: "#ADD8E6",
        image: "/images/diamond-star.png",
    },
];
</script>
<template>
    <section class="py-20 bg-white">
        <div class="container px-20 mx-auto">
            <h2
                class="mb-16 lg:text-6xl md:text-5xl text-4xl font-bold text-center"
            >
                {{ $t("titles.web.plans.title") }}
            </h2>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-5">
                <div
                    v-for="plan in plans"
                    :key="plan.name"
                    class="flex flex-col gap-3 hover:scale-105 transition-all duration-300 p-8 text-center bg-gray-100 rounded-lg overflow-hidden"
                >
                    <span class="space-y-3">
                        <img :src="plan.image" class="w-auto h-14 mx-auto" />
                        <p
                            class="text-4xl font-black"
                            :style="`color: ${plan.color}`"
                        >
                            {{ $t(plan.name) }}
                        </p>
                    </span>
                    <span class="text-xs mb-5">
                        You Can Create Up To 3 {{ $t(plan.name) }} Chains To
                        Invite Up To 39 Friends In Each To Win Together
                    </span>

                    <div class="text-sm text-black font-bold">
                        Buys:
                        <p class="text-2xl" :style="`color: ${plan.color}`">
                            {{ $t(plan.price) }}
                        </p>
                    </div>
                    <div class="text-sm text-black font-bold">
                        Revenue:
                        <p class="text-2xl" :style="`color: ${plan.color}`">
                            25$
                        </p>
                    </div>
                    <button
                        class="p-2 text-white rounded-full"
                        :style="`background-color: ${plan.color}`"
                    >
                        {{ $t("titles.web.plans.button") }}
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>
