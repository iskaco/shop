import { createRouter, createWebHistory } from "vue-router";

import SigninView from "@/Pages/Authentication/SigninView.vue";
import SignupView from "@/Pages/Authentication/SignupView.vue";
import CalendarView from "@/Pages/CalendarView.vue";
import BasicChartView from "@/Pages/Charts/BasicChartView.vue";
import DashboardView from "@/Pages/Dashboard.vue";
import FormElementsView from "@/Pages/Forms/FormElementsView.vue";
import FormLayoutView from "@/Pages/Forms/FormLayoutView.vue";
import SettingsView from "@/Pages/SettingsView.vue";
import ProfileView from "@/Pages/ProfileView.vue";
import TablesView from "@/Pages/TablesView.vue";
import AlertsView from "@/Pages/UiElements/AlertsView.vue";
import ButtonsView from "@/Pages/UiElements/ButtonsView.vue";

const routes = [
    {
        path: "/",
        name: "dashboard",
        component: DashboardView,
        meta: {
            title: "Dashboard",
        },
    },
    {
        path: "/calendar",
        name: "calendar",
        component: CalendarView,
        meta: {
            title: "Calendar",
        },
    },
    {
        path: "/profile",
        name: "profile",
        component: ProfileView,
        meta: {
            title: "Profile",
        },
    },
    {
        path: "/forms/form-elements",
        name: "formElements",
        component: FormElementsView,
        meta: {
            title: "Form Elements",
        },
    },
    {
        path: "/forms/form-layout",
        name: "formLayout",
        component: FormLayoutView,
        meta: {
            title: "Form Layout",
        },
    },
    {
        path: "/tables",
        name: "tables",
        component: TablesView,
        meta: {
            title: "Tables",
        },
    },
    {
        path: "/pages/settings",
        name: "settings",
        component: SettingsView,
        meta: {
            title: "Settings",
        },
    },
    {
        path: "/charts/basic-chart",
        name: "basicChart",
        component: BasicChartView,
        meta: {
            title: "Basic Chart",
        },
    },
    {
        path: "/ui-elements/alerts",
        name: "alerts",
        component: AlertsView,
        meta: {
            title: "Alerts",
        },
    },
    {
        path: "/ui-elements/buttons",
        name: "buttons",
        component: ButtonsView,
        meta: {
            title: "Buttons",
        },
    },
    {
        path: "/auth/signin",
        name: "signin",
        component: SigninView,
        meta: {
            title: "Signin",
        },
    },
    {
        path: "/auth/signup",
        name: "signup",
        component: SignupView,
        meta: {
            title: "Signup",
        },
    },
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
    scrollBehavior(to, from, savedPosition) {
        return savedPosition || { left: 0, top: 0 };
    },
});

router.beforeEach((to, from, next) => {
    document.title = `Vue.js ${to.meta.title} | TailAdmin - Vue.js Tailwind CSS Dashboard Template`;
    next();
});

export default router;
