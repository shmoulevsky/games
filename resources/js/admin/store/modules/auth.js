import AuthService from "../../services/AuthService";
import axiosInstance from "../../services/axios";

export default{
    state : {
        token: null,
        isAuth: null,
        loginErrors: null,
    },
    getters: {
        isAuth(state) {
            return state.isAuth;
        },
        getToken(state) {
            return state.token;
        },
        getLoginErrors(state) {
            return state.loginErrors;
        },
    },
    mutations: {
        setAuth(state, isAuth) {
            state.isAuth = isAuth;
        },
        setToken(state, token) {
            state.token = token;
        },
        setLoginErrors(state, errors) {
            state.loginErrors = errors;
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
                window.location.href = '/admin/dashboard';

            }).catch(error => {

                let errors = [];

                if(error.response.status === 422) {
                    for (const key in error.response.data) {
                        errors.push(error.response.data[key]);
                    }
                    ctx.commit('setLoginErrors', errors);
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
    }
}
