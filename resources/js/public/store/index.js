import {createStore} from 'vuex'
import VuexPersistence from 'vuex-persist'
import page from "./modules/page";


const vuexLocal = new VuexPersistence({
    storage: window.localStorage
})

export default createStore({
    state : {
        token: null,
        language: null,
        isAuth: null,

    },
    getters: {
        isAuth(state) {
            return state.isAuth;
        },
        getToken(state) {
            return state.token;
        },
        getLanguage(state) {
            return state.language;
        }
    },
    mutations: {
        setAuth(state, isAuth) {
            state.isAuth = isAuth;
        },
        setToken(state, token) {
            state.token = token;
        },
        setLanguage(state, token) {
            state.language = token;
        }
    },
    actions: {
        logout(ctx, payload) {
            ctx.commit('setAuth', false);
            ctx.commit('setToken', null);
        },
        async login(ctx, payload) {

            AuthService.login(payload).then(response => {

                localStorage.setItem('token', response.data.access_token);

                ctx.commit('setAuth', true);
                ctx.commit('setToken', response.data.access_token);

                axiosInstance.defaults.headers.common = { 'Authorization': 'Bearer '+ localStorage.getItem('token')};
                window.location.href = '/dashboard';

            }).catch(error => {

                this.isError = true;
                if(error.response.status === 422) {
                    $.each(error.response.data.errors, function(key, value) {
                        if(key === 'email'){
                            this.emailError = error.response.data.errors.email[0]; //NB: emailError is registered in Vue data
                        }
                        if(key === 'password'){
                            this.passwordError = error.response.data.errors.password[0]; //NB: passwordError is registered in Vue data
                        }
                    });
                }
            });

        },
        async refreshToken(ctx) {

            let isAuth = this.state.isAuth;

            if(isAuth) return;

            AuthService.refresh().then(response => {
                isAuth = response.isAuth;
                ctx.commit('setAuth', isAuth);
            })

        }
    },
    modules: {
        page
    },
    plugins: [vuexLocal.plugin]
})
