import {createStore} from 'vuex'
import VuexPersistence from 'vuex-persist'
import page from "./modules/page";
import auth from "./modules/auth";


const vuexLocal = new VuexPersistence({
    storage: window.localStorage
})

export default createStore({
    modules: {
        page,
        auth
    },
    plugins: [vuexLocal.plugin]
})
