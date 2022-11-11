import axiosInstance from "./axios";

class TagService {
  getByCategory(category_id, type, url) {
    return axiosInstance.get("tags/",{
        params: {category_id, type, url}
    });
  }
}

export default new TagService();
