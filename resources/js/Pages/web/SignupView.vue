<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import LanguageSwitcher from "@/Components/Header/LanguageSwitcher.vue";

const form = useForm({
    login_id: null,
    password: null,
    password_confirmation: null,
});

const SubmitForm = function () {
    form.post(route("shop.customer.store"));
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
                {{ $t("titles.web.form.register") }}
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
                    <span
                        v-if="form.errors.login_id"
                        class="text-red-500 text-sm"
                        >{{ form.errors.login_id }}</span
                    >
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
                    <span
                        v-if="form.errors.password"
                        class="text-red-500 text-sm"
                        >{{ form.errors.password }}</span
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
                        v-model="form.password_confirmation"
                        class="mt-1 block w-full p-2 text-black border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                    />
                    <span
                        v-if="form.errors.password_confirmation"
                        class="text-red-500 text-sm"
                        >{{ form.errors.password_confirmation }}</span
                    >
                </div>
                <button
                    @click="SubmitForm()"
                    class="w-full py-2 mt-4 text-white bg-blue-600 rounded-md hover:bg-blue-700"
                >
                    {{ $t("titles.web.form.register") }}
                </button>
            </div>
            <p class="mt-4 text-center text-sm">
                {{ $t("titles.web.form.haveAccount") }}
                <Link
                    :href="route('shop.signin')"
                    class="text-blue-600 hover:underline"
                    >{{ $t("titles.web.form.login") }}</Link
                >
            </p>
        </div>
    </div>
</template>
