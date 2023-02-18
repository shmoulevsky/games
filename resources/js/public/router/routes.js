import Home from "../views/Home";
import Login from "../views/User/Login";
import Register from "../views/User/Register";

import RestorePassword from "../views/User/RestorePassword";
import Inner from "../views/Inner.vue";
import OAuth from "../views/User/OAuth.vue";

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
        path: '/confirm/:hash',
        name: 'ConfirmRegister',
        component: Inner,
    },
    {
        path: '/oauth/:type',
        name: 'oAuthUser',
        component: OAuth,
    },
    {
        path: '/',
        name: 'home',
        component: Home,
    },
    {
        path: '/:catchAll(.*)',
        component: Inner,
    }
];

export default routes;
