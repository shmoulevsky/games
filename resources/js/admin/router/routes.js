import users from './Admin/Users'
import Login from "../views/Auth/Login.vue";
import Admin from "../views/Admin.vue";
import dashboard from "./Admin/Dashboard";
import games from "./Admin/Games";
import settings from "./Admin/Settings";

export default [{
    path: '/admin',
    component: Admin,
    children: [
        dashboard,
        users,
        games,
        settings,
        {
            path: 'login',
            name: 'login',
            component: Login,
        }
    ]
}]
