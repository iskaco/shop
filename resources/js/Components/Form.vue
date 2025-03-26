<script>
import DefaultCard from "@/Components/Forms/DefaultCard.vue";
import InputGroup from "@/Components/Forms/InputGroup.vue";
import BackButton from "@/Components/Forms/BackButton.vue";
import Toggle from "@/Components/Forms/Switchers/Toggle.vue";
import IconPicker from "@/Components/Forms/IconPicker.vue";
import Multiselect from "vue-multiselect";
import "vue-multiselect/dist/vue-multiselect.min.css";
import { Link, useForm } from "@inertiajs/vue3";
import ImageInput from "./Forms/ImageInput.vue";
import Button from "./Forms/Button.vue";
import { isObject } from "@vueuse/core";

export default {
    components: {
        Link,
        InputGroup,
        Toggle,
        DefaultCard,
        IconPicker,
        BackButton,
        Multiselect,
        ImageInput,
        Button,
    },
    props: {
        form: Object,
        data: Object,
    },
    data() {
        return { formData: Object, imgSrc: String, isDisabled: false };
    },
    methods: {
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
        getInputType(component) {
            if (component.is_password) return "password";
            if (component.is_email) return "email";
            if (component.is_url) return "url";
            return "text";
        },
        submitForm() {
            switch (this.form.action.action_method) {
                case "POST":
                    this.formData.post(
                        route("admin." + this.form.action.route)
                    );
                    break;
                case "PUT":
                    this.formData.put(
                        route("admin." + this.form.action.route, [this.data.id])
                    );
                    break;
            }
        },
        getShowStatus(item) {
            if (!this.form.action) return item.hideOnShow ? false : true;
            switch (this.form.action?.action_method) {
                case "PUT":
                    return item.hideOnEdit ? false : true;
                case "POST":
                    return item.hideOnCreate ? false : true;
                case "GET":
                    return item.hideOnShow ? false : true;
                default:
                    return true;
            }
        },
        getEnableStatus(item) {
            switch (this.form.action?.action_method) {
                case "PUT":
                    return item.disabledOnEdit ? true : false;
                case "POST":
                    return item.disabledOnCreate ? true : false;
                case "GET":
                    return item.disabledOnShow ? true : false;
                default:
                    return true;
            }
        },
    },
    mounted() {
        if (isObject(this.data)) {
            this.formData = useForm(this.data);
        } else {
            let initialData = {};
            this.form.components.forEach((input) => {
                initialData[input.name] =
                    input.component_type == "Toggle" ? false : null;
            });
            this.formData = useForm(initialData);
        }

        /* if (!this.form.action || this.form.action.action_method == "GET")
            this.isDisabled = true; */
    },
    computed: {
        getFormTypeTitle() {
            if (!this.form.action) return " نمایش ";
            switch (this.form.action.action_method) {
                case "PUT":
                    return " ویرایش ";
                case "POST":
                    return " ایجاد ";
                case "GET":
                    return " نمایش ";
            }
        },
    },
};
</script>

<template>
    <div class="flex flex-col w-full gap-5 bg-white shadow dark:bg-boxdark">
        <div class="flex flex-col gap-9">
            <DefaultCard :cardTitle="'فرم ' + getFormTypeTitle + form.title">
                <form action="#">
                    <div class="p-6.5">
                        <div
                            v-for="component in form.components"
                            :key="component.name"
                            class="w-full mb-4.5"
                        >
                            <InputGroup
                                v-if="
                                    component.component_type == 'TextInput' &&
                                    getShowStatus(component)
                                "
                                v-model="formData[component.name]"
                                :label="component.title"
                                :type="getInputType(component)"
                                :placeholder="component.title + ' را وارد کنید'"
                                customClasses="mb-4.5"
                                :required="component.required"
                                :isDisabled="getEnableStatus(component)"
                            />

                            <IconPicker
                                v-if="component.component_type == 'IconInput'"
                                customClasses="mb-4.5"
                                :isDisabled="getEnableStatus(component)"
                            ></IconPicker>

                            <Toggle
                                v-if="component.component_type == 'Toggle'"
                                v-model="formData[component.name]"
                                :label="component.title"
                                class="mb-4.5"
                                :isDisabled="getEnableStatus(component)"
                            ></Toggle>

                            <div
                                v-if="
                                    component.component_type == 'MultipleSelect'
                                "
                                class="mb-4.5"
                            >
                                <label
                                    class="mb-2.5 block text-black dark:text-white"
                                >
                                    {{ component.title }}
                                    <span
                                        v-if="component.required"
                                        class="text-meta-1"
                                        >*</span
                                    >
                                </label>
                                <Multiselect
                                    v-model="formData[component.name]"
                                    :multiple="true"
                                    :options="component.source"
                                    label="name"
                                    :placeholder="
                                        component.title + ' را انتخاب کنید'
                                    "
                                    :showLabels="false"
                                    :hideSelected="true"
                                    :disabled="getEnableStatus(component)"
                                    class="mb-4.5"
                                ></Multiselect>
                            </div>
                            <ImageInput
                                v-if="component.component_type == 'Image'"
                                v-model="formData[component.name]"
                                :label="component.title"
                                :model="form.model"
                                :id="data.id"
                                :attribute="component.name"
                                :multiple="false"
                                :isDisabled="getEnableStatus(component)"
                            >
                            </ImageInput>

                            <div
                                v-if="
                                    formData.errors &&
                                    formData.errors[component.name]
                                "
                                class="mr-3 text-xs text-meta-1"
                                :class="{
                                    '-mt-3':
                                        component.component_type != 'Image',
                                    'mt-3': component.component_type == 'Image',
                                }"
                            >
                                - {{ formData.errors[component.name] }}
                            </div>
                        </div>

                        <!-- <div class="mb-6">
                            <label
                                class="mb-2.5 block text-black dark:text-white"
                            >
                                Message
                            </label>
                            <textarea
                                rows="6"
                                placeholder="Type your message"
                                class="w-full rounded border-[1.5px] text-black border-stroke bg-transparent py-3 px-5 font-normal outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:text-white dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                            ></textarea>
                        </div> -->
                        <div class="flex justify-end gap-6 mt-10">
                            <Button
                                v-if="form.action"
                                :label="form.action.title"
                                :customClasses="
                                    'text-white bg-' + form.action.color
                                "
                                :icon="form.action.icon"
                                @click="submitForm"
                            ></Button>
                            <BackButton></BackButton>
                        </div>
                    </div>
                </form>
            </DefaultCard>
            <!-- Contact Form End -->
        </div>
    </div>
</template>
