import axiosInstance from "./axios";

class AppInfoService {
  getInfo() {
    return axiosInstance.get('app');
  }
}

export default new AppInfoService();
