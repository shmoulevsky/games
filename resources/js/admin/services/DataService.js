import axiosInstance from "./axios";

class DataService {
  getList(limit = 10, page = 1) {
    return axiosInstance.get("/admin/" + this.url + '?limit=' + limit + '&page=' + page);
  }
  getById(id) {
    return axiosInstance.get("/admin/"+ this.url + "/" + id);
  }
  getListUrl(limit = 10, page = 1) {
      return "/admin/" + this.url + '?limit=' + limit + '&page=' + page;
  }
}

export default new DataService();
