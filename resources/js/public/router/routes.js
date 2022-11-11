import Home from "../views/Home";
import Login from "../views/User/Login";
import Register from "../views/User/Register";

import ComponentFactory from "../views/Universal/ComponentFactory";
import RestorePassword from "../views/User/RestorePassword";

const routes = [
    {
        path: '/login',
        name: 'login',
        component: Login,
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
    },
    {
        path: '/forgot',
        name: 'forgot',
        component: RestorePassword,
    },
    {
        path: '/',
        name: 'home',
        component: Home,
    },
    {
        path: '/:catchAll(.*)',
        component: ComponentFactory,
    }
];

export default routes;
