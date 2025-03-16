import "flowbite";
import { ZiggyVue } from "ziggy-js";
import "./axios";

import { createInertiaApp } from "@inertiajs/vue3";
import { createApp, h } from "vue";
import Admin from "./Pages/Layouts/Admin.vue";

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        let page = pages[`./Pages/${name}.vue`];
        if (!page.default.layout) {
            page.default.layout = name.startsWith("Admin/") ? Admin : undefined;
        }
        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
});
