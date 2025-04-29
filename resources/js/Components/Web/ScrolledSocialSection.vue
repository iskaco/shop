<script setup>
const items = [
    {
        id: 1,
        title: "INSTAGRAM",
    },
    {
        id: 2,
        title: "FACEBOOK",
    },
    {
        id: 3,
        title: "TIKTOK",
    },
];
</script>

<style scoped>
.animate-infinite-scroll {
    animation: scroll var(--animation-duration, 20s) linear infinite;
}
@keyframes scroll {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-100%);
    }
}
</style>
<template>
    <div
        class="w-full inline-flex flex-nowrap overflow-hidden pb-3 md:pb-5 pt-5 md:pt-7 text-xl md:text-3xl font-thin bg-cyan-600 text-white"
    >
        <ul
            class="flex items-center justify-center md:justify-start [&_li]:mx-8 [&_img]:max-w-none animate-infinite-scroll"
        >
            <li v-for="item in items" :key="item.id">
                <span>{{ item.title }}</span>
            </li>
        </ul>
        <ul
            class="flex items-center justify-center md:justify-start [&_li]:mx-8 [&_img]:max-w-none animate-infinite-scroll"
        >
            <li v-for="item in items" :key="item.id">
                <span>{{ item.title }}</span>
            </li>
        </ul>
        <ul
            class="flex items-center justify-center md:justify-start [&_li]:mx-8 [&_img]:max-w-none animate-infinite-scroll"
        >
            <li v-for="item in items" :key="item.id">
                <span>{{ item.title }}</span>
            </li>
        </ul>
    </div>
</template>
