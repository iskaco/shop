<script>
import { Link } from "@inertiajs/vue3";

export default {
    components: {
        Link,
    },
    props: {
        links: Object,
    },
    computed: {
        pageLinks() {
            let pageLinks = this.links.links;
            pageLinks.pop();
            pageLinks.shift();
            return pageLinks;
        },
    },
};
</script>

<template>
    <div class="w-full text-center py-3 text-sm">
        {{
            $t("titles.table.paginationResults", {
                start: links.from,
                end: links.to,
                total: links.total,
            })
        }}
    </div>
    <nav
        class="flex items-center justify-between border-t border-gray-200 px-4 sm:px-0"
    >
        <div class="-mt-px flex w-0 flex-1">
            <component
                :is="links.prev_page_url ? 'Link' : 'span'"
                :class="[
                    !links.prev_page_url
                        ? 'text-body'
                        : 'hover:dark:border-white hover:dark:text-white hover:border-black hover:text-black',
                ]"
                >{{ $t("titles.table.paginationPrevious") }}</component
            >
        </div>
        <div class="hidden md:-mt-px md:flex">
            <component
                :is="link.active ? 'span' : 'Link'"
                v-for="link in pageLinks"
                :key="link.label"
                :href="link.url"
                class="inline-flex items-center border-t-2 px-4 pt-4 text-sm font-medium"
                :class="[
                    link.active
                        ? 'border-lime-400 text-lime-400'
                        : 'border-transparent select-none hover:dark:border-white hover:dark:text-white hover:border-black hover:text-black',
                ]"
                >{{ link.label }}
            </component>
        </div>
        <div class="-mt-px flex w-0 flex-1 justify-end">
            <component
                :is="links.next_page_url ? 'Link' : 'span'"
                :class="[
                    !links.next_page_url
                        ? 'text-body'
                        : 'hover:dark:border-white hover:dark:text-white hover:border-black hover:text-black',
                ]"
                >{{ $t("titles.table.paginationNext") }}</component
            >
        </div>
    </nav>
</template>
