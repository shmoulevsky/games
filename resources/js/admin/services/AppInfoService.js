import axiosInstance from "./axios";

class AppInfoService {
  getInfo() {
    return axiosInstance.get('admin/app');
  }
}

export default new AppInfoService();
