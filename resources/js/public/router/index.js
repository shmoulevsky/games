import {createRouter, createWebHistory} from "vue-router";
import routes from "./routes";

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(function (to, from, next) {
    return next();
});

export default router;
