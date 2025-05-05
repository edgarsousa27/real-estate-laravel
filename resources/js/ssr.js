import { createInertiaApp } from "@inertiajs/vue3";
import createServer from "@inertiajs/vue3/server";
import { renderToString } from "@vue/server-renderer";
import { createSSRApp, h } from "vue";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import { createI18n } from "vue-i18n";

const appName = import.meta.env.VITE_APP_NAME || "Real Estate";

import pt from "./Lang/pt.json";
import en from "./Lang/en.json";

const i18n = createI18n({
    locale: "pt",
    fallbackLocale: "pt",
    messages: {
        pt,
        en,
    },
});

createServer((page) =>
    createInertiaApp({
        page,
        render: renderToString,
        title: (title) => `${title} - ${appName}`,
        resolve: (name) => {
            const pages = import.meta.glob("./Pages/**/*.vue", {
                eager: true,
            });
            return pages[`./Pages/${name}.vue`];
        },
        setup({ App, props, plugin }) {
            return createSSRApp({
                render: () => h(App, props),
            })
                .use(i18n)
                .use(ZiggyVue)
                .use(plugin);
        },
    })
);
