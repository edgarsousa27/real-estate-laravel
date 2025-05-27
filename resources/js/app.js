import "../css/app.css";
import "./bootstrap";

import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createApp, h } from "vue";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import { createI18n } from "vue-i18n";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { library } from "@fortawesome/fontawesome-svg-core";

import {
    faBath,
    faBed,
    faRulerCombined,
    faMountain,
    faLocationDot,
    faTemperatureHigh,
    faSnowflake,
    faUtensils,
    faFireBurner,
    faHouseSignal,
    faJarWheat,
    faDumbbell,
    faWaterLadder,
    faWheelchair,
    faCouch,
    faTree,
    faSun,
    faWater,
    faMountainSun,
    faSolarPanel,
    faDroplet,
    faPlug,
    faSquareParking,
    faChevronRight,
    faChevronLeft,
    faHeart,
    faEllipsisVertical,
    faPhone,
    faInbox,
    faClone,
    faWarehouse,
    faElevator,
    faXmark,
    faFire,
    faGaugeHigh,
    faHome,
    faUsers,
    faAddressBook,
    faChartBar,
    faGear,
    faBell,
    faBars,
    faPlus,
    faFileExport,
    faEnvelope,
    faCalendarDays,
    faClipboardList,
    faHandshake,
    faEuroSign,
    faPenToSquare,
    faTrash,
    faExclamationTriangle,
    faCheck,
    faClock,
    faIdCard,
    faMap,
} from "@fortawesome/free-solid-svg-icons";

import {
    faFacebook,
    faInstagram,
    faTwitter,
} from "@fortawesome/free-brands-svg-icons";

library.add(
    faBath,
    faBed,
    faRulerCombined,
    faMountain,
    faLocationDot,
    faTemperatureHigh,
    faSnowflake,
    faUtensils,
    faFireBurner,
    faHouseSignal,
    faJarWheat,
    faDumbbell,
    faWaterLadder,
    faWheelchair,
    faCouch,
    faTree,
    faSun,
    faWater,
    faMountainSun,
    faSolarPanel,
    faDroplet,
    faPlug,
    faSquareParking,
    faChevronRight,
    faChevronLeft,
    faHeart,
    faEllipsisVertical,
    faPhone,
    faInbox,
    faFacebook,
    faInstagram,
    faTwitter,
    faClone,
    faWarehouse,
    faElevator,
    faXmark,
    faFire,
    faGaugeHigh,
    faHome,
    faUsers,
    faAddressBook,
    faChartBar,
    faGear,
    faBell,
    faBars,
    faPlus,
    faFileExport,
    faEnvelope,
    faCalendarDays,
    faClipboardList,
    faHandshake,
    faEuroSign,
    faPenToSquare,
    faTrash,
    faExclamationTriangle,
    faCheck,
    faClock,
    faIdCard,
    faMap
);

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
            .use(ZiggyVue)
            .use(i18n)
            .component("font-awesome-icon", FontAwesomeIcon)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
