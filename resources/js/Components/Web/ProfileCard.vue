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
    form.put(route("shop.customer.update"));
};
</script>
<template>
    <div class="w-full gap-6 px-10 mx-auto md:w-1/2">
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
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring-primary"
                />
                <div v-if="form.errors.name" class="mt-1 text-sm text-red-500">
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
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring-primary"
                />
                <div
                    v-if="form.errors.country"
                    class="mt-1 text-sm text-red-500"
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
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring-primary"
                />
                <div v-if="form.errors.city" class="mt-1 text-sm text-red-500">
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
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring-primary"
                />
                <div
                    v-if="form.errors.address"
                    class="mt-1 text-sm text-red-500"
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
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring-primary"
                />
                <div
                    v-if="form.errors.postal_code"
                    class="mt-1 text-sm text-red-500"
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
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring-primary"
                />
                <div
                    v-if="form.errors.mobile"
                    class="mt-1 text-sm text-red-500"
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
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring-primary"
                />
                <div v-if="form.errors.email" class="mt-1 text-sm text-red-500">
                    {{ form.errors.email }}
                </div>
            </div>

            <div class="flex justify-end">
                <button
                    type="submit"
                    class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-primary hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
                    :disabled="form.processing"
                    @click="updateCustomer()"
                >
                    Update Profile
                </button>
            </div>
        </div>
    </div>
</template>
