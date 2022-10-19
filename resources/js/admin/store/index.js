import {createStore} from 'vuex'
import VuexPersistence from 'vuex-persist'
import AuthService from "../services/AuthService";

const vuexLocal = new VuexPersistence({
    storage: window.localStorage
})

export default createStore({
    state() {
        return {
            token: localStorage.getItem('token') || '',
            isAuth: false
        }
    },
    getters: {
        isAuth(state) {
            return state.isAuth;
        },
        getToken(state) {
            return state.token;
        }
    },
    mutations: {
        setAuth(state, isAuth) {
            state.isAuth = isAuth;
        },
        setToken(state, token) {
            state.token = token;
        }
    },
    actions: {

        async refreshToken(ctx) {

            AuthService.refresh().then(response => {
                const isAuth = response.isAuth;
                ctx.commit('setAuth', isAuth);
            })

        }
    },
    modules: {
    },
    plugins: [vuexLocal.plugin]
})
