import AdminPage from "../../views/AdminPage.vue";

export default {
    path: 'games',
    component: AdminPage,
    props: true,
    children: [
        {
            name: 'admin.games',
            path: '',
            props: true,
            component: () => import("../../views/Common/List.vue"),
        },
        {
            name: 'admin.game.add',
            path: 'add',
            props: true,
            component: () => import("../../views/Games/Edit.vue"),

        },
        {
            name: 'admin.game.edit',
            path: 'edit/:id',
            props: true,
            component: () => import("../../views/Games/Edit.vue"),

        }
    ]
}
