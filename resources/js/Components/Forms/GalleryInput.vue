@ts-nocheck
<script>
import Button from "./Button.vue";
import Modal from "../Modal.vue";
import VueCropper from "vue-cropperjs";
import { useTimestamp } from "@vueuse/core";

import "cropperjs/dist/cropper.css";

export default {
    props: {
        modelValue: [],
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
        getImage() {
            if (this.id) {
                const images_route = this.route("admin.form.getMedia", [
                    this.model,
                    this.id,
                    this.attribute,
                    this.multiple,
                ]);

                fetch(images_route)
                    .then((response) => response.json())
                    .then((data) => {
                        Object.keys(data).forEach((uuid) => {
                            const image = this.loadImage(uuid);

                            fetch(image)
                                .then((response) => response.blob())
                                .then((blob) => {
                                    const croppedImageUrl =
                                        URL.createObjectURL(blob);
                                    const file = new File(
                                        [blob],
                                        `${this.id}-${
                                            this.model.split("\\")[2]
                                        }-${useTimestamp().value}.jpg`,
                                        {
                                            type: "image/jpeg",
                                            lastModified: Date.now(),
                                        }
                                    );

                                    const newGallery = [
                                        ...this.gallery,
                                        {
                                            url: croppedImageUrl,
                                            blob: blob,
                                            file: file,
                                        },
                                    ];

                                    const currentValue = Array.isArray(
                                        this.value
                                    )
                                        ? this.value
                                        : [];
                                    const newValue = [...currentValue, file];

                                    this.gallery = newGallery;
                                    this.value = newValue;
                                });
                        });
                    });
            }
        },
        loadImage(uuid) {
            if (uuid) return route("admin.media", uuid);
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

                    const newGallery = [
                        ...this.gallery,
                        {
                            url: croppedImageUrl,
                            blob: blob,
                            file: file,
                        },
                    ];

                    const currentValue = Array.isArray(this.value)
                        ? this.value
                        : [];
                    const newValue = [...currentValue, file];

                    this.gallery = newGallery;
                    this.value = newValue; // This will trigger the computed setter

                    this.resetCropper();
                },
                "image/jpeg",
                0.7
            );

            this.modalShowStatus = false;
        },

        removeImage(index) {
            // Create new arrays without the item
            const newGallery = [...this.gallery];
            const newValue = [...this.value];

            // Revoke the object URL to free memory
            URL.revokeObjectURL(newGallery[index].url);

            // Remove from arrays
            newGallery.splice(index, 1);
            newValue.splice(index, 1);

            // Assign new arrays to trigger reactivity
            this.gallery = newGallery;
            this.value = newValue; // This will trigger the computed setter
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
            this.gallery = [];
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

        this.gallery = this.modelValue
            ? [
                  ...this.modelValue.map((file) => ({
                      file,
                      url: URL.createObjectURL(file),
                      blob: file,
                  })),
              ]
            : [];

        this.value = this.modelValue ? [...this.modelValue] : [];
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
            <div class="flex flex-row justify-center gap-3 mb-5">
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
        class="relative flex flex-col items-center justify-center w-fit"
        :class="customClasses"
    >
        <label class="mb-2.5 block text-black dark:text-white">
            {{ label }}
            <span v-if="required" class="text-meta-1">*</span>
        </label>
        <label
            class="relative overflow-hidden border cursor-pointer w-60 rounded-xl bg-gray-2 dark:border-form-strokedark dark:bg-form-input"
            :class="croppedSrc ? `aspect-[${ratio}]` : 'h-60'"
        >
            <div
                class="grid w-full h-full place-content-center"
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
                class="absolute hidden -bottom-10"
                type="file"
                accept="image/*"
                @change="setImage"
                :disabled="isDisabled"
            />
        </label>
        <span
            v-show="!isDisabled && croppedSrc"
            class="absolute inset-x-0 flex py-1 mx-3 text-xs text-red-900 rounded-full cursor-pointer place-content-center bg-opacity-85 bottom-2 bg-meta-1 hover:bg-opacity-100"
            @click="croppedSrc = null"
        >
            {{ $t("titles.form.imageRemove") }}
        </span>
    </div>
    <div class="container p-4 mx-auto">
        <!-- Gallery preview -->
        <div v-if="gallery.length > 0" class="mt-8">
            <h3 class="mb-4 text-lg font-medium text-gray-700">Your Gallery</h3>
            <div
                class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5"
            >
                <div
                    v-for="(image, index) in gallery"
                    :key="index"
                    class="relative group"
                >
                    <img
                        :src="image.url"
                        class="object-cover w-full h-32 border border-gray-200 rounded-md"
                    />
                    <button
                        @click="removeImage(index)"
                        class="absolute flex items-center justify-center w-6 h-6 text-white transition-opacity bg-red-500 rounded-full opacity-0 top-1 right-1 group-hover:opacity-100"
                    >
                        &times;
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
