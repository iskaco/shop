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
        bgColor: "#CE8946",
        textColor: "#82572C",
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
        bgColor: "#C4C4C4",
        textColor: "#666666",
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
        bgColor: "#EFBF04",
        textColor: "#856A00",
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
        bgColor: "#D9D9D9",
        textColor: "#636363",
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
        bgColor: "#DEA193",
        textColor: "#694C45",
    },
];
</script>
<template>
    <section class="py-20 bg-gray-100">
        <div class="container px-4 mx-auto">
            <h2
                class="mb-16 lg:text-6xl md:text-5xl text-4xl font-bold text-center ltr:font-alumni rtl:font-arabic"
            >
                {{ $t("titles.web.plans.title") }}
            </h2>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-5">
                <div
                    v-for="plan in plans"
                    :key="plan.name"
                    class="relative hover:scale-105 transition-all duration-300 p-8 text-center border-2 rounded-lg shadow-lg overflow-hidden"
                    :style="`border-color: ${plan.bgColor}`"
                >
                    <p
                        class="absolute rotate-6 opacity-50 -top-3 -right-1 mb-2 text-7xl font-bold"
                        :style="`color: ${plan.bgColor}`"
                    >
                        {{ $t(plan.price) }}
                    </p>
                    <h3
                        class="mt-2 mb-10 rotate-6 -mx-10 py-7 lg:text-3xl text-2xl font-bold ltr:font-alumni rtl:font-arabic z-20"
                        :style="`color: ${plan.textColor}; background-color: ${plan.bgColor}`"
                    >
                        {{ $t(plan.name) }}
                    </h3>

                    <p class="mb-6 text-lg text-green-600">
                        {{ $t(plan.revenue) }}
                    </p>
                    <ul class="mb-8">
                        <li class="mb-2">
                            ✓
                            {{ $t(plan.features[0]) }}
                        </li>
                        <li class="mb-2">
                            ✓
                            {{ $t(plan.features[1]) }}
                        </li>
                        <li class="mb-2">
                            ✓
                            {{ $t(plan.features[2]) }}
                        </li>
                    </ul>
                    <button
                        class="w-full py-2 text-white bg-blue-600 rounded-lg"
                    >
                        {{ $t("titles.web.plans.button") }}
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>
