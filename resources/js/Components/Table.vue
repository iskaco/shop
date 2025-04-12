<script>
import Pagination from "@/Components/Pagination.vue";
import { pickBy, debounce } from "lodash";
import { Link } from "@inertiajs/vue3";
import PageHeader from "./PageHeader.vue";
import Button from "./Forms/Button.vue";
import Toggle from "./Forms/Switchers/Toggle.vue";
import { toast } from "vue3-toastify";
import Modal from "./Modal.vue";
import sendRequest from "@/utils/request";

export default {
    components: {
        Pagination,
        Link,
        PageHeader,
        Button,
        Toggle,
        Modal,
        toast,
        sendRequest,
    },
    props: {
        table: Object,
        rows: Object,
    },
    data() {
        return {
            params: {
                sort_field: this.table.filters.sort_field,
                sort_direction: this.table.filters.sort_direction,
                search: this.table.filters.search,
                perPage: this.table.filters.perPage,
            },
            selectedItemId: null,
            modalBodyMessage: "",
            modalButtonLabel: "",
            modalButtonColor: "",
            modalActionRoute: "",
            modalActionMethod: "",
            modalShowStatus: false,
        };
    },
    methods: {
        closeModal() {
            this.modalShowStatus = false;
        },
        openModal(id, title, message, color, route, method) {
            this.selectedItemId = id;
            this.modalBodyMessage = message;
            this.modalButtonLabel = title;
            this.modalButtonColor = color;
            this.modalActionRoute = route;
            this.modalActionMethod = method;
            this.modalShowStatus = true;
        },
        ChangeSort(field) {
            this.params.sort_direction =
                this.params.sort_field == field
                    ? this.params.sort_direction == ""
                        ? "asc"
                        : this.params.sort_direction == "asc"
                        ? "desc"
                        : ""
                    : "asc";
            this.params.sort_field =
                this.params.sort_direction != "" ? field : "";
        },
        getImage(id, attribute, multiple) {
            const image = this.route("admin.table.getMedia", [
                this.table.model,
                id,
                attribute,
                multiple,
            ]);
            return image;
        },
        setDefaultImage(event) {
            event.target.src = "/images/person.jpeg";
        },
        callRequest() {
            sendRequest(
                this.$inertia,
                this.modalActionMethod,
                this.modalActionRoute,
                { id: this.selectedItemId },
                {
                    onSuccess: () => {
                        this.modalShowStatus = false;
                    },
                }
            );
        },
    },
    watch: {
        params: {
            handler: debounce(function () {
                // pickBy by default remove null members from object
                let params = pickBy(this.params);

                this.$inertia.get(
                    this.route("admin." + this.table.name),
                    params,
                    {
                        replace: true,
                        preserveState: true,
                    }
                );
            }, 500),
            deep: true,
        },
    },
};
</script>

