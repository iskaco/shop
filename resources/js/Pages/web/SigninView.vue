<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import LanguageSwitcher from "@/Components/Header/LanguageSwitcher.vue";

const form = useForm({ login_id: null, password: null });

const SubmitForm = function () {
    form.post(route("shop.authenticate"));
};
</script>
<template>
    <div
        class="flex flex-col gap-2 items-center justify-center min-h-screen bg-cover"
        style="background-image: url('/images/main-hero.jpg')"
    >
        <div
            class="w-full max-w-md p-8 space-y-6 bg-gray-400 text-white bg-opacity-30 backdrop-blur-md rounded-lg shadow-lg"
        >
            <Link :href="route('home')">
                <img src="/images/logo.png" class="w-30 mx-auto -my-5" />
            </Link>

            <h2 class="text-2xl font-bold text-center">
                {{ $t("titles.web.form.login") }}
                <LanguageSwitcher class="hidden"></LanguageSwitcher>
            </h2>
            <div>
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium">{{
                        $t("titles.web.form.username")
                    }}</label>
                    <input
                        type="text"
                        v-model="form.login_id"
                        class="mt-1 block w-full p-2 text-black border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                    />
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium">{{
                        $t("titles.web.form.password")
                    }}</label>
                    <input
                        type="password"
                        v-model="form.password"
                        class="mt-1 block w-full p-2 text-black border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                    />
                </div>
                <div class="flex justify-between">
                    <div class="flex items-center mb-4">
                        <input type="checkbox" id="rememberMe" class="mr-2" />
                        <label for="rememberMe" class="text-sm">{{
                            $t("titles.web.form.rememberMe")
                        }}</label>
                    </div>
                    <div class="flex justify-between mb-4">
                        <Link
                            href="#"
                            class="text-sm text-blue-600 hover:underline"
                            >{{ $t("titles.web.form.forgotPassword") }}</Link
                        >
                    </div>
                </div>
                <button
                    @click="SubmitForm()"
                    class="w-full py-2 mt-4 text-white bg-blue-600 rounded-md hover:bg-blue-700"
                >
                    {{ $t("titles.web.form.continue") }}
                </button>
            </div>
            <p class="mt-4 text-center text-sm">
                {{ $t("titles.web.form.haveNotAccount") }}
                <Link
                    :href="route('shop.signup')"
                    class="text-blue-600 hover:underline"
                    >{{ $t("titles.web.form.register") }}</Link
                >
            </p>
        </div>
    </div>
</template>
