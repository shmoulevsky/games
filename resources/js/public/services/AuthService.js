import axiosInstance from "./axios";

class AuthService {
    refresh() {
        return axiosInstance.get('/refresh');
    }
    login(form) {
        return axiosInstance.post('/login', form);
    }
    register(form) {
        return axiosInstance.post('/register', form);
    }
    verify(hash) {
        return axiosInstance.get('/register/email/verify/' + hash);
    }
    finish(form) {
        return axiosInstance.post('/register/finish', form);
    }
    quickRegister(form) {
        return axiosInstance.post('/register/quick', form);
    }
}

export default new AuthService();
