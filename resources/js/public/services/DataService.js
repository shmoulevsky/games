import axiosInstance from "./axios";

class DataService {
  getList(url, count = 10, page = 1, sort , dir, filter) {

      url = url + '?count=' + count + '&page=' + page;

      if(sort){
          url += '&sort=' + sort;
      }

      if(dir){
          url += '&dir=' + dir;
      }

      if(filter){
          url += '&filter=' + filter;
      }

    return axiosInstance.get(url);
  }
  getById(id, url) {
    return axiosInstance.get(url + "/" + id,{
        params: {id}
    });
  }
  get(url) {
    return axiosInstance.get(url);
  }
  post(url, params) {
    return axiosInstance.post(url, params);
  }
}

export default new DataService();
