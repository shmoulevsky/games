import {createRouter, createWebHistory} from "vue-router";
import routes from "./routes";
import axios from "axios";

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(function (to, from, next) {

    if(to.name === 'login'){
        next()
    }

    if (localStorage.getItem('token') && to.name === 'login') {
        next({ name: 'dashboard' })
    }

    if (!localStorage.getItem('token')) {
        next({ name: 'login' })
    } else {
        next()
    }

});

export default router;
