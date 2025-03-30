<template>
    <footer class="py-16 text-white bg-gray-800">
        <div class="container px-4 mx-auto">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
                <div>
                    <h4 class="mb-4 text-xl font-bold">
                        {{ $t("titles.web.footer.about.title") }}
                    </h4>
                    <p>
                        {{ $t("titles.web.footer.about.description") }}
                    </p>
                </div>
                <div>
                    <h4 class="mb-4 text-xl font-bold">
                        {{ $t("titles.web.footer.quick_links.title") }}
                    </h4>
                    <ul>
                        <li class="mb-2">
                            <a href="#" class="hover:text-blue-400">{{
                                $t("titles.web.footer.quick_links.home")
                            }}</a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="hover:text-blue-400">{{
                                $t("titles.web.footer.quick_links.shop")
                            }}</a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="hover:text-blue-400">{{
                                $t("titles.web.footer.quick_links.about")
                            }}</a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="hover:text-blue-400">{{
                                $t("titles.web.footer.quick_links.contact")
                            }}</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="mb-4 text-xl font-bold">
                        {{ $t("titles.web.footer.contact.title") }}
                    </h4>
                    <ul>
                        <li class="mb-2">
                            {{ $t("titles.web.footer.contact.email") }}
                            info@example.com
                        </li>
                        <li class="mb-2">
                            {{ $t("titles.web.footer.contact.phone") }}
                        </li>
                        <li class="mb-2">
                            {{ $t("titles.web.footer.contact.address") }}
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="mb-4 text-xl font-bold">
                        {{ $t("titles.web.footer.social.title") }}
                    </h4>
                    <div class="flex gap-4">
                        <a href="#" class="hover:text-blue-400">{{
                            $t("titles.web.footer.social.facebook")
                        }}</a>
                        <a href="#" class="hover:text-blue-400">{{
                            $t("titles.web.footer.social.twitter")
                        }}</a>
                        <a href="#" class="hover:text-blue-400">{{
                            $t("titles.web.footer.social.instagram")
                        }}</a>
                    </div>
                </div>
            </div>
            <div class="pt-8 mt-12 text-center border-t border-gray-700">
                <p>{{ $t("titles.web.footer.copyright") }}</p>
            </div>
        </div>
    </footer>
</template>
