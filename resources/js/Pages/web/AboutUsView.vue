<script setup>
import { Head } from "@inertiajs/vue3";
import WebLayout from "@/Layouts/WebLayout.vue";
import SectionHead from "@/Components/Web/SectionHead.vue";
</script>

<template>
    <Head :title="$t('titles.titles.web.description')" />
    <WebLayout menuBg="bg-[url(/images/menubg.jpg)] bg-center">
        <div class="flex flex-col mt-40">
            <SectionHead align="center">{{
                $t("titles.web.navigation.about")
            }}</SectionHead>
            <div class="flex flex-col gap-10 px-10 md:px-20 mb-20">
                <img
                    src="/images/logo.png"
                    alt="Logo"
                    class="w-60 mb-5 mx-auto"
                />
                <div class="text-lg text-justify">
                    {{ $t("titles.web.aboutUs.welcome") }} <br />
                    {{ $t("titles.web.aboutUs.mission") }} <br />
                    {{ $t("titles.web.aboutUs.trends") }} <br />

                    <p class="mt-10">
                        <ul class="list-disc pl-5">
                            <li>{{ $t("titles.web.aboutUs.features.wideRange") }}</li>
                            <li>{{ $t("titles.web.aboutUs.features.fastShipping") }}</li>
                            <li>{{ $t("titles.web.aboutUs.features.securePayment") }}</li>
                            <li>{{ $t("titles.web.aboutUs.features.easyReturns") }}</li>
                            <li>{{ $t("titles.web.aboutUs.features.customerSupport") }}</li>
                        </ul>
                    </p>
                </div>
            </div>
        </div>
    </WebLayout>
</template>
