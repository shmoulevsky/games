import Dashboard from "../views/Dashboard/Dashboard";
import Login from "../views/Auth/Login";
import commonRoutes from "./common";
import TablesList from "../views/Utils/Generator/TablesList";
import Forms from "../views/Utils/Generator/Forms";

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
        path: '/admin/generator/list',
        name: 'generator-list',
        component: TablesList,
    },
    {
        path: '/admin/generator/forms',
        name: 'generator-forms',
        component: Forms,
    }
];

const routes = baseRoutes.concat(commonRoutes);

export default routes;
