import AdminPage from "../../views/AdminPage.vue";

export default {
    path: 'menu/:type',
    component: AdminPage,
    props: true,
    children: [
        {
            name: 'admin.menu',
            path: '',
            props: true,
            component: () => import("../../views/Common/Menu.vue"),
        },
    ]
}
