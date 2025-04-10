<script setup>
import { ref } from "vue";

const form = ref({
    name: "",
    email: "",
    message: "",
});

const submitForm = () => {
    // Handle form submission logic here
    console.log("Form submitted:", form.value);
    // Reset form after submission
    form.value = { name: "", email: "", message: "" };
};
</script>
<template>
    <div class="p-4">
        <h3 class="text-xl font-semibold">
            {{ $t("titles.web.navigation.contact") }}
        </h3>
        <form @submit.prevent="submitForm">
            <div class="mt-2">
                <label for="name" class="block text-sm font-medium">{{
                    $t("titles.web.contactUs.nameInput")
                }}</label>
                <input
                    type="text"
                    id="name"
                    v-model="form.name"
                    required
                    class="mt-1 block w-full border rounded p-2"
                />
            </div>
            <div class="mt-2">
                <label for="email" class="block text-sm font-medium">{{
                    $t("titles.web.contactUs.emailInput")
                }}</label>
                <input
                    type="email"
                    id="email"
                    v-model="form.email"
                    required
                    class="mt-1 block w-full border rounded p-2"
                />
            </div>
            <div class="mt-2">
                <label for="message" class="block text-sm font-medium">{{
                    $t("titles.web.contactUs.messageInput")
                }}</label>
                <textarea
                    id="message"
                    v-model="form.message"
                    required
                    class="mt-1 block w-full border rounded p-2"
                    rows="4"
                ></textarea>
            </div>
            <button
                type="submit"
                class="mt-4 bg-blue-500 text-white py-2 px-4 rounded"
            >
                {{ $t("titles.web.contactUs.submit") }}
            </button>
        </form>
    </div>
</template>
