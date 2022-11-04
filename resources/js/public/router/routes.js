import Home from "../views/Home";
import Login from "../views/Login";
import GamesList from "../views/Games/GamesList";
import GameDetail from "../views/Games/GameDetail";

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
        path: '/games',
        name: 'games',
        component: GamesList,
    },
    {
        path: '/games/:category',
        name: 'games-category',
        component: GamesList,
    },
    {
        path: '/games/:category/:name',
        name: 'game-detail',
        component: GameDetail,
    },
    {
        path: '/contacts',
        name: 'contacts',
        component: GameDetail,
    }
];

export default routes;
