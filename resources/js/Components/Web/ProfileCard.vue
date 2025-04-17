<script setup>
import { Link, useForm } from "@inertiajs/vue3";

const props = defineProps(["customer"]);

const getImage = function (image) {
    if (image) return route("shop.media", image);
    return false;
};

const setDefaultImage = function (event) {
    event.target.src = "/images/person.jpeg";
};

const form = useForm({
    name: props.customer?.name ?? "",
    country: props.customer?.country ?? "",
    city: props.customer?.city ?? "",
    address: props.customer?.address ?? "",
    postal_code: props.customer?.postal_code ?? "",
    mobile: props.customer?.mobile ?? "",
    email: props.customer?.email ?? "",
});

const updateCustomer = function () {
    form.post(route("customer.update"));
};
</script>
<template>
    <div class="px-10 w-full md:w-1/2 mx-auto gap-6">
        <div class="flex flex-col gap-6">
            <!-- Name -->
            <div>
                <label
                    for="name"
                    class="block text-sm font-medium text-gray-700"
                    >Name</label
                >
                <input
                    type="text"
                    id="name"
                    v-model="form.name"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                />
                <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">
                    {{ form.errors.name }}
                </div>
            </div>

            <!-- Country -->
            <div>
                <label
                    for="country"
                    class="block text-sm font-medium text-gray-700"
                    >Country</label
                >
                <input
                    type="text"
                    id="country"
                    v-model="form.country"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                />
                <div
                    v-if="form.errors.country"
                    class="text-red-500 text-sm mt-1"
                >
                    {{ form.errors.country }}
                </div>
            </div>

            <!-- City -->
            <div>
                <label
                    for="city"
                    class="block text-sm font-medium text-gray-700"
                    >City</label
                >
                <input
                    type="text"
                    id="city"
                    v-model="form.city"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                />
                <div v-if="form.errors.city" class="text-red-500 text-sm mt-1">
                    {{ form.errors.city }}
                </div>
            </div>

            <!-- Address -->
            <div>
                <label
                    for="address"
                    class="block text-sm font-medium text-gray-700"
                    >Address</label
                >
                <input
                    type="text"
                    id="address"
                    v-model="form.address"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                />
                <div
                    v-if="form.errors.address"
                    class="text-red-500 text-sm mt-1"
                >
                    {{ form.errors.address }}
                </div>
            </div>

            <!-- Postal Code -->
            <div>
                <label
                    for="postal_code"
                    class="block text-sm font-medium text-gray-700"
                    >Postal Code</label
                >
                <input
                    type="text"
                    id="postal_code"
                    v-model="form.postal_code"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                />
                <div
                    v-if="form.errors.postal_code"
                    class="text-red-500 text-sm mt-1"
                >
                    {{ form.errors.postal_code }}
                </div>
            </div>

            <!-- Mobile -->
            <div>
                <label
                    for="mobile"
                    class="block text-sm font-medium text-gray-700"
                    >Mobile</label
                >
                <input
                    type="text"
                    id="mobile"
                    v-model="form.mobile"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                />
                <div
                    v-if="form.errors.mobile"
                    class="text-red-500 text-sm mt-1"
                >
                    {{ form.errors.mobile }}
                </div>
            </div>

            <!-- Email -->
            <div>
                <label
                    for="email"
                    class="block text-sm font-medium text-gray-700"
                    >Email</label
                >
                <input
                    type="email"
                    id="email"
                    v-model="form.email"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                />
                <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">
                    {{ form.errors.email }}
                </div>
            </div>

            <div class="flex justify-end">
                <button
                    type="submit"
                    class="inline-flex justify-center rounded-md border border-transparent bg-primary py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
                    :disabled="form.processing"
                    @click="updateCustomer()"
                >
                    Update Profile
                </button>
            </div>
        </div>
    </div>
</template>
