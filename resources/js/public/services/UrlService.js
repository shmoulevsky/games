import axiosInstance from "./axios";

class UrlService {
  getByUrl(url) {
    return axiosInstance.get("url",{
        params: {
            url
        }
    });
  }
}

export default new UrlService();
