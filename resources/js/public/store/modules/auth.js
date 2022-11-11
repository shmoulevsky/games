import AppInfoService from '../../services/AppInfoService'
import AuthService from "../../services/AuthService";
import axiosInstance from "../../services/axios";
import router from "../../router";

export default{
    state : {
        token: null,
        auth: null,
        user: null,
        loginErr: null
    },
    getters: {
        isAuth(state) {
            return state.auth;
        },
        getToken(state) {
            return state.token;
        },
        getUser(state) {
            return state.user;
        },
        getUserName(state) {
            return state.user.name ?? '';
        },
        getLoginErr(state) {
            return state.loginErr;
        },
        isPanelAccess(state) {
            return state.user.access_panel ?? 0;
        },
    },
    mutations: {
        setAuth(state, auth) {
            state.auth = auth;
        },
        setToken(state, token) {
            state.token = token;
        },
        setUser(state, user) {
            state.user = user;
        },
        setLoginErr(state, err) {
            state.loginErr = err;
        }
    },
    actions: {
        logout(ctx, payload) {
            ctx.commit('setAuth', false);
            ctx.commit('setToken', null);
            router.push('/login');

        },
        async login(ctx, payload) {

            AuthService.login(payload).then((response) => {

                localStorage.setItem('token', response.data.access_token);
                ctx.commit('setAuth', true);
                ctx.commit('setToken', response.data.access_token);
                ctx.commit('setUser', response.data.user);

                axiosInstance.defaults.headers.common = { 'Authorization': 'Bearer '+ localStorage.getItem('token')};
                router.push('/')

            }).catch((error) => {

                if(error.response.status === 422) {
                    let err = [];
                    for(let key in error.response.data.errors){
                        err.push(error.response.data.errors[key]);
                    }
                    ctx.commit('setLoginErr', err)
                }
            });

        },
        async refreshToken(ctx) {

            let isAuth = this.state.getters.isAuth;
            if(isAuth) return;

            AuthService.refresh().then(response => {
                let auth = response.isAuth;
                ctx.commit('setAuth', auth);
            })

        }
    }
}
