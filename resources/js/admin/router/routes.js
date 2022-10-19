import Dashboard from "../views/Dashboard/Dashboard";
import Login from "../views/Auth/Login";
import commonRoutes from "./common";

const baseRoutes = [
    {
        path: '/admin/login',
        name: 'login',
        component: Login,
    },
    {
        path: '/admin/dashboard',
        name: 'dashboard',
        component: Dashboard,
    }
];

const routes = baseRoutes.concat(commonRoutes);

export default routes;
