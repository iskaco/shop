import "../css/app.css";
import "./bootstrap";
import "vue3-toastify/dist/index.css";

import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createApp, h } from "vue";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import { createPinia } from "pinia";
import { OhVueIcon, addIcons } from "oh-vue-icons";
import * as MdiIcons from "oh-vue-icons/icons/md";
import { CoIq, CoUs, CoIr } from "oh-vue-icons/icons/co";
import * as LaIcons from "oh-vue-icons/icons/la";
import Vue3Toastify, { toast } from "vue3-toastify";
import i18n from "./i18n";

const mdi = Object.values({ ...MdiIcons });
const lai = Object.values({ ...LaIcons });
addIcons(...mdi, ...lai, CoIq, CoUs, CoIr);

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(createPinia())
            .use(ZiggyVue)
            .use(i18n)
            .use(Vue3Toastify, {
                autoClose: 3000,
                position: toast.POSITION.BOTTOM_LEFT,
                rtl: true,
            })
            .component("v-icon", OhVueIcon)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
