import {createRouter, createWebHistory} from "vue-router";
import routes from "./routes";
import store from './../store';


const router = createRouter({
    history: createWebHistory(),
    routes,
});


router.beforeEach(function (to, from, next) {

    console.log(store.getters.isAuth);

    if (store.getters.isAuth && to.name === 'login') {
        next({ name: 'dashboard' })
    }

    if(to.name === 'login'){
        next()
    }

    if (!store.getters.isAuth) {
        next({ name: 'login' })
    } else {
        next()
    }

});

export default router;
