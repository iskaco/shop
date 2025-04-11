<script setup>
import LanguageSwitcher from "@/Components/Header/LanguageSwitcher.vue";
</script>
<template>
    <div
        class="flex flex-col gap-2 items-center justify-center min-h-screen bg-cover"
        style="background-image: url('/images/main-hero.jpg')"
    >
        <div
            class="w-full max-w-md p-8 space-y-6 bg-gray-400 text-white bg-opacity-30 backdrop-blur-md rounded-lg shadow-lg"
        >
            <img src="/images/logo.png" class="w-30 mx-auto -my-5" />

            <h2 class="text-2xl font-bold text-center">
                {{ $t("titles.web.form.register") }}
                <LanguageSwitcher class="hidden"></LanguageSwitcher>
            </h2>
            <form @submit.prevent="handleSubmit">
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium">{{
                        $t("titles.web.form.username")
                    }}</label>
                    <input
                        type="text"
                        id="username"
                        class="mt-1 block w-full p-2 text-black border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                    />
                    <span
                        v-if="errors?.username"
                        class="text-red-500 text-sm"
                        >{{ errors.username }}</span
                    >
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium">{{
                        $t("titles.web.form.password")
                    }}</label>
                    <input
                        type="password"
                        id="password"
                        class="mt-1 block w-full p-2 text-black border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                    />
                    <span
                        v-if="errors?.password"
                        class="text-red-500 text-sm"
                        >{{ errors.password }}</span
                    >
                </div>
                <div class="mb-4">
                    <label
                        for="confirmPassword"
                        class="block text-sm font-medium"
                        >{{ $t("titles.web.form.confirmPassword") }}</label
                    >
                    <input
                        type="password"
                        id="confirmPassword"
                        class="mt-1 block w-full p-2 text-black border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                    />
                    <span
                        v-if="errors?.confirmPassword"
                        class="text-red-500 text-sm"
                        >{{ errors.confirmPassword }}</span
                    >
                </div>
                <div class="flex items-center mb-4">
                    <input type="checkbox" id="rememberMe" class="mr-2" />
                    <label for="rememberMe" class="text-sm">{{
                        $t("titles.web.form.rememberMe")
                    }}</label>
                </div>
                <div class="flex justify-between mb-4">
                    <a href="#" class="text-sm text-blue-600 hover:underline">{{
                        $t("titles.web.form.forgotPassword")
                    }}</a>
                </div>
                <button
                    type="submit"
                    class="w-full py-2 mt-4 text-white bg-blue-600 rounded-md hover:bg-blue-700"
                >
                    {{ $t("titles.web.form.register") }}
                </button>
            </form>
            <p class="mt-4 text-center text-sm">
                {{ $t("titles.web.form.haveAccount") }}
                <a href="/login" class="text-blue-600 hover:underline">{{
                    $t("titles.web.form.login")
                }}</a>
            </p>
        </div>
    </div>
</template>
