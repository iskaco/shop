<script>
import { debounce } from "lodash";
import * as MdiIcons from "oh-vue-icons/icons/md";

export default {
    props: {
        modelValue: {
            type: String,
            default: "",
        },
        customClasses: String,
        required: {
            type: Boolean,
            default: false,
        },
        isDisabled: {
            type: Boolean,
            default: false,
        },
    },
    data() {
        return {
            icon_name: "",
            iconsList: [],
            icons: [],
            iconsPage: 1,
            showIcons: false,
        };
    },
    watch: {
        icon_name: {
            handler: debounce(function () {
                this.icons = this.iconsList.filter((icon) => {
                    return icon.name.includes(this.icon_name);
                });
                this.icons = this.PaginateIcons(this.iconsPage);
            }, 500),
        },
    },
    mounted() {
        this.iconsList = Object.values({ ...MdiIcons }).filter((icon) => {
            return icon.name.includes("outlined");
        });
        this.icons = this.iconsList;
        this.icons = this.PaginateIcons(this.iconsPage);
    },
    computed: {
        value: {
            get() {
                return this.modelValue;
            },
            set(value) {
                this.$emit("update:modelValue", value);
            },
        },
    },
    methods: {
        SelectIcon(e) {
            this.icon_name = e;
            this.showIcons = false;
        },
        PaginateIcons(page) {
            let iconCount = 50;
            return this.icons.slice((page - 1) * iconCount, page * iconCount);
        },
    },
};
</script>

<template>
    <div class="flex flex-col relative" :class="customClasses">
        <label class="mb-2.5 block text-black dark:text-white">
            آیکن
            <span v-if="required" class="text-meta-1">*</span>
        </label>
        <input
            v-model="icon_name"
            type="text"
            placeholder="بخشی از نام آیکن را وارد کنید"
            @focus="showIcons = true"
            :disabled="isDisabled"
            class="w-full rounded border-[1.5px] text-black border-stroke bg-transparent py-3 px-5 font-normal outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:text-white dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
        />
        <div
            v-if="icons.length"
            :class="showIcons ? 'flex' : 'hidden'"
            class="absolute top-20 bg-gray-2 dark:bg-meta-4 p-2 rounded border border-primary flex-row flex-wrap gap-2"
        >
            <v-icon
                v-for="icon in icons"
                :key="icon.name"
                :name="icon.name"
                :title="icon.name"
                class="cursor-pointer hover:bg-primary rounded hover:text-black"
                scale="1.5"
                @click="SelectIcon(icon.name)"
            ></v-icon>
        </div>
    </div>
</template>
