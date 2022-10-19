import axiosInstance from "./axios";

class DataService {
  getList(limit = 10, page = 1) {
    return axiosInstance.get("/admin/" + this.url + '?limit=' + limit + '&page=' + page);
  }
  getById(id) {
    return axiosInstance.get("/admin/"+ this.url + "/" + id);
  }
}

export default new DataService();
