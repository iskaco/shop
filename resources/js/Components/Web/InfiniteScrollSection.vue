<script setup>
const props = defineProps(["items"]);
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
        class="w-full inline-flex flex-nowrap overflow-hidden [mask-image:_linear-gradient(to_right,transparent_0,_black_128px,_black_calc(100%-200px),transparent_100%)]"
    >
        <ul
            class="flex items-center justify-center md:justify-start [&_li]:mx-8 [&_img]:max-w-none animate-infinite-scroll"
        >
            <li v-for="item in props.items" :key="item.id">
                <img
                    :src="item.image"
                    class="h-28 w-auto filter brightness-0 invert-[100%]"
                />
            </li>
        </ul>
        <ul
            class="flex items-center justify-center md:justify-start [&_li]:mx-8 [&_img]:max-w-none animate-infinite-scroll"
        >
            <li v-for="item in props.items" :key="item.id">
                <img
                    :src="item.image"
                    class="h-28 w-auto filter brightness-0 invert-[100%]"
                />
            </li>
        </ul>
    </div>
</template>
