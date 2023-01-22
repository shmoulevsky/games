import users from './Admin/Users'
import Login from "../views/Auth/Login.vue";
import Admin from "../views/Admin.vue";
import dashboard from "./Admin/Dashboard";
import games from "./Admin/Games";
import settings from "./Admin/Settings";
import gameCategories from "./Admin/GameCategories";
import articleCategories from "./Admin/ArticleCategories";
import pages from "./Admin/Pages";
import articles from "./Admin/Articles";
import pageCategories from "./Admin/PageCategories";
import countries from "./Admin/Countries";
import languages from "./Admin/Languages";
import menu from "./Admin/Menu";

export default [{
    path: '/admin',
    component: Admin,
    children: [
        dashboard,
        users,
        games,
        articleCategories,
        articles,
        gameCategories,
        pageCategories,
        pages,
        settings,
        countries,
        languages,
        menu,
        {
            path: 'login',
            name: 'login',
            component: Login,
        }
    ]
}]
