import {createRouter, createWebHistory} from "vue-router";
import routes from "./routes";
import store from "../../admin/store";

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(function (to, from, next) {

    /*if (store.getters.isAuth && to.name === 'login') {
        next({ name: '/' })
    }*/

    return next();
});

export default router;
