import axios from "axios";
import router from "../router";
import store from "../store";

let token = localStorage.getItem('token') ?? null;
let language = store.getters.getLanguage ?? 1;

let axiosInstance = axios.create({
    baseURL: process.env.API_URL || 'http://games.ru/api',
    headers: {
        "Content-Type": "application/json",
        "Accept": "application/json",
        "language": language,
        "Authorization": 'Bearer '+ token
    },
});

axiosInstance.interceptors.response.use(response => response, error => {

    if (error.response.status === 400) {
        store.dispatch('logout').then((response) => {
            router.push('/login')
        });
    }
    if (error.response.status === 401) {
        return axiosInstance.get('/refresh').then((response) => {

            localStorage.setItem('token', response.data.access_token);
            localStorage.setItem('isAuth', true);

            this.store.commit('setAuth', true);
            this.store.commit('setToken', response.data.access_token);

            axiosInstance.headers.common = { 'Authorization': 'Bearer '+ localStorage.getItem('token')};

        })
    }

})

export default axiosInstance;
