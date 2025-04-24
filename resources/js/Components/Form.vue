@ts-nocheck
<script>
import FormHeader from "@/Components/FormHeader.vue";
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
import vueFilePond from "vue-filepond";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.esm.js";
import FilePondPluginImagePreview from "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.esm.js";
import FilePondPluginImageEdit from "filepond-plugin-image-edit";
import GalleryInput from "./Forms/GalleryInput.vue";

import "filepond/dist/filepond.min.css";
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";
import "filepond-plugin-image-edit/dist/filepond-plugin-image-edit.css";

const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview,
    FilePondPluginImageEdit
);

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
        FormHeader,
        FilePond,
        GalleryInput,
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
            if (component.is_number) return "number";
            if (component.is_currency) return "currency";
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
                    this.formData.post(
                        route("admin." + this.form.action.route, [
                            this.data.id,
                        ]),
                        { forceFormData: true }
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
        handleFilePondInit: function () {
            this.$refs.pond.getFiles();
        },
        setSlug(slug_field, field) {
            this.formData[slug_field] = this.makeSlug(this.formData[field]);
        },
        makeSlug(title) {
            return title.toLowerCase().trim().replace(/\s+/g, "-");
        },
    },
    mounted() {
        let initialData = {};
        this.form.components.forEach((input) => {
            if (input.component_type == "FormSection") {
                input.children.forEach((childInput) => {
                    initialData[childInput.name] =
                        this.data[childInput.name] ?? null;
                });
            } else {
                initialData[input.name] = this.data[input.name] ?? null;
            }
        });
        if (this.form.action?.action_method == "PUT")
            initialData["_method"] = "put";
        this.formData = useForm(initialData);
        /* if (!this.form.action || this.form.action.action_method == "GET")
            this.isDisabled = true; */
    },
    computed: {
        getFormTypeTitle() {
            if (!this.form.action) return "titles.form.show";
            switch (this.form.action.action_method) {
                case "PUT":
                    return "titles.form.edit";
                case "POST":
                    return "titles.form.create";
                case "GET":
                    return "titles.form.show";
            }
        },
    },
};
</script>

