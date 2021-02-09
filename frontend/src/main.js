import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import axiosPlugin from "./plugins/axios";
import "bootstrap/dist/js/bootstrap.min.js";

createApp(App)
  .use(store)
  .use(router)
  .use(axiosPlugin)
  .mount("#app");
