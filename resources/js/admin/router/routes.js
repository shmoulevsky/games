import Dashboard from "../views/Dashboard/Dashboard";
import Login from "../views/Auth/Login";
import commonRoutes from "./common";
import TablesList from "../views/Utils/Generator/TablesList";

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
    },
    {
        path: '/admin/generator',
        name: 'generator',
        component: TablesList,
    }
];

const routes = baseRoutes.concat(commonRoutes);

export default routes;
