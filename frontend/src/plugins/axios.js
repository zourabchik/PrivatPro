import axios from "axios";

const instance = axios.create({
  baseURL: "http://127.0.0.1:8000/api"
});

export default {
  install: app => {
    app.config.globalProperties.$axios = instance;
  }
};

axios.interceptors.response.use(
  function(response) {
    return response;
  },
  function(error) {
    // return Promise.reject(error);
    return error;
  }
);
