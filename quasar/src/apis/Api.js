import axios from "axios";

//let Api = axios.create();
axios.defaults.withCredentials = true;




let BaseApi = axios.create(
    {baseURL: process.env.API}
);

let Api = function() {
  let token = localStorage.getItem("token");

  if (token) {
    BaseApi.defaults.headers.common["Authorization"] = `Bearer ${token}`;
  }

  return BaseApi;
};


export default Api;
