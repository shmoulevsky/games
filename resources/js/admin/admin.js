import axios from "./services/axios";
import VueAxios from "vue-axios";
import store from './store';
import { i18nVue } from 'laravel-vue-i18n'
import {Tabs, Tab} from 'vue3-tabs-component';

require('../bootstrap');

import {createApp} from 'vue'
import router from "./router";
import App from './views/App.vue'


createApp(App)
    .use(router)
    .use(VueAxios, axios)
    .use(store)
    .use(i18nVue, {
        resolve: (lang) => import(`../../../lang/${lang}.json`)
    })
    .component('tabs', Tabs)
    .component('tab', Tab)
    .mount("#admin-app")
