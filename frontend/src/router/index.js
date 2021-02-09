import { createRouter, createWebHistory } from "vue-router";

import Login from "../views/Authorization.vue";
import Index from "../views/Index.vue";
import SearchPage from "../views/SearchPage.vue";

const routes = [
  {
    path: "/",
    name: "Index",
    component: Index
  },
  {
    path: "/users/:id",
    name: "Users",
    component: Index
  },
  {
    path: "/auth",
    name: "Authorization",
    component: Login
  },
  {
    path: "/search",
    name: "SearchPage",
    component: SearchPage
  }
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
});

export default router;
