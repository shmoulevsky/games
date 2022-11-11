import {createStore} from 'vuex'
import VuexPersistence from 'vuex-persist'
import auth from "./modules/auth";
import page from "./modules/page";
import info from "./modules/info";



const vuexLocal = new VuexPersistence({
    storage: window.localStorage
})

export default createStore({
    modules: {
        auth,
        page,
        info
    },
    plugins: [vuexLocal.plugin]
})