<template>
    <PageHeader :pageTitle="$t('titles.table.list') + ' ' + table.title">
        <Button
            v-for="table_action in table.table_actions"
            :key="table_action.name"
            :label="table_action.title"
            customClasses="bg-primary text-white"
            :icon="table_action.icon"
            @click="this.$inertia.get(route('admin.' + table_action.route))"
        ></Button>
    </PageHeader>
    <div class="w-full flex flex-col gap-5 p-5 bg-white dark:bg-boxdark shadow">
        <div class="flex flex-row justify-between">
            <input
                class="border-stroke dark:border-strokedark rounded bg-transparent"
                type="search"
                v-model="params.search"
                :placeholder="$t('titles.search')"
            />
            <select
                v-model="params.perPage"
                class="border-stroke dark:border-strokedark rounded bg-transparent"
            >
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
        </div>
        <div class="overflow-auto">
            <table class="w-full rounded overflow-hidden">
                <thead class="bg-gray-2 dark:bg-meta-4">
                    <tr
                        class="divide-x divide-x-reverse divide-stroke dark:divide-strokedark"
                    >
                        <th
                            v-for="col in table.columns"
                            :key="col.id"
                            @click="ChangeSort(col.name)"
                        >
                            <div
                                class="w-full white relative flex justify-between items-center p-3 cursor-pointer select-none"
                            >
                                {{ col.title }}
                                <svg
                                    v-if="
                                        params.sort_field == col.name &&
                                        params.sort_direction != ''
                                    "
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 absolute left-3 top-3"
                                    :class="
                                        params.sort_direction == 'desc'
                                            ? ''
                                            : 'rotate-180'
                                    "
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        fill="currentColor"
                                        d="M6 8a1 1 0 0 1 1-1h10a1 1 0 1 1 0 2H7a1 1 0 0 1-1-1m2 4a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H9a1 1 0 0 1-1-1m3 3a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2z"
                                    />
                                </svg>
                            </div>
                        </th>
                        <th v-if="table.row_actions">
                            {{ $t("titles.actions") }}
                        </th>
                    </tr>
                </thead>
                <tbody
                    class="divide-y divide-stroke dark:divide-strokedark dark:text-white text-black-2"
                >
                    <tr v-for="row in rows.data" :key="row.id">
                        <td
                            v-for="col in table.columns"
                            :key="col.id"
                            class="p-3"
                        >
                            <div
                                v-if="col.column_type == 'Image'"
                                class="flex justify-center"
                            >
                                <img
                                    :src="
                                        getImage(row.id, col.name, col.multiple)
                                    "
                                    @error="setDefaultImage($event)"
                                    class="w-12 h-12 rounded-full"
                                />
                            </div>
                            <div
                                v-if="col.column_type == 'Toggle'"
                                class="flex justify-center"
                            >
                                <Toggle
                                    v-model="row[col.name]"
                                    :isDisabled="true"
                                ></Toggle>
                            </div>
                            <div v-else class="whitespace-nowrap">
                                {{ row[col.name] }}
                            </div>
                        </td>
                        <td v-if="table.row_actions" class="p-3">
                            <div class="flex flex-row gap-2 justify-center">
                                <div
                                    v-for="action in table.row_actions"
                                    :key="action.name"
                                >
                                    <Link
                                        v-if="!action.has_confirmation"
                                        :href="
                                            route('admin.' + action.route, {
                                                id: row.id,
                                            })
                                        "
                                        :title="action.title"
                                        class="p-1 rounded cursor-pointer"
                                    >
                                        <v-icon
                                            v-if="action.icon"
                                            :name="action.icon"
                                            :scale="1.2"
                                            :fill="'fill-' + action.color"
                                            :class="'fill-' + action.color"
                                        />
                                        <span v-if="action.has_label">{{
                                            action.title
                                        }}</span>
                                    </Link>
                                    <button
                                        v-else
                                        @click="
                                            action.has_confirmation
                                                ? openModal(
                                                      row.id,
                                                      action.title,
                                                      action.confirmation_message,
                                                      action.color,
                                                      action.confirmation_route,
                                                      action.action_type
                                                  )
                                                : $event.preventDefault()
                                        "
                                    >
                                        <v-icon
                                            v-if="action.icon"
                                            :name="action.icon"
                                            :scale="1.2"
                                            :fill="'fill-' + action.color"
                                            :class="'fill-' + action.color"
                                        />
                                        <span v-if="action.has_label">{{
                                            action.title
                                        }}</span>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <Pagination :links="rows"></Pagination>
        </div>
    </div>
    <Modal :show="modalShowStatus" @close="closeModal" maxWidth="lg">
        <div class="flex flex-col gap-5">
            <p class="p-5 dark:text-white">{{ modalBodyMessage }}</p>
            <div class="flex flex-row gap-3 justify-center mb-5">
                <Button
                    :label="modalButtonLabel"
                    :customClasses="'bg-' + modalButtonColor"
                    @click="callRequest"
                ></Button>
                <Button
                    :label="$t('titles.back')"
                    customClasses="bg-body"
                    @click="closeModal"
                ></Button>
            </div>
        </div>
    </Modal>
</template>
