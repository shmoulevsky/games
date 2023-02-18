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
        auth(ctx, payload){

            localStorage.setItem('token', payload.access_token);
            ctx.commit('setAuth', true);
            ctx.commit('setToken', payload.access_token);
            ctx.commit('setUser', payload.user);

            axiosInstance.defaults.headers.common = { 'Authorization': 'Bearer '+ localStorage.getItem('token')};
            window.location.href = '/';

        },
        async login(ctx, payload) {
            return new Promise((resolve, reject) => {
                return AuthService.login(payload).then(response => {

                    localStorage.setItem('token', response.data.access_token);

                    ctx.commit('setAuth', true);
                    ctx.commit('setToken', response.data.access_token);
                    ctx.commit('setUser', response.data.user);

                    axiosInstance.defaults.headers.common = { 'Authorization': 'Bearer '+ localStorage.getItem('token')};
                    window.location.href = '/personal';

                    resolve(response);

                }).catch(error => {

                    let errors = [];
                    if(error.response.status === 422) {
                        for (const key in error.response.data.errors) {
                            errors += error.response.data.errors[key]+'<br/>';
                        }
                        reject(errors)
                    }
                });
            })
        },
        async register(ctx, payload) {
            return new Promise((resolve, reject) => {
                return AuthService.register(payload).then(response => {

                    resolve(response);

                }).catch(error => {

                    let errors = [];
                    if(error.response.status === 422) {
                        for (const key in error.response.data.errors) {
                            errors += error.response.data.errors[key]+'<br/>';
                        }
                        reject(errors)
                    }
                });
            })
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
