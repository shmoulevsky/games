import axiosInstance from "./axios";

class GameService {
  getByCode(code) {
    return axiosInstance.get("games/" + code,{
        params: {}
    });
  }
}

export default new GameService();
