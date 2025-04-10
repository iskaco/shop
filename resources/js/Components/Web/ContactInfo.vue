<template>
    <div class="flex flex-col gap-4 p-4">
        <h3 class="text-xl font-semibold">
            {{ $t("titles.web.contactUs.title") }}
        </h3>
        <p class="mt-2">
            {{ $t("titles.web.contactUs.email") }}
            <a href="mailto:info@meemhome.com" class="text-blue-500"></a>
        </p>
        <p class="mt-1">
            {{ $t("titles.web.contactUs.phone") }}
            <span class="text-gray-700"></span>
        </p>
        <p class="mt-1">
            {{ $t("titles.web.contactUs.address") }}
            <span class="text-gray-700"></span>
        </p>
        <div class="social-media mt-4">
            <h4 class="text-lg font-semibold">
                {{ $t("titles.web.contactUs.follow") }}
            </h4>
            <div class="flex gap-4 mt-2">
                <a
                    href="https://facebook.com"
                    class="text-blue-600"
                    target="_blank"
                    rel="noopener noreferrer"
                    >Facebook</a
                >
                <a
                    href="https://twitter.com"
                    class="text-blue-400"
                    target="_blank"
                    rel="noopener noreferrer"
                    >Twitter</a
                >
                <a
                    href="https://instagram.com"
                    class="text-pink-600"
                    target="_blank"
                    rel="noopener noreferrer"
                    >Instagram</a
                >
            </div>
        </div>
    </div>
</template>
