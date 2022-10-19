import axios from "axios";

let token = localStorage.getItem('token') ?? null;

let axiosInstance = axios.create({
    baseURL: process.env.API_URL || 'http://games.ru/api',
    headers: {
        "Content-Type": "application/json",
        "Accept": "application/json",
        "Authorization": 'Bearer '+ token
    },
});

axiosInstance.interceptors.response.use(response => response, error => {

    //console.log(error.response.status);

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
