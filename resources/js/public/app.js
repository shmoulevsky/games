import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";

import VueAxios from "vue-axios";
import { i18nVue } from 'laravel-vue-i18n'
import axios from "./services/axios";
import store from "./store";

import {createApp} from 'vue'
import router from "./router";

import App from "./views/App";


createApp(App)
    .use(router)
    .use(VueAxios, axios)
    .use(store)
    .use(i18nVue, {
        resolve: (lang) => import(`../../../lang/public/${lang}.json`)
    })
    .mount("#app")
