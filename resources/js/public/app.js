import VueAxios from "vue-axios";
import { i18nVue } from 'laravel-vue-i18n'
import axios from "./services/axios";
import store from "./store";

require('../bootstrap');

import {createApp} from 'vue'
import router from "./router";

import App from "./views/App";


createApp(App)
    .use(router)
    .use(VueAxios, axios)
    .use(store)
    .use(i18nVue, {
        resolve: (lang) => import(`../../../lang/${lang}.json`)
    })
    .mount("#app")
