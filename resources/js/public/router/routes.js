import Home from "../views/Home";
import Login from "../views/Login";
import ComponentFactory from "../views/Universal/ComponentFactory";

const routes = [
    {
        path: '/login',
        name: 'login',
        component: Login,
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
