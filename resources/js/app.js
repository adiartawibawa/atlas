import "./bootstrap";
import "../css/app.css";
import "flowbite";
import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";

import PerfectScrollbar from "vue3-perfect-scrollbar";
import "vue3-perfect-scrollbar/dist/vue3-perfect-scrollbar.css";

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Atlas";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: async (name) => {
        return (
            await resolvePageComponent(
                `./Pages/${name}.vue`,
                import.meta.glob("./Pages/**/*.vue")
            )
        ).default;
    },
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(PerfectScrollbar)
            .mount(el);
    },
});

InertiaProgress.init({ color: "#20ABE3" });
