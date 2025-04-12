<script setup></script>
<template>
    <section id="FeaturesSection" class="py-10 px-5">
        <div
            class="grid grid-cols-2 md:grid-cols-4 border border-gray-300 rounded-md bg-white"
        >
            <div
                class="flex flex-col md:flex-row justify-center items-center gap-2 hover:border hover:border-meta-1 rounded-md p-4"
            >
                <v-icon
                    name="md-localshipping-outlined"
                    :scale="3"
                    fill="fill-meta-1"
                    class="p-2 rounded-full bg-gray-100 fill-meta-1"
                ></v-icon>
                <div class="flex flex-col text-center md:text-justify">
                    <span class="font-semibold">FREE SHIPPING</span
                    ><span class="text-sm">on orders over $300</span>
                </div>
            </div>
            <div
                class="flex flex-col md:flex-row justify-center items-center gap-2 hover:border hover:border-meta-1 rounded-md p-4"
            >
                <v-icon
                    name="md-supportagent-outlined"
                    :scale="3"
                    fill="fill-meta-1"
                    class="p-2 rounded-full bg-gray-100 fill-meta-1"
                ></v-icon>
                <div class="flex flex-col text-center md:text-justify">
                    <span class="font-semibold">ONLINE SUPPORT</span
                    ><span class="text-sm">support you 7/24</span>
                </div>
            </div>
            <div
                class="flex flex-col md:flex-row justify-center items-center gap-2 hover:border hover:border-meta-1 rounded-md p-4"
            >
                <v-icon
                    name="md-pricecheck-outlined"
                    :scale="3"
                    fill="fill-meta-1"
                    class="p-2 rounded-full bg-gray-100 fill-meta-1"
                ></v-icon>
                <div class="flex flex-col text-center md:text-justify">
                    <span class="font-semibold">BEST PRICE</span>
                    <span class="text-sm">best price guarantee</span>
                </div>
            </div>
            <div
                class="flex flex-col md:flex-row justify-center items-center gap-2 hover:border hover:border-meta-1 rounded-md p-4"
            >
                <v-icon
                    name="md-highquality-outlined"
                    :scale="3"
                    fill="fill-meta-1"
                    class="p-2 rounded-full bg-gray-100 fill-meta-1"
                ></v-icon>
                <div class="flex flex-col text-center md:text-justify">
                    <span class="font-medium">BEST QUALITY</span>
                    <span class="text-sm">best quality guarantee</span>
                </div>
            </div>
        </div>
    </section>
</template>
