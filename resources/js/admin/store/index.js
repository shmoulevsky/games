import {createStore} from 'vuex'
import VuexPersistence from 'vuex-persist'
import page from "./modules/page";
import auth from "./modules/auth";
import info from "./modules/info";


const vuexLocal = new VuexPersistence({
    storage: window.localStorage
})

export default createStore({
    modules: {
        page,
        auth,
        info
    },
    plugins: [vuexLocal.plugin]
})
