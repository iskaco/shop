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
            gallery: [], // Array to store cropped images
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
                alert("FileReader API is not supported in your browser");
            }
        },

        cropImage() {
            if (!this.$refs.cropper) return;

            this.$refs.cropper.getCroppedCanvas().toBlob(
                (blob) => {
                    const croppedImageUrl = URL.createObjectURL(blob);

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

                    this.value.push(file);

                    // Add to gallery array
                    this.gallery.push({
                        url: croppedImageUrl,
                        blob: blob,
                        file: file,
                    });

                    // Reset for next image
                    this.resetCropper();
                },
                "image/jpeg",
                0.7
            );

            this.modalShowStatus = false;
        },

        removeImage(index) {
            // Revoke the object URL to free memory
            URL.revokeObjectURL(this.gallery[index].url);

            // Remove from array
            this.gallery.splice(index, 1);
            this.value.splice(index, 1);
        },

        resetCropper() {
            this.imgSrc = "";

            // Clear file input
            const fileInput = document.querySelector('input[type="file"]');
            if (fileInput) {
                fileInput.value = "";
            }
        },

        // Clean up object URLs when component is destroyed
        beforeUnmount() {
            this.gallery.forEach((image) => {
                URL.revokeObjectURL(image.url);
            });
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
        this.value = [];
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
    <div class="container mx-auto p-4">
        <!-- Gallery preview -->
        <div v-if="gallery.length > 0" class="mt-8">
            <h3 class="text-lg font-medium text-gray-700 mb-4">Your Gallery</h3>
            <div
                class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4"
            >
                <div
                    v-for="(image, index) in gallery"
                    :key="index"
                    class="relative group"
                >
                    <img
                        :src="image.url"
                        class="w-full h-32 object-cover rounded-md border border-gray-200"
                    />
                    <button
                        @click="removeImage(index)"
                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity"
                    >
                        &times;
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