<template>
    <FormHeader :formTitle="$t(getFormTypeTitle) + form.title" />
    <div class="flex flex-col w-full gap-5">
        <div v-for="component in form.components" :key="component.name">
            <DefaultCard
                v-if="component.component_type == 'FormSection'"
                :cardTitle="component.title"
                class="bg-white shadow dark:bg-boxdark !rounded-md"
            >
                <div
                    v-for="input in component.children"
                    :key="input.name"
                    class="w-full border-b border-stroke dark:border-strokedark p-6"
                >
                    <InputGroup
                        v-if="
                            input.component_type == 'TextInput' &&
                            getShowStatus(input)
                        "
                        v-model="formData[input.name]"
                        :label="input.title"
                        :type="getInputType(input)"
                        :placeholder="
                            $t('titles.form.inputPlaceholder') +
                            ' ' +
                            input.title
                        "
                        :required="input.required"
                        :isDisabled="getEnableStatus(input)"
                        @focus="
                            input.is_slug
                                ? setSlug(input.name, input.related_slug_field)
                                : ''
                        "
                    />

                    <IconPicker
                        v-if="input.component_type == 'IconInput'"
                        v-model="formData[input.name]"
                        :label="input.title"
                        :isDisabled="getEnableStatus(input)"
                    ></IconPicker>

                    <Toggle
                        v-if="input.component_type == 'Toggle'"
                        v-model="formData[input.name]"
                        :label="input.title"
                        :isDisabled="getEnableStatus(input)"
                    ></Toggle>

                    <div v-if="input.component_type == 'MultipleSelect'">
                        <label class="mb-2.5 block text-black dark:text-white">
                            {{ input.title }}
                            <span v-if="input.required" class="text-meta-1"
                                >*</span
                            >
                        </label>

                        <Multiselect
                            v-model="formData[input.name]"
                            :multiple="input.is_multi"
                            :options="input.source"
                            label="name"
                            track-by="id"
                            :placeholder="
                                $t('titles.form.selectPlaceholder') +
                                ' ' +
                                input.title
                            "
                            :showLabels="false"
                            :hideSelected="true"
                            :disabled="getEnableStatus(input)"
                        ></Multiselect>
                    </div>

                    <ImageInput
                        v-if="input.component_type == 'Image'"
                        v-model="formData[input.name]"
                        :label="input.title"
                        :model="form.model"
                        :id="data.id"
                        :attribute="input.name"
                        :multiple="false"
                        :ratio="input.ratio"
                        :isDisabled="getEnableStatus(input)"
                    >
                    </ImageInput>

                    <GalleryInput
                        v-if="input.component_type == 'Gallery'"
                        v-model="formData[input.name]"
                        :label="input.title"
                        :id="data.id"
                        :model="form.model"
                        :attribute="input.name"
                        :multiple="true"
                        :ratio="input.ratio"
                        :isDisabled="getEnableStatus(input)"
                    ></GalleryInput>

                    <div
                        v-if="formData.errors && formData.errors[input.name]"
                        class="mr-3 mt-3 text-xs text-meta-1"
                    >
                        - {{ formData.errors[input.name] }}
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
            </DefaultCard>
            <div
                v-else
                class="w-full border-b border-stroke dark:border-strokedark p-6 border bg-white shadow-default dark:bg-boxdark"
            >
                <InputGroup
                    v-if="
                        component.component_type == 'TextInput' &&
                        getShowStatus(component)
                    "
                    v-model="formData[component.name]"
                    :label="component.title"
                    :type="getInputType(component)"
                    :placeholder="
                        $t('titles.form.inputPlaceholder') +
                        ' ' +
                        component.title
                    "
                    :required="component.required"
                    :isDisabled="getEnableStatus(component)"
                    @focus="
                        component.is_slug
                            ? setSlug(
                                  component.name,
                                  component.related_slug_field
                              )
                            : ''
                    "
                />

                <IconPicker
                    v-if="component.component_type == 'IconInput'"
                    v-model="formData[component.name]"
                    :isDisabled="getEnableStatus(component)"
                ></IconPicker>

                <Toggle
                    v-if="component.component_type == 'Toggle'"
                    v-model="formData[component.name]"
                    :label="component.title"
                    :isDisabled="getEnableStatus(component)"
                ></Toggle>

                <div v-if="component.component_type == 'MultipleSelect'">
                    <label class="mb-2.5 block text-black dark:text-white">
                        {{ component.title }}
                        <span v-if="component.required" class="text-meta-1"
                            >*</span
                        >
                    </label>
                    <Multiselect
                        v-model="formData[component.name]"
                        :multiple="component.is_multi"
                        :options="component.source"
                        label="name"
                        :placeholder="
                            $t('titles.form.selectPlaceholder') +
                            ' ' +
                            component.title
                        "
                        :showLabels="false"
                        :hideSelected="true"
                        :disabled="getEnableStatus(component)"
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
                    :ratio="component.ratio"
                    :isDisabled="getEnableStatus(component)"
                >
                </ImageInput>

                <div v-if="input.component_type == 'MultiImage'">
                    <label class="mb-2.5 block text-black dark:text-white">
                        {{ input.title }}
                        <span v-if="input.required" class="text-meta-1">*</span>
                    </label>
                    <file-pond
                        v-if="input.component_type == 'Image'"
                        name="images"
                        ref="pond"
                        class-name="my-pond"
                        :label-idle="$t('titles.form.selectOrDropImagesHere')"
                        allow-multiple="true"
                        allowImageEdit="true"
                        accepted-file-types="image/jpeg, image/png"
                        :files="formData[input.name]"
                        :init="handleFilePondInit"
                    />
                </div>

                <div
                    v-if="formData.errors && formData.errors[component.name]"
                    class="mr-3 mt-3 text-xs text-meta-1"
                >
                    - {{ formData.errors[component.name] }}
                </div>
            </div>
        </div>
        <div
            class="flex justify-end gap-6 p-6 border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark"
        >
            <Button
                v-if="form.action"
                :label="form.action.title"
                :customClasses="'text-white bg-' + form.action.color"
                :icon="form.action.icon"
                @click="submitForm"
            ></Button>
            <BackButton :label="$t('titles.back')"></BackButton>
        </div>
    </div>
</template>
