import { createRouter, createWebHistory } from "vue-router";
import Login from "../pages/Login.vue";
import AdminDashboard from "../pages/admin/AdminDashboard.vue";
import TenantDashboard from "../pages/tenant/TenantDashboard.vue";

const routes = [
  { path: "/", component: Login },
  { path: "/login", component: Login },
  { path: "/admin/dashboard", component: AdminDashboard},
  { path: "/tenant/dashboard", component: TenantDashboard},
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
