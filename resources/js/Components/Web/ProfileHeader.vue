<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps(["customer", "activeTab"]);
defineEmits(["change-tab"]);

const getImage = function (image) {
    if (image) return route("shop.media", image);
    return false;
};

const setDefaultImage = function (event) {
    event.target.src = "/images/person.jpeg";
};
</script>
<template>
    <div
        class="overflow-hidden rounded-sm bg-white dark:border-strokedark dark:bg-boxdark"
    >
        <div class="relative z-20 h-35 md:h-65">
            <img
                src="/images/profile-hero.jpg"
                alt="profile cover"
                class="h-full w-full rounded-b-3xl object-cover object-top"
            />
            <div
                class="absolute bottom-1 right-1 z-10 xsm:bottom-4 xsm:right-4"
            >
                <label
                    for="cover"
                    class="flex cursor-pointer items-center justify-center gap-2 rounded bg-primary py-1 px-2 text-sm font-medium text-white hover:bg-opacity-80 xsm:px-4"
                >
                    <input
                        type="file"
                        name="cover"
                        id="cover"
                        class="sr-only"
                    />
                    <span>
                        <svg
                            class="fill-current"
                            width="14"
                            height="14"
                            viewBox="0 0 14 14"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M4.76464 1.42638C4.87283 1.2641 5.05496 1.16663 5.25 1.16663H8.75C8.94504 1.16663 9.12717 1.2641 9.23536 1.42638L10.2289 2.91663H12.25C12.7141 2.91663 13.1592 3.101 13.4874 3.42919C13.8156 3.75738 14 4.2025 14 4.66663V11.0833C14 11.5474 13.8156 11.9925 13.4874 12.3207C13.1592 12.6489 12.7141 12.8333 12.25 12.8333H1.75C1.28587 12.8333 0.840752 12.6489 0.512563 12.3207C0.184375 11.9925 0 11.5474 0 11.0833V4.66663C0 4.2025 0.184374 3.75738 0.512563 3.42919C0.840752 3.101 1.28587 2.91663 1.75 2.91663H3.77114L4.76464 1.42638ZM5.56219 2.33329L4.5687 3.82353C4.46051 3.98582 4.27837 4.08329 4.08333 4.08329H1.75C1.59529 4.08329 1.44692 4.14475 1.33752 4.25415C1.22812 4.36354 1.16667 4.51192 1.16667 4.66663V11.0833C1.16667 11.238 1.22812 11.3864 1.33752 11.4958C1.44692 11.6052 1.59529 11.6666 1.75 11.6666H12.25C12.4047 11.6666 12.5531 11.6052 12.6625 11.4958C12.7719 11.3864 12.8333 11.238 12.8333 11.0833V4.66663C12.8333 4.51192 12.7719 4.36354 12.6625 4.25415C12.5531 4.14475 12.4047 4.08329 12.25 4.08329H9.91667C9.72163 4.08329 9.53949 3.98582 9.4313 3.82353L8.43781 2.33329H5.56219Z"
                                fill="white"
                            />
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M6.99992 5.83329C6.03342 5.83329 5.24992 6.61679 5.24992 7.58329C5.24992 8.54979 6.03342 9.33329 6.99992 9.33329C7.96642 9.33329 8.74992 8.54979 8.74992 7.58329C8.74992 6.61679 7.96642 5.83329 6.99992 5.83329ZM4.08325 7.58329C4.08325 5.97246 5.38909 4.66663 6.99992 4.66663C8.61075 4.66663 9.91659 5.97246 9.91659 7.58329C9.91659 9.19412 8.61075 10.5 6.99992 10.5C5.38909 10.5 4.08325 9.19412 4.08325 7.58329Z"
                                fill="white"
                            />
                        </svg>
                    </span>
                    <span>Edit</span>
                </label>
            </div>
        </div>
        <div class="px-4 pb-6 text-center lg:pb-8 xl:pb-11.5">
            <div
                class="relative z-30 mx-auto -mt-22 h-30 w-full max-w-30 rounded-full bg-white/20 p-1 backdrop-blur sm:h-44 sm:max-w-44 sm:p-3"
            >
                <div class="relative drop-shadow-2">
                    <img
                        :src="getImage(props.customer.profile_image)"
                        @error="setDefaultImage($event)"
                        class="w-30 h-30 md:h-40 md:w-40 rounded-full object-cover object-center -mt-1"
                        alt="profile"
                    />
                    <label
                        for="profile"
                        class="absolute bottom-0 right-0 flex h-8.5 w-8.5 cursor-pointer items-center justify-center rounded-full bg-primary text-white hover:bg-opacity-90 sm:bottom-2 sm:right-2"
                    >
                        <svg
                            class="fill-current"
                            width="14"
                            height="14"
                            viewBox="0 0 14 14"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M4.76464 1.42638C4.87283 1.2641 5.05496 1.16663 5.25 1.16663H8.75C8.94504 1.16663 9.12717 1.2641 9.23536 1.42638L10.2289 2.91663H12.25C12.7141 2.91663 13.1592 3.101 13.4874 3.42919C13.8156 3.75738 14 4.2025 14 4.66663V11.0833C14 11.5474 13.8156 11.9925 13.4874 12.3207C13.1592 12.6489 12.7141 12.8333 12.25 12.8333H1.75C1.28587 12.8333 0.840752 12.6489 0.512563 12.3207C0.184375 11.9925 0 11.5474 0 11.0833V4.66663C0 4.2025 0.184374 3.75738 0.512563 3.42919C0.840752 3.101 1.28587 2.91663 1.75 2.91663H3.77114L4.76464 1.42638ZM5.56219 2.33329L4.5687 3.82353C4.46051 3.98582 4.27837 4.08329 4.08333 4.08329H1.75C1.59529 4.08329 1.44692 4.14475 1.33752 4.25415C1.22812 4.36354 1.16667 4.51192 1.16667 4.66663V11.0833C1.16667 11.238 1.22812 11.3864 1.33752 11.4958C1.44692 11.6052 1.59529 11.6666 1.75 11.6666H12.25C12.4047 11.6666 12.5531 11.6052 12.6625 11.4958C12.7719 11.3864 12.8333 11.238 12.8333 11.0833V4.66663C12.8333 4.51192 12.7719 4.36354 12.6625 4.25415C12.5531 4.14475 12.4047 4.08329 12.25 4.08329H9.91667C9.72163 4.08329 9.53949 3.98582 9.4313 3.82353L8.43781 2.33329H5.56219Z"
                                fill=""
                            />
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M7.00004 5.83329C6.03354 5.83329 5.25004 6.61679 5.25004 7.58329C5.25004 8.54979 6.03354 9.33329 7.00004 9.33329C7.96654 9.33329 8.75004 8.54979 8.75004 7.58329C8.75004 6.61679 7.96654 5.83329 7.00004 5.83329ZM4.08337 7.58329C4.08337 5.97246 5.38921 4.66663 7.00004 4.66663C8.61087 4.66663 9.91671 5.97246 9.91671 7.58329C9.91671 9.19412 8.61087 10.5 7.00004 10.5C5.38921 10.5 4.08337 9.19412 4.08337 7.58329Z"
                                fill=""
                            />
                        </svg>
                        <input
                            type="file"
                            name="profile"
                            id="profile"
                            class="sr-only"
                        />
                    </label>
                </div>
            </div>
            <div class="mt-4">
                <h3
                    class="mb-1.5 text-2xl font-medium text-black dark:text-white"
                >
                    {{ $page.props.auth.customer.name }}
                </h3>
                <p class="font-medium">
                    {{
                        $page.props.auth.customer.email ??
                        $page.props.auth.customer.mobile
                    }}
                </p>
                <div
                    class="flex flex-row w-full md:w-1/3 mx-auto mt-4.5 mb-5.5 rounded-md border border-stroke py-2.5 shadow-1"
                >
                    <button
                        class="flex-1 border-r border-stroke px-4 font-semibold"
                        @click="$emit('change-tab', 'profile')"
                    >
                        Profile
                    </button>
                    <button
                        class="flex-1 border-r border-stroke px-4 font-semibold"
                        @click="$emit('change-tab', 'orders')"
                    >
                        Orders
                    </button>
                    <Link
                        :href="route('shop.signout')"
                        class="flex-1 border-r border-stroke px-4 text-meta-1 font-light"
                    >
                        Sign Out
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
