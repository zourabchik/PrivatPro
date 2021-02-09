import axios from "axios";
import router from "../router";
import { createAuth } from "@websanova/vue-auth";
import driverHttpAxios from "@websanova/vue-auth/dist/drivers/http/axios.1.x.esm.js";
import driverRouterVueRouter from "@websanova/vue-auth/dist/drivers/router/vue-router.2.x.esm.js";

export const auth = createAuth({
  plugins: {
    http: axios,
    router: router
  },
  drivers: {
    http: driverHttpAxios,
    router: driverRouterVueRouter,
    auth: {
      request: function(req, token) {
        console.log(req);
        console.log(token);
        // req.headers["Authorization"] = "Bearer " + token;
      }
    }
  },
  options: {
    rolesKey: "type",
    notFoundRedirect: { name: "user-account" },
    fetchData: {
      url: "http://127.0.0.1:8000/api/auth/me",
      method: "GET",
      enabled: true
    },
    loginData: {
      url: "http://127.0.0.1:8000/api/auth/login",
      method: "POST",
      redirect: { name: "Index", 
      // name: "SearchPage" 
    },
      fetchUser: true,
      staySignedIn: true
    },
  },
});