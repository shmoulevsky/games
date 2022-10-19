import axiosInstance from "./axios";

class AuthService {
    refresh() {
        return axiosInstance.get('/refresh');
    }
    login(form) {
        return axiosInstance.post('/login', form);
    }
}

export default new AuthService();
