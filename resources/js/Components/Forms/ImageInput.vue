@ts-nocheck
<script>
import Button from "./Button.vue";
import Modal from "../Modal.vue";
import VueCropper from "vue-cropperjs";
import { useTimestamp } from "@vueuse/core";

import "cropperjs/dist/cropper.css";

export default {
    props: {
        modelValue: File,
        label: String,
        customClasses: String,
        required: {
            type: Boolean,
            default: false,
        },
        isDisabled: {
            type: Boolean,
            default: false,
        },
        model: String,
        id: Number,
        attribute: String,
        multiple: Boolean,
        ratio: {
            type: Number,
            default: 1,
        },
    },
    data() {
        return {
            modalShowStatus: false,
            imgSrc: "",
            croppedSrc: null,
        };
    },
    components: {
        VueCropper,
        Modal,
        Button,
    },
    methods: {
        closeModal() {
            this.modalShowStatus = false;
        },
        getImage() {
            if (this.id) {
                this.croppedSrc = this.route("admin.form.getMedia", [
                    this.model,
                    this.id,
                    this.attribute,
                    this.multiple,
                ]);

                fetch(this.croppedSrc)
                    .then((response) => response.blob())
                    .then(
                        (blob) => {
                            const file = new File(
                                [blob],
                                `${this.id}-${this.model.split("\\")[2]}-${
                                    useTimestamp().value
                                }.jpg`,
                                {
                                    type: "image/jpeg",
                                }
                            );
                            this.value = file;
                        },
                        "image/jpeg",
                        0.7
                    )
                    .catch((error) => {
                        console.error("Error fetching the image:", error);
                    });
            }
        },
        setImage(e) {
            const file = e.target.files[0];

            if (file.type.indexOf("image/") === -1) {
                alert($t("titles.form.selectOneImage"));
                return;
            }

            if (typeof FileReader === "function") {
                const reader = new FileReader();
                reader.onload = (event) => {
                    this.imgSrc = event.target.result;

                    this.$refs.cropper.replace(event.target.result);
                };

                reader.readAsDataURL(file);

                this.modalShowStatus = true;
            } else {
                alert("Sorry, FileReader API not supported");
            }
        },
        cropImage() {
            this.croppedSrc = this.$refs.cropper
                .getCroppedCanvas()
                .toDataURL("image/jpg");

            this.$refs.cropper.getCroppedCanvas().toBlob(
                (blob) => {
                    if (blob) {
                        const file = new File(
                            [blob],
                            `${this.id}-${this.model.split("\\")[2]}-${
                                useTimestamp().value
                            }.jpg`,
                            {
                                type: "image/jpeg",
                                lastModified: Date.now(),
                            }
                        );
                        this.value = file;
                    }
                },
                "image/jpeg",
                0.7
            );

            this.modalShowStatus = false;
        },
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
    mounted() {
        this.getImage();
    },
};
</script>
<template>
    <Modal :show="modalShowStatus" @close="closeModal">
        <div class="flex flex-col gap-5">
            <VueCropper
                ref="cropper"
                :aspect-ratio="ratio"
                :src="imgSrc"
                class="h-[calc(100vh-200px)]"
            >
            </VueCropper>
            <div class="flex flex-row gap-3 justify-center mb-5">
                <Button
                    :label="$t('titles.form.select')"
                    customClasses="bg-meta-11"
                    @click="cropImage"
                ></Button>
                <Button
                    :label="$t('titles.form.cancel')"
                    customClasses="bg-body"
                    @click="closeModal"
                ></Button>
            </div>
        </div>
    </Modal>
    <div
        class="relative w-fit flex flex-col justify-center items-center"
        :class="customClasses"
    >
        <label class="mb-2.5 block text-black dark:text-white">
            {{ label }}
            <span v-if="required" class="text-meta-1">*</span>
        </label>
        <label
            class="relative w-60 overflow-hidden rounded-xl bg-gray-2 border dark:border-form-strokedark dark:bg-form-input cursor-pointer"
            :class="croppedSrc ? `aspect-[${ratio}]` : 'h-60'"
        >
            <div
                class="w-full h-full grid place-content-center"
                v-if="!croppedSrc"
            >
                <v-icon name="md-image-outlined" :scale="2" />
            </div>
            <div class="w-full h-full">
                <img
                    v-show="croppedSrc"
                    class="w-full h-full"
                    :src="croppedSrc"
                    @error="croppedSrc = null"
                />
            </div>
            <input
                class="absolute -bottom-10 hidden"
                type="file"
                accept="image/*"
                @change="setImage"
                :disabled="isDisabled"
            />
        </label>
        <span
            v-show="!isDisabled && croppedSrc"
            class="absolute flex place-content-center cursor-pointer bg-opacity-85 mx-3 py-1 text-xs text-red-900 inset-x-0 bottom-2 rounded-full bg-meta-1 hover:bg-opacity-100"
            @click="croppedSrc = null"
        >
            {{ $t("titles.form.imageRemove") }}
        </span>
    </div>
</template>
